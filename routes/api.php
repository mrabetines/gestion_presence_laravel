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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('v1/student', 'EtudiantController@login');
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function()
{
 
  Route::post('/presence', 'PresenceController@markPresence');
 
});

Route::group(['prefix' => 'v1'] ,function()
{ Route::get('/exam/{id_Examen}/students','ExamenController@getListStudents');
  Route::get('/exam/{id_Examen}/beacons', 'ExamenController@getListBeacons');
  Route::get('/beacon/{id_Beacon}', 'BeaconController@getBeacon');
  Route::get('/beacons', 'BeaconController@getListBeacons');
  Route::get('/freebeacons/{id_Examen}', 'BeaconController@getListFreeBeacons');

  Route::post('/presencebymonitor', 'PresenceController@changePresence');
  Route::post('/presencebyqrcode', 'PresenceController@markPresenceqrcode');
  Route::post('/setbeaconsbyexam', 'ExamenController@addListBeacons');
  Route::post('/addorupdatebeacon', 'BeaconController@addOrUpdateBeacon');
  Route::post('/retrievebeaconfromexam', 'BeaconController@detachBeacon');

  Route::delete('/beacon/{id_Beacon}' , 'BeaconController@deleteBeacon');
 
  
});

 