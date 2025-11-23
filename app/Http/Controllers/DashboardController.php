<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    { }

    /**
     * Exibe a pagian de DashboardC .
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       return view('dashboard.dashboard');
    }

}
