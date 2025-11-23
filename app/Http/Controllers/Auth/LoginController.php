<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validação
        $request->validate([
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Normaliza o CPF (remove pontos e traços)
        $cpf = preg_replace('/\D/', '', $request->cpf);

        // 3. Buscar usuário pelo CPF (antes do Auth)
        $user = \App\Models\Usuario::where('cpf', $cpf)->first();

        if (!$user) {
            return back()->withErrors([
                'cpf' => 'Usuário não encontrado.',
            ])->withInput();
        }

        // 4. Verificar se está ativo (caso use essa coluna)
        if (isset($user->ativo) && !$user->ativo) {
            return back()->withErrors([
                'cpf' => 'Seu usuário está inativo. Contate o administrador.',
            ])->withInput();
        }

        // 5. Tentar autenticar
        $credentials = [
            'cpf' => $cpf,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'cpf' => 'CPF ou senha incorretos.',
            ])->withInput();
        }

        // 6. Segurança: regenerar a sessão
        $request->session()->regenerate();

        // 7. Verificação de ACL (role e ability)
        $user = Auth::user();

        // 8. Log de auditoria (opcional, recomendado)
        \Log::info('Login realizado', [
            'cpf' => $cpf,
            'user_id' => $user->id ?? null,
            'ip' => $request->ip()
        ]);

        // 9. Redireciona
        return redirect()->route('dashboard.index');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
