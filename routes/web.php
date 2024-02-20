<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/teste/{id}', 'PessoaController@show');

$router->get('/home', ['uses' => 'PessoaController@buscarTodos', 'as' => 'home']);
$router->get('/pessoa/{id}', ['uses' => 'PessoaController@buscarUm', 'as' => 'pessoa']);
$router->post('/salvar', 'PessoaController@salvar');
$router->post('/atualizar/{id}', 'PessoaController@atualizar');
$router->post('/excluir/{id}', 'PessoaController@excluir');
$router->post('/pesquisar', 'PessoaController@pesquisar');
$router->post('/validar', 'PessoaController@validarSequenciaColchetes');




