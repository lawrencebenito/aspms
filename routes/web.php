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
Route::resource('clients', 'ClientsController');
Route::resource('workers', 'WorkersController');
Route::resource('fabrics', 'FabricsController');
Route::resource('fabric_types', 'FabricTypesController');
Route::resource('garments', 'GarmentsController');
Route::resource('operations', 'OperationsController');
Route::resource('status', 'StatusController');
Route::resource('quotations', 'QuotationsController');
Route::resource('orders', 'OrdersController');

//RESPONE CONTROLLERS FOR AJAX
Route::get('/get_client_list', 'ClientsController@get_client_list');
Route::get('/get_client_info', 'ClientsController@get_client_info');
Route::get('/get_fabric_list', 'FabricsController@get_fabric_list');
Route::get('/get_garment_list', 'GarmentsController@get_garment_list');

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