<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UsuarioService;

class LoginController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
        ]);

        // Valida no Service
        $user = $this->usuarioService->autenticar($request->cpf, $request->password);

        if (!$user) {
            return back()->withErrors(['cpf' => 'CPF ou senha incorretos!'])
                ->withInput();
        }

        // Faz o login padrão Laravel
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
