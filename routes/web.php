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

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Locations;



Route::get('/test', function (Request $request) {
    dd(auth()->user());


    // $l = Locations::all();
    // dd($l);
    // dd(Products::find(1));
    // return view('test');
});
// Route::post('/test', function (Request $request) {
//     // dd($request->all());
//     // return $request->all();
//     // dd($request);
//     exit(print_r($request->all(), true));
// });

Route::get('/', function () {
    return view('index');
});
Auth::routes();
Route::get('/home', function(){ 
    return redirect('/');
});
Route::get('/presentation', 'PresentationsController@index');
Route::group(['middleware' => 'auth'], function(){
    Route::get('view/{view}', 'HomeController@view');
    Route::group(['middleware' => 'user-modules'], function(){
        Route::group(['prefix' => 'logistic'], function(){
            Route::get('/purchase-order/{requeriments_id}/{supppliers_id}', 'Logistic\QuotationsController@purchaseOrder');
            Route::get('/orders/print/{id}', 'Logistic\RequerimentsController@imprimir');
            Route::get('/{a?}/{b?}/{c?}', 'Logistic\MainController@index')->name('logistic');
        });
        Route::get('/credentials/{a?}/{b?}/{c?}', 'CredentialsController@index');
        Route::get('/instruments/{a?}/{b?}/{c?}', 'InstrumentsController@index');
        Route::get('/lab', function(){ return view('lab.index');});
    });
    
    Route::group([
        'prefix' => 'rsc',
        'middleware' => 'user-modules'
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
        Route::get('inventory/{locations_id?}/{show_zeros?}', 'Logistic\InventoryController@index');
        Route::get('stock/{locations_id}', 'Logistic\InventoryController@stock_location');
        Route::get('stock-po/{locations_id}', 'Logistic\InventoryController@stock_location_po');
        Route::get('stock-status/{locations_id}', 'Logistic\InventoryController@stock_status');
        Route::get('real-price/{locations_id}/{products_id}', 'Logistic\InventoryController@real_price');
        Route::get('real-price-id/{locations_id}/{products_id}', 'Logistic\InventoryController@real_price_id');
        Route::delete('quotations/remove-supplier', 'Logistic\QuotationsController@removeSupplier');
        Route::put('quotations/select-more-cheap', 'Logistic\QuotationsController@selectMoreCheap');
        Route::get('quotations/select-suppliers', 'Logistic\QuotationsController@selectSuppliers');
        Route::Resource('quotations', 'Logistic\QuotationsController');
        Route::Resource('images', 'ImagesController');
        // LABORATORY
        Route::Resource('lab-encharged-jobs', 'Lab\LabEnchargedJobsController');
        // CLINIC
        Route::Resource('clinic-doctors', 'Clinic\DoctorsController');
        Route::Resource('clinic-patients', 'Clinic\PatientsController');
        Route::Resource('instrument-history', 'Clinic\InstrumentHistoryController');
        // CREDENTIALS
        Route::resource('users', 'UsersController');
        Route::resource('user-modules', 'UserModulesController');
        Route::get('user-locations/all', 'Logistic\UserLocationsController@getAllLocations');
        Route::resource('user-locations', 'Logistic\UserLocationsController');
    });
});
