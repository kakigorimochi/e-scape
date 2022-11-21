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
        $data['css'] = ['global', 'home'];
        return view('home', $data);
    }

    public function login($user_type)
    {
        $data['css'] = ['global'];
        $data['user_type'] = $user_type;
        return view('e-scape.login', $data);
    }

    public function register($user_type)
    {
        $data['css'] = ['global'];
        $data['user_type'] = $user_type;
        return view('e-scape.e-register', $data);
    }
}
