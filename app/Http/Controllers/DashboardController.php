<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AplicacaoService;

class DashboardController extends Controller
{
    protected $aplicacao;
    public function __construct(AplicacaoService $aplicacao)
    {   $this->aplicacao = $aplicacao; }

    /**
     * Exibe a pagian de DashboardC .
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        // Obtém a lista paginada de módulos
        $aplicaceos = $this->aplicacao->listPaginated($perPage);

        //  dd($aplicaceos);
        // Mantém o parâmetro "per_page" nos links da paginação
        $aplicaceos->appends(['per_page' => $perPage]);

        return view('dashboard.dashboard', compact('aplicaceos', 'perPage'));

    }

}
