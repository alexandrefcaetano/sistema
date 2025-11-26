<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Model responsável por representar os usuários do sistema.
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string|null $password
 * @property string      $status
 * @property array|null  $contato
 * @property string|null $cpf
 * @property \Carbon\Carbon|null $data_nascimento
 * @property string|null $sexo
 * @property bool        $excluido
 * @property-read \App\Models\Role|null $role
 */
class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';

    // Constantes de status
    const STATUS_ATIVO = 'AT';
    const STATUS_BLOQUEADO = 'BL';
    const STATUS_INATIVO = 'IN';
    const STATUS_CANCELADO = 'CA';
    const STATUS_PENDENTE = 'PE';
    const SENHA_PADRAO = 'BRB@2025';

    public static $statusLabels = [
        self::STATUS_ATIVO => 'Ativo',
        self::STATUS_BLOQUEADO => 'Bloqueado',
        self::STATUS_INATIVO => 'Inativo',
        self::STATUS_CANCELADO => 'Cancelado',
        self::STATUS_PENDENTE => 'Pendente',
    ];



    /**
     * Retorna o label legível do status.
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    protected $fillable = [
        'name', 'email', 'password', 'status',
        'contato', 'cpf', 'data_nascimento', 'sexo', 'excluido',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'excluido' => 'boolean',
        'contato' => 'array',
        'data_nascimento' => 'date',
        'senha_padrao' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('nao_excluido', function (Builder $builder) {
            $builder->where('excluido', false);
        });
    }

    public function scopeWithExcluded(Builder $builder)
    {
        return $builder->withoutGlobalScope('nao_excluido');
    }

    public function markAsDeleted(): bool
    {
        $this->excluido = true;
        return $this->save();
    }

    public function restoreFromDeleted(): bool
    {
        $this->excluido = false;
        return $this->save();
    }

    public function resetToDefaultPassword(): bool
    {
        $this->password = self::SENHA_PADRAO;
        return $this->save();
    }

    /**
     * Relacionamento com a Role (papel do usuário).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function role()
//    {
//        return $this->belongsTo(Role::class, 'role_id');
//    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_usuario', 'usuario_id', 'role_id');
    }

    public function getAuthIdentifierName()
    {
        return 'cpf';
    }

    public function abilities()
    {
        return $this->roles()
            ->with('abilities')
            ->get()
            ->pluck('abilities')
            ->flatten()
            ->unique('id');
    }


    public function hasRole($roleName): bool
    {
        return $this->roles->contains('name', $roleName);
    }

    public function hasAbility($abilityName): bool
    {
        return $this->abilities()->contains('name', $abilityName);
    }

    public function hasAbilityRota(string $ability): bool
    {
        // abilities() retorna uma collection de abilities
        return $this->abilities()
            ->map(function ($ab) {
                // Concatenando módulo + nome da permissão
                return $ab->module->name . '.' . $ab->name;
            })
            ->contains($ability);
    }
    protected function dataNascimento(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->format('d/m/Y'),
            set: fn ($value) => \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
        );
    }
}
