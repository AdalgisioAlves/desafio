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
    return response()->json('', 200, $headers);;
});
Route::get('/cliente', 'ClientesController@index');// Novo cliente 
Route::post('/cliente/store', 'ClientesController@store');// Novo cliente
Route::post('/cliente/saldo', 'ClientesController@saldo');// Novo cliente
Route::post('/cliente/deposito', 'ClientesController@deposito');// Novo cliente
Route::post('/cliente/saque', 'ClientesController@saque');// Novo cliente
 