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


Route:: get('/api/cliente', 'ClientesController@index');// Novo cliente 
Route::post('/api/store', 'ClientesController@store');// Novo cliente
Route::post('/api/saldo', 'ClientesController@saldo');// Novo cliente
Route::post('/api/deposito', 'ClientesController@deposito');// Novo cliente
Route::post('/api/saque', 'ClientesController@saque');// Novo cliente