<?php

namespace App\Http\Controllers;

use App\Export\ExportarPlanilha;
use App\Export\Relatorios\RelatorioTeds;
use App\Http\Requests\Ted\TedStoreRequest;
use App\Http\Requests\Ted\TedUpdateRequest;
use App\Models\Status;
use App\Models\Ted;
use App\Services\TedService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;





class TedController extends Controller
{

    /**
     * Instância do serviço de Ted.
     *
     * @var \App\Services\TedService
     */
    protected $ted;
    /**
     * Construtor da classe.
     *
     * @param  \App\Services\TedService  $ted
     */
    public function __construct(TedService $ted) {  $this->ted = $ted;}

    /**
     * Exibe a lista paginada de Ted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        // filtros vindos da tela
        $filters = $request->only([
            'cd_solicitacao',
            'cd_dependencia',
            'nr_conta',
            'dt_emissao',
            'cd_status',
            'vlr_inicio',
            'vlr_fim'
        ]);

        $teds = $this->ted->listPaginated($perPage, $filters);

        $status = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();

        $teds->appends($request->query());

        return view('ted.grid', compact('teds', 'status', 'perPage'));
    }

    /**
     * Exibe o formulário para criação de um novo Teds.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $teds = new Ted();
        $status = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();
        return view('ted.form',compact( 'teds', 'status'));
    }

    /**
     * Armazena um novo Ted no banco de dados.
     *
     * @param  \App\Http\Requests\TedStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TedStoreRequest $request)
    {
        $this->ted->create($request->validated());
        return redirect()
            ->route('ted.index')
            ->with('success', 'Teds criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um Ted específico.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        $teds = $this->ted->getById($id);
        $status = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();
        return view('ted.partial._visualizar', compact('teds','status'))->render();

    }

    /**
     * Exibe o formulário para editar um Ted existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teds= $this->ted->getById($id);
        $status = Status::whereIn('cd_status', [1, 2, 25, 26, 27, 28])->get();
        return view('ted.form', compact('teds','status'));
    }

    /**
     * Atualiza os dados de um Ted existente.
     *
     * @param  \App\Http\Requests\TedUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TedUpdateRequest $request, $id)
    {

        $this->ted->update($id, $request->validated());
        return redirect()->route('ted.index')->with('success', 'Teds atualizado com sucesso!');
    }

    /**
     * Marca um Ted como excluído (exclusão lógica).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->ted->delete($id);
        return redirect()->back()->with('success', 'Ted removido com sucesso!');
    }

    /**
     * Atualiza os dados de um Ted existente pelo modal.
     *
     * @param  \App\Http\Requests\TedUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar(Request $request, $cd_ted)
    {
        $this->ted->atualizar($cd_ted, $request->only([
            'cd_status',
            'ds_obs'
        ]));

        return response()->json(['ok' => true]);
    }

      public function export(Request $request, RelatorioTeds $relatorio)
    {
        $filters = $request->except(['page', 'format']);

        $dados = $relatorio->getDados($filters);

        return (new ExportarPlanilha(
            'Relatorio_Teds',
            $dados
        ))->export($request->get('format', 'xlsx'));
    }


    public function relatorioTedsPdf(Request $request, RelatorioTeds $relatorio)
    {
        $filters = $request->except(['page', 'format', 'mode']);

        $dados = $relatorio->getDados($filters);

        if (
            !is_array($dados) ||
            !array_key_exists('Relatorio_Teds', $dados) ||
            empty($dados['Relatorio_Teds'])
        ) {
            abort(404, 'Nenhum dado encontrado para o relatório');
        }

        $linhas = $dados['Relatorio_Teds'];

        $pdf = Pdf::loadView(
            'ted.pdf.exportacao_pdf',
            compact('linhas')
        )->setPaper('a4', 'landscape');

        $nome = 'Relatorio_Teds_' . now()->format('Ymd_His') . '.pdf';

        $mode = $request->get('mode', 'print');


        if ($mode === 'download') {
            return $pdf->download($nome);
        }

        return view('ted.pdf.exportacao_pdf', compact('linhas'));

    }








}
