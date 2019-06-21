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

        switch (Auth::user()->user_type){
            case 0:
                return view('backend.dashboard.admin');
                break;
            case 1:

                return view('backend.dashboard.manager');

                break;
            case 2:
                return view('backend.dashboard.regular_user');


                break;
            default:
                return view('home');

                break;
        }

    }
}
