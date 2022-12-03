<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\Dispatch;
use App\Model\Location;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $locations = Location::all();
        $last = 0;
        foreach($locations as $i => $location) {
            $locations[$i]->tickets = rand(0, 4096);
            $last++;
        }
        $last--;
        for ($i = 0; $i < $last/8; $i += 1)
            $locations[rand(0, $last)]->tickets = 0;
        foreach($locations as $location)
            Dispatch::where('location_id', $location->id)
                ->update(['tickets' => $location->tickets]);
        $data['dispatches'] = $locations;
        return view('e-scape.operator.e-dispatch', $data);
    }

    public function home()
    {
        $data['css']         = ['global', 'operator/home'];
        $data['info']        = Auth::user();
        $data['is_unlocked'] = Session::get('is_unlocked') ?? false;
        return view('e-scape.operator.menu', $data);
    }

    public function dispatch_tickets(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = Dispatch::whereIn('location_id', $request->locations)
            ->update(['tickets' => 0]);
        if ($query) {
            $rs = SharedFunctions::success_msg('Dispatch requested');
            $rs['dispatches'] = Location::all()->map(function($q) {
                $q->tickets = Dispatch::where('location_id', $q->id)
                    ->pluck('tickets')
                    ->first();
                return $q;
            });
        }
        return response()->json($rs);
    }

    public function unlock_index()
    {
        $rs = SharedFunctions::success_msg('OTP authenticated');
        Session::put('is_unlocked', true);
        return response()->json($rs);
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
        if ($query) $rs = SharedFunctions::success_msg('Register success');
        return response()->json($rs);
    }
}
