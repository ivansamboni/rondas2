<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/noregister', function () {
    return view('auth.noregister');
});


Auth::routes();

Route::group(['middleware' => 'auth'],  function () {
    
    Route::get('/usuarios', function () {
        return view('usuarios');
    })->middleware('checkUserRole:admin');

    Route::post('/enviarjs', [App\Http\Controllers\AuditarController::class, 'store']);
    Route::post('/users', [App\Http\Controllers\HomeController::class, 'newuser']);
    Route::get('/userlist', [App\Http\Controllers\HomeController::class, 'userlist']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/auditar', [App\Http\Controllers\RespuestaController::class, 'index'])->name('auditar');
    Route::get('/auditoria', [App\Http\Controllers\RespuestaController::class, 'buscar'])->name('auditoria');
    Route::post('/enviar', [App\Http\Controllers\RespuestaController::class, 'store']);
    
    Route::get('/ediciones', function () {
        return view('ediciones');
    })->middleware('checkUserRole:admin');

    Route::get('/auditar', function () {
        return view('auditarjs');
    });

    Route::get('/estrategias', function () {
        return view('ediciones');
    });

    Route::get('/servicios', function () {
        return view('ediciones');
    });
    
    Route::get('/cargos', function () {
        return view('ediciones');
    });
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/dashboard2', [App\Http\Controllers\Dashboard2Controller::class, 'consultasfecha']);
    Route::get('/dashboard3', [App\Http\Controllers\Dashboard3Controller::class, 'desagregarservicio']);
    Route::get('/observaciones', [App\Http\Controllers\HomeController::class, 'observacionesg']);
    Route::get('/sinacceso', function () {
        return view('sinacceso');
    })->name('sinacceso');
});
