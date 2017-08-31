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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('view/{view}', 'HomeController@view');
    Route::group(['prefix' => 'logistic'], function(){
        Route::group(['prefix' => 'api'], function(){
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
            Route::get('inventory/{locations_id?}', 'Logistic\InventoryController@index');
            Route::get('stock/{locations_id}', 'Logistic\InventoryController@stock_location');
            Route::get('stock-po/{locations_id}', 'Logistic\InventoryController@stock_location_po');
            Route::get('stock-status/{locations_id}', 'Logistic\InventoryController@stock_status');
        });
        Route::get('/{a?}/{b?}/{c?}/{d?}', 'Logistic\MainController@index')->name('spa-logistic');
    });
});

