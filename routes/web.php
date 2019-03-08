<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//SAMPLE BASIC ROUTES
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/awesome', function () {
    return view('awesome');
});

//Passing dynamic webpages to the route
/*
Route::get('/users/{id}/{name}', function ($id, $name) {
    return "This page is for user $name with and id of $id.<br/> Laravel is freaking awesome!";
});
*/

//To make a model -> php artisan make:model <model_name>
//To make a controller -> php artisan make:controller <controller_name> --resource --model=<model_name>
//To show list of routes -> php artisan route:list

//ROUTES TO PAGES USING CONTROLLER
Route::get('/', 'PagesController@index')->name('home');
Route::get('/orders_mock', 'PagesController@orders'); //to be deleted
Route::get('/job_orders', 'PagesController@job_orders'); //to be deleted

// !!!! Check the routes using > php artisan route:list
//** FOR MAINTENANCE */
Route::resource('clients', 'ClientsController');
Route::resource('workers', 'WorkersController');
Route::resource('fabrics', 'FabricsController');
Route::resource('fabric_types', 'FabricTypesController');
Route::resource('fabric_patterns', 'FabricPatternsController');
Route::resource('fabric_prices', 'FabricPricesController');
Route::resource('garments', 'GarmentsController');
Route::resource('segments', 'SegmentsController');
Route::resource('operations', 'OperationsController');
Route::resource('accessories', 'AccessoriesController');
Route::resource('accessory_types', 'AccessoryTypesController');
Route::resource('designs', 'DesignsController');
Route::resource('design_types', 'DesignTypesController');

//** FOR SALES */
Route::resource('products', 'ProductsController');
Route::resource('quotations', 'QuotationsController');
Route::resource('orders', 'OrdersController');

//** FOR PRODUCTION */


//RESPONE CONTROLLERS FOR AJAX - LIST ITEMS FOR DROPDOWNS
Route::get('/get_client_list', 'ClientsController@get_client_list');
Route::get('/get_fabric_type_list', 'FabricTypesController@get_fabric_type_list');
Route::get('/get_accessory_type_list', 'AccessoryTypesController@get_accessory_type_list');
Route::get('/get_fabric_pattern_list', 'FabricPatternsController@get_fabric_pattern_list');
Route::get('/get_garment_list', 'GarmentsController@get_garment_list');
Route::get('/list_segments', 'SegmentsController@list_segments');
Route::get('/list_operations', 'OperationsController@list_operations');
Route::get('/list_design_types', 'DesignTypesController@list_design_types');
Route::get('/list_fabrics', 'FabricsController@list_fabrics');
Route::get('/list_accessories', 'AccessoriesController@list_accessories');
Route::get('/list_designs', 'DesignsController@list_designs');
Route::get('/list_products', 'ProductsController@list_products');

//RESPONE CONTROLLERS FOR AJAX - GET INFO
Route::get('/get_product_info', 'ProductsController@get_product_info');
Route::get('/get_client_info', 'ClientsController@get_client_info');


//CUSTOM LINKS THAT CAN'T BE HANDLE BY THE RESOURCE ROUTES
Route::get('/quotations/{quotation}/order', 'QuotationsController@order');
Route::get('/redirect_to_quo', 'OrdersController@quotation');
Route::post('/orders/create', 'OrdersController@create');

//DomPDF
Route::get('/export_invoice/{order}','OrdersController@export_invoice');

//DELETE GET REQUESTS
Route::get('/clients/{client}/delete', 'ClientsController@destroy');
Route::get('/workers/{worker}/delete', 'WorkersController@destroy');
Route::get('/garments/{garment}/delete', 'GarmentsController@destroy');
Route::get('/fabrics/{fabric}/delete', 'FabricsController@destroy');
Route::get('/fabric_types/{fabric_type}/delete', 'FabricTypesController@destroy');
Route::get('/fabric_patterns/{fabric_pattern}/delete', 'FabricPatternsController@destroy');
Route::get('/segments/{segment}/delete', 'SegmentsController@destroy');
Route::get('/operations/{operation}/delete', 'OperationsController@destroy');
Route::get('/accessory_types/{accessory_type}/delete', 'AccessoryTypesController@destroy');
Route::get('/accessories/{accessory}/delete', 'AccessoriesController@destroy');
Route::get('/design_types/{design_type}/delete', 'DesignTypesController@destroy');
Route::get('/design_sizes/{design_size}/delete', 'DesignTypesController@destroy');
Route::get('/designs/{design}/delete', 'DesignsController@destroy');
Route::get('/quotations/{quotation}/delete', 'QuotationsController@destroy');

//Earl
/// ignore
Route::get('AllSalesOrders','SalesOrderController@index');
Route::get('SalesOrders/new','SalesOrderController@new');
Route::get('SalesOrders/create','SalesOrderController@create');
Route::get('SalesOrders/confirm','SalesConfirmationController@confirm');
Route::post('SalesOrders/invoice','SalesInvoiceController@invoice');
Route::get('SalesOrders/print/SOConfirmation/{salesID}','SalesConfirmationController@printSOConfirmation');
Route::get('SalesOrders/print/invoice/{salesID}','SalesInvoiceController@printInvoice');

Route::get('SalesLine','SalesOrderController@salesline');
Route::get('SalesLine/addRow','SalesOrderController@addRow');
Route::get('SalesLine/save','SalesLineController@save');
Route::get('SalesLine/update','SalesLineController@update');

Route::get('Company','CompanyController@create');
Route::post('Company/save','CompanyController@save');
Route::post('Company/update','CompanyController@update');

Route::get('SalesReport','ReportsController@sales_report');
Route::get('SalesReport/print','ReportsController@print_sales_report');
/// end ignore

Route::get('Quotation/print/{quotationID}','ReportsController@printQuotation');
Route::get('Quotation/exportPDF/{quotationID}','ReportsController@quotation_exportPDF');

Route::get('SalesOrder/delivery/new','SalesDeliveryController@new');
Route::post('SalesOrder/delivery/save','SalesDeliveryController@save');
Route::get('SalesOrder/delivery/print/{salesID}','SalesDeliveryController@print_delivery_receipt');
Route::get('SalesOrder/delivery/export/{salesID}','SalesDeliveryController@export_delivery_receipt');

Route::get('SalesOrder/payment/index','CustomerPaymentController@index');
Route::get('SalesOrder/payment/create','CustomerPaymentController@create');
Route::post('SalesOrder/payment/save','CustomerPaymentController@save');
Route::get('SalesOrder/payment/view','CustomerPaymentController@view');
Route::post('SalesOrder/payment/settle','CustomerPaymentController@settle_payment');
Route::get('SalesOrder/payment/clientorders','CustomerPaymentController@get_client_orders');
Route::get('SalesOrder/payment/printOR/{payment_no}','CustomerPaymentController@print_OR');
Route::get('SalesOrder/payment/exportOR/{payment_no}','CustomerPaymentController@export_OR');
Route::get('SalesOrder/payment/delete/{payment_no}','CustomerPaymentController@delete');
