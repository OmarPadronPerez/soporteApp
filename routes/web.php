<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\correosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

//rutas login/logout
Route::GET('/',[LoginController::class, 'index']);
Route::GET('/login',[LoginController::class, 'index'])->name('login');
Route::POST('/aunt',[LoginController::class, 'login']);
Route::get('/revisarLogin',[LoginController::class, 'revisarSecion'])->name('revisarLogin');
Route::GET('/logout',[LoginController::class, 'logout'])->name('logout');

//rutas ticket
Route::GET('/nuevo',[TicketsController::class, 'crearTicket'])->middleware('auth')->name('nuevo');
Route::POST('/nuevo/envtkt',[TicketsController::class, 'store'])->middleware('auth');
Route::GET('tickets',[TicketsController::class, 'verTickets'])->name('tickets')->middleware('auth');
Route::GET('tickets/{id}',[TicketsController::class, 'verTicketsid'])->middleware('auth');
Route::GET('tickets/{id}/{file}',[TicketsController::class, 'descagarArchivo'])->middleware('auth');

Route::GET('historial',[TicketsController::class,'historialTicket'])->name('historial')->middleware('auth');
Route::GET('completo/{id}',[TicketsController::class, 'verTicketCompleto'])->middleware('auth');
Route::POST('/tckActualizar',[TicketsController::class,'actualizar'])->name('tckActualizar')->middleware('auth');

//rutas administrar usuario
Route::GET('usuarios',[UsuarioController::class,'verUsuarios'])->name('usuarios')->middleware('auth');
Route::GET('usuarios/{id}',[UsuarioController::class,'actUsuario'])->middleware('auth');
Route::POST('gUsuario',[UsuarioController::class,'gUsuario'])->middleware('auth');
Route::get('nuevoUsuario',[UsuarioController::class,'index'])->middleware('auth');
Route::POST('nuevoUsuario/nsStorage',[UsuarioController::class,'store'])->name('usuario.store');
Route::get('usuarios/{id}/pdf',[UsuarioController::class,'exportarApdf'])->middleware('auth');
Route::get('mi_informacion',[UsuarioController::class,'mi_informacion'])->middleware('auth')->name('mi_informacion');
Route::GET('directorio',[UsuarioController::class,'verUsuarios'])->name('usuarios')->middleware('auth');


//rutas administrar reportes
Route::GET('/reportes',[ReportesController::class,'index'])->middleware('auth')->name('verReportes');
Route::GET('reportes/excel',[ReportesController::class,'export'])->middleware('auth')->name('reportesxslx');

//correos
Route::get('/nuevo/mailTicketNuevo/{id}',[correosController::class,'nuevoTicket'])->name('email.ticketnuevo')->middleware('auth');
Route::get('/nuevo/mailTicketActualizado/{id}',[correosController::class,'actualizarTicket'])->name('email.actualizarTicket')->middleware('auth');
Route::get('/nuevo/mailTicketCerrado/{id}',[correosController::class,'cerradoTicket'])->name('email.ticketcerrado')->middleware('auth');

//Empresas
Route::get( '/empresas',[EmpresasController::class,'index'])->name('verEmpresas')->middleware('auth');
Route::get( '/empresas/{id}',[EmpresasController::class,'verEmpresa'])->name('verEmpresa')->middleware('auth');
Route::get( '/empresa/nuevaEmpresa',[EmpresasController::class,'nuevaEmpresa'])->name('nuevaEmpresa')->middleware('auth');
Route::POST('/empresas/guardarEmpresa',[EmpresasController::class,'store'])->name('guardarEmpresas')->middleware('auth');
Route::POST('/empresas/ActualizarEmpresa',[EmpresasController::class,'update'])->name('guardarEmpresas')->middleware('auth');
