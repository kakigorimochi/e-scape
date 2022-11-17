<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $data['css'] = ['home'];
        return view('home', $data);
    }

    public function index($user_type)
    {
        $data['css']       = ['index'];
        $data['user_type'] = $user_type;
        return view('index', $data);
    }

    public function login($user_type)
    {
        $data['user_type'] = $user_type;
        return view('e-scape.login', $data);
    }

    public function register($user_type)
    {
        $data['user_type'] = $user_type;
        return view('e-scape.e-register', $data);
    }

    // public function login()
    // {
    //     $data['css'] = ['login'];
    //     return view('auth.login', $data);
    // }
}
