<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'FriendsOfBotble\Iyzipay\Http\Controllers', 'middleware' => ['core']], function () {
    Route::post('iyzipay/payment/callback', [
        'as'   => 'iyzipay.payment.callback',
        'uses' => 'IyzipayController@getCallback',
    ]);

    // iyzico's docs don't say whether the customer comes back with GET or POST, so accept both. The signature is
    // checked in the controller so a token iyzico may append doesn't invalidate it.
    Route::match(['GET', 'POST'], 'iyzipay/payment/refund', [
        'as'   => 'iyzipay.payment.refund',
        'uses' => 'IyzipayController@getRefund',
    ]);
});
