<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('candidates', 'App\Http\Controllers\CandidateController@index');
Route::group(['prefix' => 'candidate'], function () {
    Route::post('create', 'App\Http\Controllers\CandidateController@create');
    Route::get('edit/{id}', 'App\Http\Controllers\CandidateController@edit');
    Route::post('update/{id}', 'App\Http\Controllers\CandidateController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\CandidateController@destroy');
});