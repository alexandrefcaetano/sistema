<?php


use App\Http\Controllers\AplicacaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DossieController;
use App\Http\Controllers\GeralController;
use App\Http\Controllers\PermissaoController;
use App\Http\Controllers\TedController;
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

    // Usuários
    Route::prefix('usuario')->group(function () {
        Route::get('/create', [UsuarioController::class, 'create'])
            ->middleware('ability:usuarios.create')->name('usuario.create');
        Route::post('/', [UsuarioController::class, 'store'])
            ->middleware('ability:usuarios.create')->name('usuario.store');

        Route::get('/edit/{id}', [UsuarioController::class, 'edit'])
            ->middleware('ability:usuarios.edit')->name('usuario.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])
            ->middleware('ability:usuarios.edit')->name('usuario.update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])
            ->middleware('ability:usuarios.delete')->name('usuario.destroy');

        Route::get('/{id}', [UsuarioController::class, 'show'])
            ->middleware('ability:usuarios.list')->name('usuario.show');
        Route::get('/', [UsuarioController::class, 'index'])
            ->middleware('ability:usuarios.list')->name('usuario.index');
    });


    // Permissões
    Route::prefix('permissao')->group(function () {
        Route::get('/create', [PermissaoController::class, 'create'])
            ->middleware('ability:Permissões.create')->name('permissao.create');
        Route::post('/', [PermissaoController::class, 'store'])
            ->middleware('ability:Permissões.create')->name('permissao.store');

        Route::get('/edit/{id}', [PermissaoController::class, 'edit'])
            ->middleware('ability:Permissões.update')->name('permissao.edit');
        Route::put('/{id}', [PermissaoController::class, 'update'])
            ->middleware('ability:Permissões.update')->name('permissao.update');
        Route::delete('/{id}', [PermissaoController::class, 'destroy'])
            ->middleware('ability:Permissões.delete')->name('permissao.destroy');

        Route::get('/{id}', [PermissaoController::class, 'show'])
            ->middleware('ability:Permissões.list')->name('permissao.show');
        Route::get('/', [PermissaoController::class, 'index'])
            ->middleware('ability:Permissões.list')->name('permissao.index');
        Route::put('/{id}/restore', [PermissaoController::class, 'restore'])
            ->middleware('ability:Permissões.ativar')->name('permissao.restore');
    });

    // Módulos
    Route::prefix('module')->group(function () {
        Route::get('/create', [ModuleController::class, 'create'])->middleware('ability:Module.create')->name('module.create');
        Route::get('/', [ModuleController::class, 'index'])->middleware('ability:Module.list')->name('module.index');
        Route::post('/', [ModuleController::class, 'store'])->middleware('ability:Module.create')->name('module.store');
        Route::get('/edit/{id}', [ModuleController::class, 'edit'])->middleware('ability:Module.update')->name('module.edit');
        Route::put('/{id}', [ModuleController::class, 'update'])->middleware('ability:Module.update')->name('module.update');
        Route::delete('/{id}', [ModuleController::class, 'destroy'])->middleware('ability:Module.delete')->name('module.destroy');
        Route::get('/{id}', [ModuleController::class, 'show'])->middleware('ability:Module.list')->name('module.show');
    });

});

Route::prefix('aplicacoes')->group(function () {
    Route::get('/create', [AplicacaoController::class, 'create'])->name('aplicacoas.create');
    Route::get('/', [AplicacaoController::class, 'index'])->name('aplicacoas.index');
    Route::get('{id}', [AplicacaoController::class, 'show'])->name('aplicacoes.show');
    Route::post('/', [AplicacaoController::class, 'store'])->name('aplicacoas.store');
    Route::get('/edit/{id}', [AplicacaoController::class, 'edit'])->name('aplicacoas.edit');
    Route::put('{id}', [AplicacaoController::class, 'update'])->name('aplicacoas.update');
    Route::delete('{id}', [AplicacaoController::class, 'destroy'])->name('aplicacoas.delete');
});


Route::prefix('json')->group(function () {
    Route::get('/dependencias/{cod}', [GeralController::class, 'dependencias'])
        ->name('geral.dependencias');
});


Route::prefix('ted')->group(function () {
    Route::get('/create', [TedController::class, 'create'])->name('ted.create');
    Route::get('/', [TedController::class, 'index'])->name('ted.index');
    Route::get('/{id}', [TedController::class, 'show'])->name('ted.show');
    Route::post('/', [TedController::class, 'store'])->name('ted.store');
    Route::get('/edit/{id}', [TedController::class, 'edit'])->name('ted.edit');
    Route::put('/{cd_ted}', [TedController::class, 'update'])->name('ted.update');
    Route::delete('{id}', [TedController::class, 'destroy'])->name('ted.destroy');
    Route::post('/atualizar/{cd_ted}', [TedController::class, 'atualizar'])->name('ted.atualizar');
});


Route::prefix('dossie')->group(function () {
    Route::get('/create', [DossieController::class, 'create'])->name('dossie.create');
    Route::get('/', [DossieController::class, 'index'])->name('dossie.index');
    Route::get('{id}', [DossieController::class, 'show'])->name('dossie.show');
    Route::post('/', [DossieController::class, 'store'])->name('dossie.store');
    Route::get('/edit/{id}', [DossieController::class, 'edit'])->name('dossie.edit');
    Route::put('{id}', [DossieController::class, 'update'])->name('dossie.update');
    Route::delete('{id}', [DossieController::class, 'destroy'])->name('dossie.destroy');
    Route::post('/atualizar/{cd_ted}', [DossieController::class, 'atualizar'])->name('dossie.atualizar');
});




