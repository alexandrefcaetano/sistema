<?php

namespace App\Services;

use App\Models\Anexo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AnexoService
{
    public function salvar(
        array $arquivos,
        int $cdSolicitacao,
        ?array $descricoes = null,
        array $extra = []
    ): void {
        foreach ($arquivos as $index => $file) {

            if (!$file instanceof UploadedFile) {
                continue;
            }

            $nomeOriginal = $file->getClientOriginalName();

            $path = "dossies/{$cdSolicitacao}/anexos";

            $arquivoSalvo = $file->storeAs(
                $path,
                uniqid() . '_' . $nomeOriginal
            );

            Anexo::create(array_merge([
                'cd_solicitacao'     => $cdSolicitacao,
                'ds_arquivo'         => $descricoes[$index] ?? null,
                'no_arquivo'         => $nomeOriginal,
                'nr_tamanho_arquivo' => $file->getSize(),
                'st_aprovacao'       => 'P',
                'dt_arquivo'         => now(),
                'dt_insercao'        => now(),
                'nr_matricula'       => user()->nr_matricula,
            ], $extra));
        }
    }
}
