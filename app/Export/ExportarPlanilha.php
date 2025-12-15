<?php

namespace App\Export;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ExportarPlanilha
{
    protected array $dados;
    protected $spreadsheet;
    protected string $modelo;

    public function __construct(string $modelo, array $dados)
    {
        $this->dados   = $dados;
        $this->modelo  = $modelo;

        $path = resource_path("exports/modelos_relatorios/{$modelo}.xlsx");

        if (!file_exists($path)) {
            throw new \Exception("Modelo {$modelo} não encontrado");
        }

        $this->spreadsheet = IOFactory::load($path);
    }

    /**
     * Exportação genérica
     */
    public function export(string $formato = 'xlsx'): StreamedResponse
    {


        // Preenche as abas
        foreach ($this->dados as $aba => $linhas) {

            // usa sempre a primeira aba
            $sheet = $this->spreadsheet->getSheet(0);
            $sheet->setTitle($aba);

            // remove linhas vazias
            $linhas = array_values(array_filter($linhas, function ($linha) {
                return !empty(array_filter($linha, fn($v) => $v !== null));
            }));

            if (empty($linhas)) {
                continue;
            }

            // Dados
            $sheet->fromArray($linhas, null, 'A2');
        }

// mantém a aba correta ativa
        $this->spreadsheet->setActiveSheetIndex(0);

//        dd([
//            'aba' => $aba,
//            'total_linhas' => count($linhas),
//            'primeira_linha' => $linhas[0]
//        ]);

        // Sempre abrir na primeira aba
        $this->spreadsheet->setActiveSheetIndex(0);

        // Escolha do writer
        $writer = match ($formato) {
            'xlsx' => new Xlsx($this->spreadsheet),
            'xls'  => new Xls($this->spreadsheet),
            'ods'  => new Ods($this->spreadsheet),
            'csv'  => new Csv($this->spreadsheet),
            default => throw new \InvalidArgumentException("Formato não suportado: {$formato}")
        };

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $this->nomeArquivo($formato)
        );
    }

    protected function nomeArquivo(): string
    {
        return $this->modelo . '_' . now()->format('Ymd_His') . '.xlsx';
    }
}
