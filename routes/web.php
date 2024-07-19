<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'FriendsOfBotble\Iyzipay\Http\Controllers', 'middleware' => ['core']], function () {
    Route::post('iyzipay/payment/callback', [
        'as'   => 'iyzipay.payment.callback',
        'uses' => 'IyzipayController@getCallback',
    ]);

    Route::post('iyzipay/payment/refund', [
        'as'   => 'iyzipay.payment.refund',
        'uses' => 'IyzipayController@getRefund',
    ]);
});
