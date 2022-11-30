<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\Dispatch;
use App\Model\Location;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function index()
    {
        $data['css']       = ['global', 'index'];
        $data['user_type'] = 'operator';
        return view('index', $data);
    }

    public function dispatches()
    {
        $data['css']        = ['global', 'operator/dispatch'];
        $data['dispatches'] = Location::all()
            ->map(function($q) {
                $q->tickets = Dispatch::where('location_id', $q->id)
                    ->pluck('tickets')
                    ->first();
                return $q;
            });
        return view('e-scape.operator.e-dispatch', $data);
    }

    public function home()
    {
        $data['css']  = ['global', 'operator/home'];
        $data['info'] = Auth::user();
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
            'password'  => bcrypt($request->password)
        ]);
        if ($query) $rs = SharedFunctions::success_msg('Registered successfully!');
        return response()->json($rs);
    }
}
