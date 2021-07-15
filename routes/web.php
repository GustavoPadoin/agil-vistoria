<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::name('site.')->group(function () {

    Route::resources(['' => SiteController::class ]);
});

Route::post('carros', ['uses' => 'App\Http\Controllers\SiteController@carros']);
Route::post('horarios', ['uses' => 'App\Http\Controllers\SiteController@horarios']);

Route::get('admin', ['as' => 'admin', 'uses' => 'App\Http\Controllers\LoginController@index']);
Route::post('admin/entrar', ['as' => 'admin.entrar', 'uses' => 'App\Http\Controllers\LoginController@entrar']);
Route::get('admin/sair', ['as' => 'admin.sair', 'uses' => 'App\Http\Controllers\LoginController@sair']);

Route::group(['middleware' => 'auth'], function(){
    
    Route::resources(['vistoria' => VistoriaController::class]);
    Route::resources(['servico' => ServicoController::class]);
    Route::resources(['cidade' => CidadeController::class]);
    Route::resources(['marca' => MarcaController::class]);
    Route::resources(['modelo' => ModeloController::class]);
    Route::resources(['usuario' => UsuarioController::class]);
    Route::post('vistoria/filtro', ['as' => 'vistoria.filtro', 'uses' => 'App\Http\Controllers\VistoriaController@filtro']);
});