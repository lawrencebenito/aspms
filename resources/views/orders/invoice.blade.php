<!DOCTYPE html>
<html>
<head>
    
    <style type="text/css">
        th, td {
  padding: 15px;
  text-align: left;
}
    </style>

</head>
<h2>INVOICE #0001</h2>
 <div class="col-md-9">
    <div class="box box-success">
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="form-group col-lg-6">
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label"><b>Date Ordered:</b> {{$order->date_ordered}}</label><p> </p>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label"><b>Client Name:</b> {{$order->full_name}} 
                  @if (!is_null($order->company_name))
                  of {{$order->company_name}}
                  @endif</label><p> </p>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label"><b>Company Address:</b> {{$order->address}}</label><p> </p>
            </div>
            @if (!is_null($order->tin))
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Client Tin</label><p> </p>
              <div class="col-sm-8">
                <p>{{$order->tin}}</p>
              </div>
              </div>  
            </div>
            @endif                            
          </div>
          <!-- End of First Column -->
          <!-- Start of Second Column -->
          <div class="form-group col-lg-6">
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label"><b>PO Number:</b> {{$order->po_number}}</label><p> </p>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label"><b>Payment Terms:</b> {{$order->payment_terms}}</label> <p> </p>
            </div>
            @if (!is_null($order->remarks)))              
            <div class="form-group">
              <label class="col-sm-4 control-label">Remarks</label>
              <div class="col-sm-8">
                <p>{{$order->remarks}}</p>
              </div>
            </div>
            @endif
          </div>
          <!-- End of Second Column -->
        </div>
        <div class="form-group">
          <div id="myTable" class="table-responsive">
            <table class="table table-bordered">
              <tr bgcolor="#f5f5f5">
                <th style="width: 15%">Quantity (pcs)    </th>
                <th style="width: 12%">Size    </th>
                <th style="width: 38%">Product Description     </th>
                <th style="width: 15%">Unit Price     </th>
                <th style="width: 15%">Price     </th>
              </tr>
              @foreach($order_product as $key => $product)
                <tr>
                  <td class="quantity">{{$product->quantity}}</td>
                  <td>{{$product->size}}</td>
                  <td style="width:1%;white-space:nowrap;vertical-align: middle">
                    {{$product->description}}
                  </td>
                  <td class="unit_price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">{{$product->total_price}}</td>
                  <td class="price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">
                    {{$computed_price[$key]}}    
                  </td>
                </tr>
              @endforeach
            </table>
            <div class="form-group pull-right">
              <label for="total_price" class="col-sm-5 control-label">Total Price</label>
              <div class="col-sm-7 no-padding">
                <input type="text" class="form-control" name="total_price" id="total_price" readonly style="text-align: right" value="Php {{$final_price}}">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">

        <pre>
        LIZ APRON Terms and Conditions of Sale

The Buyer's attention is particularly drawn to condition 10 (Liability) and condition 14 (Cookies)
1.  About Us

1.1 The Seller's is only intended for use by buyers purchasing goods in the course of its business. The Seller does not accept orders from consumers.
2.  Application of Conditions
2.1 All goods sold by the Seller to any purchaser (the " Buyer") upon the following terms which shall prevail to the exclusion of any other terms which the Buyer seeks to impose or incorporate, or which are implied by trade, custom, practice or course of dealing.

2.2 The Buyer should I agree to terms and conditions. If the Buyer refuses to accept these terms and conditions, however, the Buyer will not be able to order any goods from LIZ APRON.

2.3 Any variation(s) to these terms and conditions, including the introduction of any additional terms and conditions, shall only be binding when agreed to in writing and signed by a Director of the Seller.
3.  How the Contract is Formed between the Seller and the Buyer

3.1 After placing an order, the Buyer will receive an e-mail/Call from the Seller acknowledging that the Seller has received the Buyer's order. This does not mean that the Buyer's order has been accepted. The Buyer's order constitutes an offer to the Seller to buy goods. All orders are subject to acceptance by the Seller, and where the order is placed, the Seller will confirm such acceptance to the Buyer by sending the Seller an order confirmation by e-mail that confirms that the order is being processed (the "Order Confirmation"). The contract between the Seller and the Buyer (the "Contract") will only be formed when the Seller sends the Buyer the Order Confirmation.
3.2 The Contract will relate only to those goods whose order the Seller has confirmed in the Order Confirmation. The Seller will not be obliged to supply any other goods which may have been part of the Buyer's order until the order of such goods has been confirmed in a separate Order Confirmation.
3.3 Any samples, drawings, descriptive matter, or advertising produced by the Seller and any descriptions or illustrations contained in the Seller's catalogues or brochures are produced for the sole purpose of giving an approximate idea of the goods described in them and any measurements that are described as 'to fit' are for guidance only. They shall not form part of the Contract or have any contractual force.

3.4 The Buyer is responsible for ensuring that the terms of its order and any applicable

