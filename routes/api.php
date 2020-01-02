<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('APIs')->group(function () {
        // Route::group(['middleware' => ['guest:api']], function () {
        //     Route::post('login', 'AuthController@login');
        //     Route::post('signup', 'AuthController@signup');
        // });
        // Route::group(['middleware' => 'auth:api'], function() {
        //     Route::get('logout', 'AuthController@logout');
        //     Route::get('getuser', 'AuthController@getUser');
        // });
    
   
 
});

Route::namespace('Dashboard')->group(function () {     
    Route::get('moderators',"RepresentativeController@index");

    Route::resource('products', 'ProductController');    
    Route::post("upload/image", 'ProductController@uploadImage');
    Route::resource('employees', 'EmployeeController');
    Route::post("road/maps", 'RoadMapController@store');
    Route::get("road/maps/{emp_id}", 'RoadMapController@get_companies');
    Route::get('product/employee/{emp_id}',"ProductController@show_products");  
    Route::resource("targets", 'EmployeeTargetController');
});
Route::namespace('Mobile')->group(function () {   
    Route::post('add/product', 'ProductController@add_product'); 
    Route::post('add/rate/employee', 'ProductController@add_rate_employee'); 
       
     });