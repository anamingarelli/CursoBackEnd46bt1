<?php

use App\Http\Controllers\DahboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use Illuminate\Support\Facades\Route;

//1. Redirecionamento do Dashboard
Route::redirect("/", "/dashboard");

//2. Rota do Painel Executivo
Route::get("/dashboard", [DahboardController::class, "index"])->name("dashboard");

//3. Módulo de Equipamentos
Route::prefix("equipamentos")->name("equipamentos.")->group(function () {
    Route::get("/", [EquipamentoController::class, "index"])->name("index");
});

//4. Módulo de Ordem de Serfviços
Route::prefix('ordens')->name('ordens.')->group(function () {
    Route::get('/', [OrdemServicoController::class, 'index'])->name('index');
    Route::get('/nova', [OrdemServicoController::class, 'create'])->name('create');
    Route::post('/', [OrdemServicoController::class, 'store'])->name('store');
    Route::get('/{codigo}', [OrdemServicoController::class, 'show'])->name('show');
});
