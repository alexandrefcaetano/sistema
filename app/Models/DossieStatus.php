<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossieStatus extends Model
{
    protected $table = 'tb_dossie_status';
    protected $primaryKey = 'sq_dossie_status';
    public $timestamps = false;

    protected $fillable = [
        'sq_dossie',
        'st_contrato_unico',
        'st_ficha_qualificacao_pf',
        'st_doc_identificacao',
        'st_nao_consta',
        'st_doc_confere_original',
        'st_assinatura_conferida',
        'st_renda_presumida',
        'st_renda_automatica',
        'st_renda_anexa',
        'st_cartao_assinatura',
        'st_comprovante_renda',
        'st_cartao_cnpj',
        'st_contrato_social',
        'st_faturamento',
        'st_outro',
        'st_ficha_qualificacao_pj'
    ];

    public function dossieConta()
    {
        return $this->belongsTo(Dossie::class, 'sq_dossie');
    }
}
