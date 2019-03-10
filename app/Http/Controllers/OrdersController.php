<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_Product;
use App\Quotation;
use App\Product;
use DB;
use PDF;
use App\CustomerPayment;
use App\PaymentLines;
use Carbon\Carbon;
use App\SalesInvoice;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::join('client','client.id', '=','order.client')
            ->join('order_product','order_product.order', '=','order.id')
            ->join('product','product.id', '=','order_product.product')
            ->select('order.id','order.date_ordered','client.company_name',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        SUM(order_product.quantity * product.total_price) as total_price")
                    )
            ->groupBy('order.id')
            ->get();
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Redirects to other contoller
     *
     * @return \Illuminate\Http\Response
     */
    public function quotation()
    {
        $new_order = true;
        return redirect('quotations')->with('new_order', $new_order);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $quotation = json_decode($request->get('quotation'));
        $products = json_decode($request->get('products'));
        
        //get the array of selected products from the checkbox
        $choosen_products = $request->get('choosen_products'); 
        
        $selected_products = array();
        
        foreach ($choosen_products as $index) {
            array_push( $selected_products, $products[$index]);
        }
        
        return view('orders.create')->with('quotation', $quotation)->with('products',$selected_products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_order = '';
        try
        {
            DB::transaction(function()  use ($request) {

                $order = new Order;
                $order->date_ordered = $request->get('date_ordered');
                $order->client = $request->get('client');
                $order->po_number = $request->get('po_number');
                $order->payment_terms = $request->get('payment_terms');
                $order->remarks = $request->get('remarks');
                            
                $order->save();
                $order_id = $order->id;

                $client_name = $request->get('client_name');
                $new_order = "for $client_name on $order->date_ordered";

                $products = $request->get('ordered_products');
                
                foreach ($products as $key => $product) {
                    //Ordered Product
                    $order_product = new Order_Product;
                    $order_product->order = $order_id;
                    $order_product->product = $product;
                    $order_product->size = $request->get("sizes")[$key];
                    $order_product->quantity = $request->get("quantities")[$key];
                    $order_product->save();
                }

              //  echo $order;
            }); //end of transaction

            
            return redirect('orders')->with('new_order', $new_order);
        }
        catch( PDOException $e )
        {
            return $e;
        }
        catch( Exception $e )
        {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $id = $order->id;
        $order = Order::join('client', 'client.id', '=', 'order.client')
            ->select('order.*',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('order.id', '=', $id)
            ->get();

        $payment_no = '';
        $order2 = DB::table('order')->where('id','=',$id)->first();
        $payment = DB::table('cust_payment')->where('client_id','=',$order2->client)->first();
        
        if($payment != null)
        {
            $payment_no = $payment->payment_no;
        }

        $order_products = Order_Product::join('order', 'order.id', '=', 'order_product.order')
            ->join('product', 'product.id', '=', 'order_product.product')
            ->join('client', 'client.id', '=', 'product.client')
            ->join('garment','garment.id', '=', 'product.garment')
            ->select('order_product.*','product.*','garment.name AS garment_type',
                        DB::raw("
                        CONCAT(client.last_name,
                        ', ',
                        client.first_name,
                        ' ',
                        IF(ISNULL(client.middle_name),
                            '',
                            CONCAT(LEFT(client.middle_name, 1), '.')),
                        IF(ISNULL(client.company_name),
                            '',
                            CONCAT(' of ', client.company_name))
                        ) AS client_name
                        "),
                        DB::raw("
                        CONCAT('(',
                        product.style_number,
                        ') ',
                        garment.name,
                        IF(ISNULL(product.description),
                            '',
                            CONCAT(' - ', product.description)
                        )) AS product_temp_name
                        ")
                    )
            ->where('order.id', '=', $id)
            ->get();

        return view('orders.show')->with('order', $order[0])
                                  ->with('order_products',$order_products)
                                  ->with('payment_no',$payment_no);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Export to PDF.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function export_invoice(Order $order)
    {
        $id = $order->id;
        $order = Order::join('client', 'client.id', '=', 'order.client')
            ->select('order.*',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('order.id', '=', $id)
            ->get();

        $order_products = Order_Product::join('order', 'order.id', '=', 'order_product.order')
            ->join('product', 'product.id', '=', 'order_product.product')
            ->join('client', 'client.id', '=', 'product.client')
            ->join('garment','garment.id', '=', 'product.garment')
            ->select('order_product.*','product.*','garment.name AS garment_type',
                        DB::raw("
                        CONCAT(client.last_name,
                        ', ',
                        client.first_name,
                        ' ',
                        IF(ISNULL(client.middle_name),
                            '',
                            CONCAT(LEFT(client.middle_name, 1), '.')),
                        IF(ISNULL(client.company_name),
                            '',
                            CONCAT(' of ', client.company_name))
                        ) AS client_name
                        "),
                        DB::raw("
                        CONCAT('(',
                        product.style_number,
                        ') ',
                        garment.name,
                        IF(ISNULL(product.description),
                            '',
                            CONCAT(' - ', product.description)
                        )) AS product_temp_name
                        ")
                    )
            ->where('order.id', '=', $id)
            ->get();

        $final_price = 0;
        $computed_price = array();

        foreach ($order_products as $key => $product) {
            $result = (float) $product->quantity * (float)$product->total_price;
            array_push($computed_price, $result);
            
            $final_price += $result;
        }

        // Send data to the view using loadView function of PDF facade
        $data = array('order'=>$order[0], 'order_product'=>$order_products, 'computed_price'=>$computed_price, 'final_price'=>$final_price);
        $pdf = PDF::loadView('orders.invoice', $data);
        return $pdf->stream("invoice.pdf", array("Attachment" => false));
        //***** return $pdf->download('invoice.pdf');
    }

    public function invoice(Request $request)
    {   
        $invoiceID = "INV0000".DB::table('sales_invoice')->count();
        $invoiceAmount = 0;
        $delivery = DB::table('sales_delivery')->where('salesID','=',$request->salesID)->first();
        $order_products = DB::table('order_product')->where('order','=',$request->salesID)->get();
        $products = Product::all();

        foreach ($order_products as $line) {
            foreach ($products as $product) {
                if($product->id == $line->product)
                {
                    $invoiceAmount = $invoiceAmount + ($line->quantity * $product->total_price);
                }
            }
        }

        $ret = array();

        if($request->ajax())
        {
            $ret[0] = $invoiceID;
            $ret[1] = $delivery->deliveryID;
            $ret[2] = $invoiceAmount;
            return $ret;
        }
    }

    public function save_invoice(Request $request)
    {
        $hasErrors = 0;

        if($request->ajax())
        {
            try {

                Order::findOrFail($request->salesID)->update([
                    'salesStatus' => 'Invoiced',
                    'updated_at' => Carbon::now()
                ]);

                $sales_invoice = new SalesInvoice();
                $sales_invoice->invoiceID = $request->invoiceID;
                $sales_invoice->salesID = $request->salesID;
                $sales_invoice->payment_due_date = $request->paymentdue;
                $sales_invoice->invoice_amount = $request->invoiceAmount;
                $sales_invoice->created_at = Carbon::now();
                $sales_invoice->updated_at = Carbon::now();

                $sales_invoice->save();

            } catch (Exception $e) {
                $hasErrors = 1;
            }
        }

        return $hasErrors;
    }
}
