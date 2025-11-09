<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo responsável pelos papéis (roles) do sistema.
 *
 * Cada papel define um conjunto de permissões (abilities) que podem ser atribuídas a usuários.
 * Esse model gerencia também o status e o controle de exclusão lógica.
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property string|null $description
 * @property bool $excluido
 */
class Role extends Model
{
    use HasFactory;

    /**
     * Indica que a tabela não utiliza timestamps (created_at / updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Nome da chave primária.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Campos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'status', 'description'];

    // ---------------------------------------------------------
    // Constantes de status
    // ---------------------------------------------------------

    public const STATUS_ATIVO = 'AT';
    public const STATUS_INATIVO = 'IN';

    /**
     * Mapeamento dos status com seus respectivos rótulos legíveis.
     *
     * @var array<string, string>
     */
    public static $statusLabels = [
        self::STATUS_ATIVO => 'Ativo',
        self::STATUS_INATIVO => 'Inativo',
    ];

    // ---------------------------------------------------------
    // Relações
    // ---------------------------------------------------------

    /**
     * Relação muitos-para-muitos com as abilities (permissões).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'ability_role', 'role_id', 'ability_id');
    }

    /**
     * Relação muitos-para-muitos com usuários.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_usuario');
    }

    // ---------------------------------------------------------
    // Métodos auxiliares
    // ---------------------------------------------------------

    /**
     * Retorna o rótulo legível do status atual do papel.
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    /**
     * Reverte a exclusão lógica (marca o registro como não excluído).
     *
     * @return bool
     */
    public function restoreFromDeleted(): bool
    {
        $this->excluido = false;
        return $this->save();
    }
}
