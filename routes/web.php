<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('pages.home');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('page.dashboard');

//Rotas Arquivos
Route::get('/archive/index', [CardController::class, 'index'])->name('archive.index');
Route::get('/archive/create', [CardController::class, 'create'])->name('archive.create');
Route::get('/archive/edit/{id}', [CardController::class, 'edit'])->name('archive.edit');
Route::post('/archive/store', [CardController::class, 'store'])->name('archive.store');
Route::put('/archive/update/{id}', [CardController::class, 'update'])->name('archive.update');
Route::delete('/archive/delete/{id}', [CardController::class, 'delete'])->name('archive.delete');

//Rotas Gerenciar
Route::get('/manager/archive/{id}', [ManagerController::class, 'index'])->name('manager.index');

//Rotas Informação
Route::get('/info/create/{id}', [InfoController::class, 'create'])->name('info.create');
Route::get('/info/edit/{id}', [InfoController::class, 'edit'])->name('info.edit');
Route::post('/info/store', [InfoController::class, 'store'])->name('info.store');
Route::put('/info/update/{id}', [InfoController::class, 'update'])->name('info.update');
Route::delete('/info/delete/{id}', [InfoController::class, 'delete'])->name('info.delete');

//Rotas Locatário
Route::get('/renter/index', [RenterController::class, 'index'])->name('renter.index');
Route::get('/renter/create', [RenterController::class, 'create'])->name('renter.create');
Route::get('/renter/edit/{id}', [RenterController::class, 'edit'])->name('renter.edit');
Route::post('/renter/store', [RenterController::class, 'store'])->name('renter.store');
Route::put('/renter/update/{id}', [RenterController::class, 'update'])->name('renter.update');
Route::delete('/renter/delete/{id}', [RenterController::class, 'delete'])->name('renter.delete');


//Rotas Relatório
Route::get('/report', [ReportController::class, 'index'])->name('report.index');

//Rota PDF
Route::get('/card/pdf/{id}', [PdfController::class, 'generate']);