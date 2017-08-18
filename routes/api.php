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
{
  Route::post('/presencebymonitor', 'PresenceController@changePresence');
  Route::post('/presencebyqrcode', 'PresenceController@markPresenceqrcode');
  Route::post('/studentsbyexam', 'ExamenController@getListStudents');
  Route::post('/getbeaconsbyexam', 'ExamenController@getListBeacons');
  Route::post('/setbeaconsbyexam', 'ExamenController@addListBeacons');
  Route::get('/beacons', 'BeaconController@getListBeacons');
  Route::post('/addbeacon', 'BeaconController@addBeacon');
  Route::get('/freebeacons', 'BeaconController@getListFreeBeacons');
  Route::post('/retrievebeaconfromexam', 'BeaconController@detachBeacon');
  Route::post('/deletebeacon', 'BeaconController@deleteBeacon');
  Route::post('/getbeacon', 'BeaconController@getBeacon');
  
});

 