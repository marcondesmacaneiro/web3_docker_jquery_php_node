<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'pessoa'], function () {

    // Route::get('', function() {
    //     return 'Devolver a lista de usuários';
    // });

    // Route::get('{id}', function($id){
    //     return 'Devolver o usuario ' . $id;
    // });

    // Route::post('', function() {
    //     return 'Criar um novo usuário baseado na informoção recebida';
    // });

    // Route::put('{id}', function($id) {
    //     return 'Atualizar o usuário ID ' . $id;
    // });

    // Route::delete('{id}', function($id) {
    //     return 'Remover o usuário de ID ' . $id;
    // });

    Route::get('', 'PessoaController@todasPessoas');

    Route::get('{id}', 'PessoaController@getPessoa');

    Route::post('', 'PessoaController@salvarPessoa');

    Route::put('{id}', 'PessoaController@atualizarPessoa');

    Route::delete('{id}', 'PessoaController@deletarPessoa');

});
