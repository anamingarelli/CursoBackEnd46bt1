<?php
declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\OrdemServicoController;
use Illuminate\Support\Facades\Route;

// 1. Redirecionamento da Raiz para o Painel de Controle
Route::redirect('/', '/dashboard');

// 2. Rota do Painel Executivo
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 3. Modulo de Equipamentos Industriais (CRUD completo sem tela show)
Route::resource('equipamentos', EquipamentoController::class)->except(['show']);

// 4. Modulo de Ordens de Servico (CRUD completo com Route Model Binding por codigo)
Route::resource('ordens', OrdemServicoController::class)->parameters(['ordens' => 'ordem']);