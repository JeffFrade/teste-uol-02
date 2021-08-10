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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'alunos'], function () {
        Route::get('/', 'AlunoController@index')->name('alunos.index');
        Route::get('/create', 'AlunoController@create')->name('alunos.create');
        Route::post('/store', 'AlunoController@store')->name('alunos.store');
        Route::get('/edit/{id}', 'AlunoController@edit')->name('alunos.edit');
        Route::put('/update/{id}', 'AlunoController@update')->name('alunos.update');
        Route::delete('/delete/{id}', 'AlunoController@delete')->name('alunos.delete');
    });

    Route::group(['prefix' => 'cursos'], function () {
        Route::get('/', 'CursoController@index')->name('cursos.index');
        Route::get('/create', 'CursoController@create')->name('cursos.create');
        Route::post('/store', 'CursoController@store')->name('cursos.store');
        Route::get('/edit/{id}', 'CursoController@edit')->name('cursos.edit');
        Route::put('/update/{id}', 'CursoController@update')->name('cursos.update');
        Route::delete('/delete/{id}', 'CursoController@delete')->name('cursos.delete');
    });

    Route::group(['prefix' => 'matriculas'], function () {
        Route::get('/', 'MatriculaController@index')->name('matriculas.index');
    });
});
