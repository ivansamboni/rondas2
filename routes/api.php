<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/useridlogin', function () {
    return auth()->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auditardelete/{auditoria}', [App\Http\Controllers\AuditarController::class, 'auditdelete']);

Route::get('/auditorias', [App\Http\Controllers\AuditarController::class, 'auditoriaslist']);

Route::get('/auditoriasshow/{auditoria}', [App\Http\Controllers\AuditarController::class, 'auditshow']);

Route::get('/estrategialist', [App\Http\Controllers\AuditarController::class, 'estralist']);

Route::get('/estrategiashow/{id}', [App\Http\Controllers\AuditarController::class, 'estrashow']);

Route::post('/users', [App\Http\Controllers\ReguserController::class, 'newuser']);

Route::get('/showuser/{id}', [App\Http\Controllers\ReguserController::class, 'showuser']);

Route::put('/updateuser/{id}', [App\Http\Controllers\ReguserController::class, 'updateuser']);

Route::get('/users/{id}', [App\Http\Controllers\ReguserController::class, 'deleteuser']);

Route::get('/userlist', [App\Http\Controllers\ReguserController::class, 'userlist']);

Route::resource('/estrategias', App\Http\Controllers\EstrategiaController::class)
->only(['index','store','update','show','edit','destroy']);

Route::get('/estrategiaeditar/{id}', [App\Http\Controllers\EstrategiaController::class, 'fetch' ]);

Route::resource('/items', App\Http\Controllers\ItemController::class)
->only(['index','store','update','show','destroy',]);

Route::resource('/servicios', App\Http\Controllers\ServicioController::class)
->only(['index','store','update','show','edit','destroy']);

Route::resource('/cargos', App\Http\Controllers\CargoController::class)
->only(['index','store','update','show','edit','destroy']);


