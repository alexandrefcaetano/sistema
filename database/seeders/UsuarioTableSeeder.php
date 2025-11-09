<?php

namespace Database\Seeders;


use App\Models\Usuario;
use Illuminate\Database\Seeder;


class UsuarioTableSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::factory()->count(150)->create();
    }
}
