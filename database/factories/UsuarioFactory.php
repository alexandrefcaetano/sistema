<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => Usuario::STATUS_ATIVO,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'data_nascimento' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['MA','FE']),
            'password' => Hash::make(Usuario::SENHA_PADRAO),
            'contato' => json_encode([
                ['tipo' => 'celular', 'descricao' => $this->faker->phoneNumber(), 'flg_principal' => true],
            ]),
            'excluido' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
