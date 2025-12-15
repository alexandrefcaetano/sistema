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
        foreach ($this->dados as $aba => $linhas) {

            $sheet = $this->spreadsheet->getSheet(0);
            $sheet->setTitle($aba);

            // remove linhas vazias
            $linhas = array_values(array_filter($linhas, function ($linha) {
                return !empty(array_filter($linha, fn($v) => $v !== null && $v !== ''));
            }));

            if (empty($linhas)) {
                continue;
            }

            // começa na linha 2 (cabeçalho já existe)
            $sheet->fromArray($linhas, null, 'A2', true);

            // 🔹 ajuste visual para PDF
            $sheet->getPageSetup()
                ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
                ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

            $sheet->getPageMargins()->setTop(0.5);
            $sheet->getPageMargins()->setRight(0.3);
            $sheet->getPageMargins()->setLeft(0.3);
            $sheet->getPageMargins()->setBottom(0.5);

            // quebra de página automática
            $sheet->setShowGridlines(false);
        }

        $this->spreadsheet->setActiveSheetIndex(0);

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

    protected function nomeArquivo(): string
    {
        return $this->modelo . '_' . now()->format('Ymd_His') . '.xlsx';
    }
}
