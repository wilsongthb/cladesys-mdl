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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){ 
    return redirect('/');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('view/{view}', 'HomeController@view');

    Route::group(['middleware' => 'user-modules'], function(){
        Route::resource('users', 'UsersController');
        Route::resource('permissions', 'PermissionsController');
        Route::group(['prefix' => 'logistic'], function(){
            Route::get('/purchase-order/{requeriments_id}/{supppliers_id}', 'Logistic\QuotationsController@purchaseOrder');
            Route::get('/orders/print/{id}', 'Logistic\RequerimentsController@imprimir');
            Route::get('/{a?}/{b?}/{c?}', 'Logistic\MainController@index')->name('logistic');
        });
    });
    
    Route::group([
        'prefix' => 'rsc',
        'middleware' => 'permissions'
    ], function(){
        Route::resource('brands', 'Logistic\BrandsController');
        Route::resource('measurements', 'Logistic\MeasurementsController');
        Route::resource('products', 'Logistic\ProductsController');
        Route::resource('locations', 'Logistic\LocationsController');
        Route::resource('packings', 'Logistic\PackingsController');
        Route::resource('categories', 'Logistic\CategoriesController');
        Route::resource('suppliers', 'Logistic\SuppliersController');
        Route::post('product-options/{locations_id}/{products_id}', 'Logistic\ProductOptionsController@getOrCreate');
        Route::resource('product-options', 'Logistic\ProductOptionsController');
        Route::resource('inputs', 'Logistic\InputsController');
        Route::resource('input-details', 'Logistic\InputDetailsController');
        Route::post('outputs/send/{id}', 'Logistic\OutputsController@send');
        Route::resource('outputs', 'Logistic\OutputsController');
        Route::resource('output-details', 'Logistic\OutputDetailsController');
        Route::resource('requeriments', 'Logistic\RequerimentsController');
        Route::post('requeriment-details/add-all-req', 'Logistic\RequerimentDetailsController@addAllReq');
        Route::resource('requeriment-details', 'Logistic\RequerimentDetailsController');
        Route::get('inventory/{locations_id?}', 'Logistic\InventoryController@index');
        Route::get('stock/{locations_id}', 'Logistic\InventoryController@stock_location');
        Route::get('stock-po/{locations_id}', 'Logistic\InventoryController@stock_location_po');
        Route::get('stock-status/{locations_id}', 'Logistic\InventoryController@stock_status');
        Route::delete('quotations/remove-supplier', 'Logistic\QuotationsController@removeSupplier');
        Route::put('quotations/select-more-cheap', 'Logistic\QuotationsController@selectMoreCheap');
        Route::get('quotations/select-suppliers', 'Logistic\QuotationsController@selectSuppliers');
        Route::Resource('quotations', 'Logistic\QuotationsController');
    });
});