specification for the goods that are submitted to the Seller, including any related drawings, that are agreed by the Buyer and the Seller (the "Specification"), are complete and
accurate.

3.5 The Buyer warrants that the Seller's compliance with the Specification shall not breach any third party's intellectual property rights and, to the extent that the goods are to be manufactured in accordance with the Buyer's Specification, the Buyer shall indemnify the Seller against all liabilities, costs, expenses, damages and losses (including any direct, indirect or consequential losses, loss of profit, loss of reputation and all interest, penalties and legal and other reasonable professional costs and expenses) suffered or incurred by the Seller in connection with any claim made against the Seller for actual or alleged infringement of a third party's intellectual property rights arising out of or in connection with the Seller's use of the Specification. This condition 3.5 shall survive termination of the Contract.
3.6 The Seller reserves the right to amend the Specification if required by any applicable statutory or regulatory requirements or for the ongoing improvement of the goods.

4.  Prices

4.1 Subject to condition 4.3, the prices payable for the goods shall be those in the Seller's price list current when the Order Confirmation is sent, except in cases of obvious error.
4.2 Any samples of goods produced by or on behalf of the Seller for or in connection with the Contract will be chargeable and non-returnable.
4.3 At the Seller's absolute discretion, a surcharge of 5% per garment may be made on orders where size XL or bigger only is required.

4.4 Goods dispatched by special delivery of whatever kind at the Buyer's request are subject to a carriage surcharge.
4.5 VAT shall be added to all amounts payable by the Buyer where applicable.

4.6 The Seller reserves the right to revise prices and delivery charges at any time but changes will not affect orders in respect of which the Seller has sent an Order Confirmation (or as the case may be, a quotation) to the Buyer.

4.7 The Seller's catalogues and/or brochures each contain a large number of goods and it is always possible that, despite the Seller's best efforts, some of the goods listed on the Seller's catalogues and/or brochures may be incorrectly priced. The Seller will normally verify prices as part of its dispatch procedures so that, where the correct price is less than the stated price, the Seller will charge the lower amount when dispatching the goods to the Buyer. If the correct price for the goods is higher than the price stated on the Seller's catalogues and/or brochures, the Seller will normally, at its discretion, either contact the Buyer for instructions before dispatching the goods or reject the Buyer's order and notify the Buyer of such rejection.

4.8 The Seller is under no obligation to provide the goods to the Buyer at the incorrect (lower) price, even after the Seller has sent the Buyer an Order Confirmation, if the pricing error is obvious and unmistakable and could have reasonably been recognized by the Buyer as an error.
4.9 Where the Seller has provided the Buyer with a quotation for the goods, this shall not constitute an offer. A quotation shall only be valid for the period of time expressly stated on the quotation.

5.  Payment Terms

5.1 The Seller may suspend or close the Buyer's Account immediately if the Buyer:
5.1.1  enters into a deed of arrangement or commits an act of bankruptcy or compounds
with his creditors or if a receiving order is made against him or if an order is made or a resolution passed for the winding up of the other party or if a Receiver is appointed over any of the Buyer's assets or undertakings or if the Buyer takes or suffers any similar or analogous action in consequence of debt;
5.1.2 commits a material breach of the Contract and/or these terms and conditions and (if such a breach is remediable) fails to remedy that breach within 7 days of the Buyer being notified in writing of the breach;

5.2 The Seller may invoice the Buyer for the goods on or at any time after the goods have been dispatched. All invoices sent will be sent via email/mail to the email/address provided by the Buyer upon placing an order.

6.  Delivery

6.1 Delivery dates mentioned in any Order Confirmation or elsewhere are approximate only and are not of any contractual effect and subject to condition 10.4, the Seller shall not be under any liability to the Buyer in respect of any failure to deliver on any particular date or dates. Unless otherwise expressly agreed the Seller may effect the delivery in one or more instalments. Each instalment shall be treated as a separate contract. Any delay in delivery or defect in an instalment shall not entitle the Buyer to cancel any other instalment. 

6.2 The Seller shall be deemed to have fulfilled its contractual obligations in respect of any delivery though the quantity may be up to 10% more or less than the quantity specified in the Contract and in such event the Buyer shall pay for the actual quantity delivered.

6.3 Delivery shall be at the Buyer's premises unless otherwise agreed by the Seller (the "Delivery Location"). Delivery of the goods will be completed on the goods' arrival at the Delivery Location.

6.4 Where the Buyer and the Seller agree that delivery shall be at the Seller's premises, the Buyer shall collect the goods from the Seller's premises at the main trading address stated in condition 1.1 or such other location as may be advised by the Seller prior to delivery.

6.5 If the Buyer refuses or fails to take delivery of the goods the Seller shall be entitled to terminate the Contract with immediate effect or to dispose of the goods as it may in its absolute discretion determine and the Seller reserves the right to recover from the Buyer a minimum handling fee of 25% of the total price of such goods (plus VAT) which shall be paid by the Buyer within 30 days of the date of invoice.

</pre>

      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</html>