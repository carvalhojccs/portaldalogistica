<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    /*
     * Gestão de telefones
     */
    Route::post('telefones','TelefoneController@store')->name('telefones.store');
    Route::get('telefones/destroy/{id}','TelefoneController@destroy');
    
    /*
     * Gestão de colaboradores
     */
    Route::post('colaboradores','ColaboradorController@store')->name('colaboradores.store');
    Route::get('colaboradores/destroy/{id}','ColaboradorController@destroy');
        
    /*
     * Empenhos
     */
    Route::any('empenhos/search','EmpenhoController@search')->name('empenhos.search');
    Route::resource('empenhos','EmpenhoController');
    
   /*
     * Itens Empenhos
     */
    Route::any('itens_empenhos/search','ItemEmpenhoController@search')->name('itens_empenhos.search');
    Route::resource('itens_empenhos','ItemEmpenhoController');
    Route::post('itens_empenhos/store','ItemEmpenhoController@store')->name('itens_empenhos.store');
    Route::post('itens_empenhos/update','ItemEmpenhoController@update')->name('itens_empenhos.update');
    Route::get('itens_empenhos/destroy/{id}','ItemEmpenhoController@destroy');
    
    
    
    /*
     * Linhas de créditos
     */
    Route::any('linhas_creditos/search','LinhaCreditoController@search')->name('linhas_creditos.search');
    Route::resource('linhas_creditos','LinhaCreditoController');
    
    Route::any('empresas/search','EmpresaController@search')->name('empresas.search');
    Route::resource('empresas','EmpresaController');
    
    Route::any('users/search','UserController@search')->name('users.search');
    Route::resource('users','UserController');
    
    Route::any('locais/search','LocalController@search')->name('locais.search');
    Route::resource('locais','LocalController');
    
    Route::any('papeis/search','PapelController@search')->name('papeis.search');
    Route::resource('papeis','PapelController');
    
    Route::any('permissoes/search','PermissaoController@search')->name('permissoes.search');
    Route::resource('permissoes','PermissaoController');
    
    Route::get('dashboard','DashboardController@index')->name('dashboard.index');
    
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
