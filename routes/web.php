<?php

Route::auth();

// Product Routes
Route::get('/', [
    'uses' => 'ProductController@index',
    'as' => 'index',
    'middleware' => 'auth'
]);

// Order Routes
Route::get('/admin', [
    'uses' => 'OrderController@getAllOrders',
    'as' => 'admin',
    'middleware' => 'admin'
]);

Route::post('/pay/{product}', [
    'uses' => 'OrderController@postPayWithStripe',
    'as' => 'pay',
    'middleware' => 'auth'
]);

Route::post('/store', [
    'uses' => 'OrderController@postPayWithStripe',
    'as' => 'store',
    'middleware' => 'auth'
]);
Route::post('/selects/{product}', [
    'uses' => 'ProductController@selects',
    'as' => 'selects',
    'middleware' => 'auth'
]);

Route::any('/wechat/{product}', [
    'uses' => 'WechatController@wechat',
    'as' => 'wechat',
    'middleware' => 'auth'
]);

Route::post('/payment', [
    'uses' => 'ProductController@payment',
    'as' => 'payment',
    'middleware' => 'auth'
]);