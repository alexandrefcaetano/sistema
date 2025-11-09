<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Administrador', 'status' => 'A','description' => 'Acesso total', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Usuário', 'status' => 'A','description' => 'Acesso de usuário', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Convidado', 'status' => 'I','description' => 'Acesso de convidado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
