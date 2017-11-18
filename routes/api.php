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

Route::prefix('airline')->group(function () {
	Route::post('airline/store','FlightController@storeAirline');
	Route::post('flight/store','FlightController@storeFlight');
	Route::get('flight/search','FlightController@searchFlight');
	Route::post('flight/booking','FlightController@bookingFlight');
	// Route::delete('flight/{id}','FlightController@destroy');
});



