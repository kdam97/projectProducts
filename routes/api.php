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

Route::group(["middleware" => "apikey.validate"], function () {

    Route::get('apiProductos', 'ApiController@getProductos');
    Route::post('apiProductos', 'ApiController@guardarProducto');
    Route::put('apiProductos/{id}', 'ApiController@editarProducto');
    Route::delete('apiProductos/{id}', 'ApiController@eliminarProducto');
    
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
