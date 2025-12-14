<?php


namespace App\Models;


use App\Traits\Auditavel;
use Illuminate\Database\Eloquent\Model;
class Dossie extends Model
{
    use Auditavel;
    protected $table = 'tb_dossie';
    protected $primaryKey = 'SQ_DOSSIE';
    public $timestamps = false;

    protected $fillable = [
        'CD_SOLICITACAO',
        'CD_TIPO_DOCUMENTO_DOSSIE',
        'CD_DOSSIE_DESTINO',
        'CD_PRODUTO_CONTA',
        'CD_TIPO_DOSSIE',
        'cd_status',
        'DN_CPF_CNPJ',
        'DS_MOTIVO_ABERTURA',
        'NR_ORDEM_CONTA',
        'CD_ESPECIE_CONTA',
        'NR_CONTA',
        'DS_CHAVE_NEGOCIO',
        'nr_matricula_create',
        'dt_create',
        'nr_matricula_atualizacao',
        'dt_update'
        ];


    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, 'CD_SOLICITACAO');
    }

    public function destino()
    {
        return $this->belongsTo(DossieDestino::class, 'CD_DOSSIE_DESTINO');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumentoDossie::class, 'CD_TIPO_DOCUMENTO_DOSSIE');
    }

    public function tipoDossie()
    {
        return $this->belongsTo(TipoDossie::class, 'CD_TIPO_DOSSIE');
    }

    public function statusDossie()
    {
        return $this->hasOne(DossieStatus::class, 'sq_dossie', 'sq_dossie');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'cd_status', 'cd_status');
    }


}
    ?>
