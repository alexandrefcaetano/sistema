<?php

namespace App\Providers;

use App\Models\Ability;
use App\Models\Usuario;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        if (!Schema::hasTable('abilities') || !Schema::hasTable('modules')) {
            return;
        }

        $abilities = Ability::with('module')->get();

        foreach ($abilities as $ability) {
            if (!$ability->module) continue;

            $fullName = $ability->module->name . '.' . $ability->name;

            Gate::define($fullName, function (Usuario $user) use ($ability) {
                return $user->abilities()->contains('id', $ability->id);
            });
        }

    }
}
