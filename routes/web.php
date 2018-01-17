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

Route::get('/', 'LinkController@index')->name('home');
// name() serve para gerar urls ou redirecionar para as rotas pelo nome

Route::get('/criar', 'LinkController@adicionar')->name('criarLink');
Route::post('/salvar', 'LinkController@salvar')->name('salvarLink');
Route::get('/deletar/{id}', 'LinkController@deletar')->name('deletarLink');

Route::get('/editar/{id}', 'LinkController@editar')->name('editarLink');
Route::post('/atualizar/{id}', 'LinkController@atualizar');

Route::get('/{categoria}', 'LinkController@index');
// importante deixar esta rota por último para não interceptar as demais rotas
