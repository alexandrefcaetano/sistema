<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissaoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.execute');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('usuario')->group(function () {
        Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
        Route::post('/', [UsuarioController::class, 'store'])->name('usuario.store');

        Route::get('/edit/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

        Route::get('/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
        Route::get('/', [UsuarioController::class, 'index'])->name('usuario.index');
    });

    Route::prefix('permissao')->group(function () {
        Route::get('/create', [PermissaoController::class, 'create'])->name('permissao.create');
        Route::post('/', [PermissaoController::class, 'store'])->name('permissao.store');

        Route::get('/edit/{id}', [PermissaoController::class, 'edit'])->name('permissao.edit');
        Route::put('/{id}', [PermissaoController::class, 'update'])->name('permissao.update');
        Route::delete('/{id}', [PermissaoController::class, 'destroy'])->name('permissao.destroy');

        Route::get('/{id}', [PermissaoController::class, 'show'])->name('permissao.show');
        Route::get('/', [PermissaoController::class, 'index'])->name('permissao.index');
        Route::put('/{id}/restore', [PermissaoController::class, 'restore'])->name('permissao.restore');

    });

    Route::prefix('module')->group(function () {
        Route::get('/create', [ModuleController::class, 'create'])->name('module.create');
        Route::get('/', [ModuleController::class, 'index'])->name('module.index');
        Route::post('/', [ModuleController::class, 'store'])->name('module.store');

        Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('module.edit');
        Route::put('/{id}', [ModuleController::class, 'update'])->name('module.update');
        Route::delete('/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');

        Route::get('/{id}', [ModuleController::class, 'show'])->name('module.show');
        Route::get('/', [ModuleController::class, 'index'])->name('module.index');
    });
});





