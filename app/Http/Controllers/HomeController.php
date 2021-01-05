<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index_admin()
    {
        $n_sellers = User::where('rol_id', '=', 2)->count();
        $n_clients = User::where('rol_id', '=', 3)->count();
        return view('home', compact('n_sellers', 'n_clients'));
    }

    public function index_seller()
    {
        $clients = User::where('rol_id', '=', 3)->paginate();
        return view('users.sellers.home', compact('clients'));
    }
}
