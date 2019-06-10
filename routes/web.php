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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login','Login\LoginController@login');//页面展示
//登录接收发送
Route::post('add','Login\LoginController@add');
Route::post('open','Login\LoginController@open');
Route::post('checklogin','Login\LoginController@checklogin');
Route::get('loginout','Login\LoginController@loginout');
Route::get('ren','ConterController@ren')->middleware('conter');
Route::get('wther','ConterController@wther');
Route::post('day','ConterController@day');
Route::get('check','CheckController@check');
Route::get('ToUrlParams','CheckController@ToUrlParams');
Route::get('setsign','CheckController@setsign');
Route::get('head','CheckController@head');
//搜索
Route::get('see','search\searchcontroller@check');
Route::post('sec','search\searchcontroller@sec');
Route::get('chat','search\searchcontroller@chat');
Route::post('ajax','search\searchcontroller@ajax');
Route::post('getphp','search\searchcontroller@getphp');