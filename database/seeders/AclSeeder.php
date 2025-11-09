<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Module;
use App\Models\Ability;

class AclSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Recupera roles existentes (criados no RoleSeeder)
        $admin = Role::where('name', 'Administrador')->first();
        $usuario = Role::where('name', 'Usuário')->first();
        $convidado = Role::where('name', 'Convidado')->first();

        // 🔹 Módulos
        $usuarios = Module::create([
            'name' => 'usuarios',
            'display_name' => 'Usuários'
        ]);

        $permissoes = Module::create([
            'name' => 'permissoes',
            'display_name' => 'Permissões'
        ]);

        // 🔹 Abilities de "Usuários"
        $abilitiesUsuarios = [
            ['name' => 'list', 'display_name' => 'Listar'],
            ['name' => 'create', 'display_name' => 'Criar'],
            ['name' => 'edit', 'display_name' => 'Editar'],
            ['name' => 'delete', 'display_name' => 'Excluir'],
        ];
        foreach ($abilitiesUsuarios as $a)
            $usuarios->abilities()->create($a);

        // 🔹 Abilities de "Permissões"
        $abilitiesPermissoes = [
            ['name' => 'list', 'display_name' => 'Listar'],
            ['name' => 'edit', 'display_name' => 'Editar'],
        ];
        foreach ($abilitiesPermissoes as $a)
            $permissoes->abilities()->create($a);

        // 🔹 Vincular abilities aos roles existentes
        $allAbilities = Ability::all();

        if ($admin) {
            // Admin tem tudo
            $admin->abilities()->sync($allAbilities->pluck('id'));
        }

        if ($usuario) {
            // Usuário tem apenas list e create em Usuários
            $usuarioAbilities = Ability::whereHas('module', fn($m) => $m->where('name', 'usuarios'))
                ->whereIn('name', ['list', 'create'])
                ->pluck('id');
            $usuario->abilities()->sync($usuarioAbilities);
        }

        if ($convidado) {
            // Convidado só pode listar usuários
            $guestAbilities = Ability::whereHas('module', fn($m) => $m->where('name', 'usuarios'))
                ->where('name', 'list')
                ->pluck('id');
            $convidado->abilities()->sync($guestAbilities);
        }
    }
}
