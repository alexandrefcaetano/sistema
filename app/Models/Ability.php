<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model responsável por representar as *habilidades* (abilities) do sistema.
 *
 * Cada *Ability* está vinculada a um determinado módulo (`module_id`) e pode
 * ser associada a múltiplos papéis (`roles`) através da tabela pivot `role_ability`.
 *
 * @property int         $id
 * @property int         $module_id
 * @property string      $name
 * @property string|null $display_name
 * @property-read \App\Models\Module $module
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 */
class Ability extends BaseModel
{
    use HasFactory;

    /**
     * Indica que o modelo não possui timestamps automáticos.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Nome da tabela associada.
     *
     * @var string
     */
    protected $table = 'abilities';

    /**
     * Chave primária da tabela.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module_id',
        'name',
        'display_name',
    ];

    /**
     * Relacionamento muitos-para-muitos com o model Role.
     *
     * Uma habilidade pode pertencer a diversos papéis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'ability_role',
            'ability_id',
            'role_id'
        );
    }

    /**
     * Relacionamento de pertencimento a um módulo.
     *
     * Cada habilidade pertence a um único módulo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
