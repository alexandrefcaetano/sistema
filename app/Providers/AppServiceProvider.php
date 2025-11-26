<?php

namespace App\Providers;

use App\Models\Ability;
use App\Models\Usuario;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {

        Paginator::useBootstrap();
        // Evita erro durante migrações iniciais
        if (!Schema::hasTable('abilities') || !Schema::hasTable('modules')) {
            return;
        }

        // Carregar todas as abilities com module para montar o Gate correto
        $abilities = Ability::with('module')->get();
        //dd($abilities->map(fn($a) => $a->module->name . '.' . $a->name)->toArray());
        foreach ($abilities as $ability) {

            // Se não tiver módulo por alguma inconsistência do BD, ignora
            if (!$ability->module) {
                continue;
            }

            // Nome completo da ability → Module.create
            $fullName = $ability->module->name . '.' . $ability->name;

            Gate::define($fullName, function (Usuario $user) use ($ability) {
                return $user->abilities()->contains('id', $ability->id);
            });
        }

        // Super admin
//        Gate::before(function (Usuario $user, $ability) {
//            if ($user->hasRole('Administrador')) {
//                return true;
//            }
//        });
    }
}
