<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware CheckAbility
 *
 * Verifica se o usuário autenticado possui a permissão necessária
 * para acessar determinada rota. Caso não possua, retorna erro 403.
 */
class CheckAbility
{
    /**
     * Trata a requisição HTTP.
     *
     * @param \Illuminate\Http\Request $request Objeto da requisição
     * @param \Closure $next Função para passar a requisição adiante
     * @param string $ability Nome da permissão necessária (ex: "usuarios.list")
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next, $ability)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se o usuário possui a permissão especificada
        if (!$user || !$user->hasAbilityRota($ability)) {
            // Se não possuir, retorna erro 403 (Acesso negado)
            abort(403, 'Acesso negado. Permissão insuficiente.');
        }

        // Passa a requisição para o próximo middleware ou controller
        return $next($request);
    }
}
