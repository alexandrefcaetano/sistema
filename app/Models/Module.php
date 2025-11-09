<?php

namespace App\Models;

use App\Scopes\ExcluidoScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Modelo responsável pelos módulos do sistema.
 *
 * Cada módulo agrupa um conjunto de abilities (permissões específicas).
 * Utiliza um escopo global para filtrar registros não excluídos.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string|null $description
 * @property string $status
 * @property bool $excluido
 * @property-read string $status_badge
 */
class Module extends BaseModel
{
    use HasFactory;

    /**
     * Campos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'display_name', 'description', 'status', 'excluido'];

    // ---------------------------------------------------------
    // Constantes de status
    // ---------------------------------------------------------

    public const STATUS_ATIVO = 'AT';
    public const STATUS_INATIVO = 'IN';

    /**
     * Mapeamento dos status com rótulos legíveis.
     *
     * @var array<string, string>
     */
    public static $statusLabels = [
        self::STATUS_ATIVO => 'Ativo',
        self::STATUS_INATIVO => 'Inativo',
    ];

    // ---------------------------------------------------------
    // Eventos do Eloquent
    // ---------------------------------------------------------

    /**
     * Adiciona o escopo global para filtrar registros excluídos logicamente.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ExcluidoScope);
    }

    // ---------------------------------------------------------
    // Métodos auxiliares
    // ---------------------------------------------------------

    /**
     * Retorna o rótulo legível do status atual do módulo.
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return self::$statusLabels[$this->status] ?? $this->status;
    }

    // ---------------------------------------------------------
    // Relações
    // ---------------------------------------------------------

    /**
     * Relação um-para-muitos com abilities (permissões) pertencentes ao módulo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }

    /**
     * Retorna o HTML de um badge representando o status atual.
     *
     * @return string
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_ATIVO =>
            '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Ativo</span>',
            self::STATUS_INATIVO =>
            '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Inativo</span>',
            default =>
            '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">Desconhecido</span>',
        };
    }
}
