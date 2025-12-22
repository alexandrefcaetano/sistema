<?php

namespace App\Models;

use App\Traits\Auditavel;
use Illuminate\Database\Eloquent\Model;

class Dossie extends Model
{
    use Auditavel;

    protected $table = 'tb_dossie';
    protected $primaryKey = 'sq_dossie';
    public $timestamps = false;

    protected $fillable = [
        'cd_solicitacao',
        'cd_tipo_documento_dossie',
        'cd_dossie_destino',
        'cd_produto_conta',
        'cd_tipo_dossie',
        'cd_status',
        'dn_cpf_cnpj',
        'ds_motivo_abertura',
        'nr_ordem_conta',
        'cd_especie_conta',
        'nr_conta',
        'ds_chave_negocio',


        'cd_dependencia',
        'no_unidade',
        'nr_telefone',
        'dt_emissao',

        'nr_matricula_create',
        'dt_create',
        'nr_matricula_atualizacao',
        'dt_update',
    ];

    protected $casts = ['dt_create' => 'datetime','dt_update' => 'datetime', 'dt_emissao' => 'datetime'];

    public function solicitacao()
    {
        return $this->belongsTo(
            Solicitacao::class,
            'cd_solicitacao',
            'cd_solicitacao'
        );
    }

    public function destino()
    {
        return $this->belongsTo(
            DossieDestino::class,
            'cd_dossie_destino',
            'cd_dossie_destino'
        );
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(
            TipoDocumentoDossie::class,
            'cd_tipo_documento_dossie',
            'cd_tipo_documento_dossie'
        );
    }

    public function tipoDossie()
    {
        return $this->belongsTo(
            TipoDossie::class,
            'cd_tipo_dossie',
            'cd_tipo_dossie'
        );
    }

    public function status()
    {
        return $this->belongsTo(
            Status::class,
            'cd_status',
            'cd_status'
        );
    }
}
