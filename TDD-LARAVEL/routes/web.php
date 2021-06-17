<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->post('auth/register', 'AuthController@register');
$router->post('auth/login',  'AuthController@login');

$router->get('user/profile', 'UserController@profile');
$router->get('user/singleUser', 'UserController@singleUser');
$router->get('user/allUsers',  'UserController@allUsers');

$router->get('cliente/show[/{id}]',  'ClienteController@show');
$router->put('cliente/update/{id}',  'ClienteController@update');
$router->post('cliente/store',  'ClienteController@store');
$router->delete('cliente/delete/{id}',  'ClienteController@delete');

$router->get('distribuidor/show[/{id}]',  'DistribuidorController@show');
$router->put('distribuidor/update/{id}', 'DistribuidorController@update');
$router->post('distribuidor/store',  'DistribuidorController@store');
$router->delete('distribuidor/delete/{id}', 'DistribuidorController@delete');

$router->get('aplicativo/show[/{id}]',  'PosAplicativoController@show');
$router->put('aplicativo/update/{id}',  'PosAplicativoController@update');
$router->post('aplicativo/store',  'PosAplicativoController@store');
$router->delete('aplicativo/delete/{id}',  'PosAplicativoController@delete');

$router->get('situacao/show[/{id}]',  'PosSituacaoController@show');
$router->put('situacao/update/{id}',  'PosSituacaoController@update');
$router->post('situacao/store',  'PosSituacaoController@store');
$router->delete('situacao/delete/{id}',  'PosSituacaoController@delete');

$router->get('pos/show[/{id}]',  'PosController@show');
$router->put('pos/update/{id}',  'PosController@update');
$router->post('pos/store',  'PosController@store');
$router->delete('pos/delete/{id}',   'PosController@delete');

$router->put('pos/alterar/situacao/por/cliente/{id_cliente}/{id_pos_situacao}','PosController@alterarSituacaoPosPorCliente');

$router->post('user/vincular/distribuidor/{id_usuario}/{id_distribuidor}','UserController@vincularDistribuidor');

