<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\User;
use Illuminate\Http\Request;

class CommuterController extends Controller
{
    public function index()
    {
        $data['css']       = ['index'];
        $data['user_type'] = 'commuter';
        return view('index', $data);
    }

    public function home()
    {
        $data['css'] = [];
        return view('e-scape.commuter.menu', $data);
    }

    public function register(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = User::create([
            'user_type' => 0,
            'fname'     => $request->firstname,
            'lname'     => $request->lastname,
            'birthdate' => $request->birthdate,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'username'  => $request->username,
            'password'  => bcrypt($request->password)
        ]);
        if ($query) $rs = SharedFunctions::success_msg('Registered successfully!');
        return response()->json($rs);
    }
}
