<?php

namespace App\Export;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportarPlanilha
{
    protected array $dados;
    protected $spreadsheet;
    protected string $modelo;

    public function __construct(string $modelo, array $dados)
    {
        $this->dados  = $dados;
        $this->modelo = $modelo;

        $path = resource_path("exports/modelos_relatorios/{$modelo}.xlsx");

        if (!file_exists($path)) {
            throw new \Exception("Modelo {$modelo} não encontrado em {$path}");
        }

        $this->spreadsheet = IOFactory::load($path);
    }

    public function export(string $formato = 'xlsx'): StreamedResponse
    {


        $index = 0;

        foreach ($this->dados as $aba => $linhas) {
            $sheet = $index === 0
                ? $this->spreadsheet->getSheet(0)
                : $this->spreadsheet->createSheet($index);

            $sheet->setTitle($aba);

            $linhas = $this->prepararLinhas($linhas);

            if (!empty($linhas)) {
                $sheet->fromArray($linhas, null, 'A2', true);
            }

            $index++;
        }



        $writer = match ($formato) {
            'xlsx' => new Xlsx($this->spreadsheet),
            'xls'  => new Xls($this->spreadsheet),
            'ods'  => new Ods($this->spreadsheet),
            'csv'  => new Csv($this->spreadsheet),
            'pdf'  => new Dompdf($this->spreadsheet),
            default => throw new \InvalidArgumentException("Formato não suportado: {$formato}")
        };

        return response()->streamDownload(
            fn () => $writer->save('php://output'),
            $this->nomeArquivo($formato),
            [
                'Content-Type' => $formato === 'pdf'
                    ? 'application/pdf'
                    : 'application/octet-stream'
            ]
        );
    }

    protected function nomeArquivo(string $formato): string
    {
        return $this->modelo . '_' . now()->format('Ymd_His') . '.' . $formato;
    }
    protected function prepararLinhas(array $linhas): array
    {
        return array_map(function ($linha) {
            return [
                $linha['no_aplicacao'] ?? '',
                $linha['cd_solicitacao'] ?? '',
                $linha['cd_dependencia'] ?? '',
                $linha['no_unidade'] ?? '',
                $linha['nr_conta'] ?? '',
                $linha['nr_agencia'] ?? '',
                $linha['nr_telefone'] ?? '',
                $linha['dt_emissao'] ?? '',
                $linha['vlr_total'] ?? '',
                $linha['nr_matricula_create'] ?? '',
                $linha['dt_create'] ?? '',
                $linha['nr_matricula_atualizacao'] ?? '',
                $linha['dt_update'] ?? '',
            ];
        }, $linhas);
    }
}
