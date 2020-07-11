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

######################################### start offer ######################################
// https://www.hyperpay.com/
Route::group(['prefix' => 'offers', 'middleware' => 'auth', 'namespace' => 'Advance'], function () {

    Route::get('/', 'OfferController@index')->name('offers');
    Route::get('/create', 'OfferController@create')->name('offer.create');
    Route::post('/store', 'OfferController@store')->name('offer.store');
    Route::get('/details/{id}', 'OfferController@details')->name('offers.details');
    Route::get('/orders/{offer_id}', 'OfferController@orders')->name('offers.orders');

    ################################ start CheckOut ####################
    Route::get('/prepare_cheack_out', 'PaymentController@prepareCheckOut')->name('offers.cheackOut');
    ################################ end CheckOut ####################


    ################################ start sending mail in background ####################
    Route::get('/send-mail-background', 'SendingMainBackgroundController@sendingMail')->name('mail.background');
    ################################ end sending mail in background ####################

    ################################ start 10000 winner background ####################
    Route::get('/select-winner', 'WinnerController@getform')->name('winner-form');
    Route::post('/save-winner', 'WinnerController@saveWinner')->name('winner.save');
    ################################ end 10000 winner background ####################





});
######################################### end offer ######################################
