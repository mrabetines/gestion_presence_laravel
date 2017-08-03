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
Route::group(array('prefix' => 'api/v1'), function()
{
  Route::get('/beacons', 'BeaconController@getListBeacons');
  Route::post('/presence', 'PresenceController@markPresence');
  Route::post('/student', 'EtudiantController@login');
});
