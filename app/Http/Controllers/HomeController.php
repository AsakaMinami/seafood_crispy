<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();

        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        elseif ($user->role->name === 'seller') {
            return redirect()->route('seller.dashboard');
        } 
        else {
            // Peran default atau 'buyer'
            return redirect()->route('buyer.dashboard');
        }
    }
}
