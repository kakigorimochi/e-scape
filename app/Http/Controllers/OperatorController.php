<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $data['css']       = ['global', 'index'];
        $data['user_type'] = 'operator';
        return view('index', $data);
    }

    public function home()
    {
        $data['css'] = ['global'];
        return view('e-scape.operator.menu', $data);
    }

    public function register(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = User::create([
            'user_type' => 1,
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
