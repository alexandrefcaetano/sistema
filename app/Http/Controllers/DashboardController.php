<?php

namespace App\Http\Controllers;


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
