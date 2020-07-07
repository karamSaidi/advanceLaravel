<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home/{id?}', 'HomeController@index')->name('home');

######################################### start pusher ######################################
Route::group(['prefix' => 'pusher', 'namespace' => 'Advance'], function () {

    Route::get('/{id?}', 'PusherController@index')->name('pusher');
    Route::post('/comment/add/{post_id}', 'PusherController@addComment')->name('add.comment');

});
######################################### end pusher ######################################
