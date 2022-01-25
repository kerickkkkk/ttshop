<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index()
    {
        if( !is_null( Auth::user()) && Auth::user()->role === 'admin'){
            $users = User::with('orders')->where('role','customer')->get();
        }else{
            $users = [];
        }
        
        return view('home', compact('users'));
    }
}
