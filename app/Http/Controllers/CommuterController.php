<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\Transaction;
use App\Model\User;
use App\Model\Wallet;
use Illuminate\Http\Request;
use Auth;

class CommuterController extends Controller
{
    public function index()
    {
        $data['css']       = ['global', 'index'];
        $data['user_type'] = 'commuter';
        return view('index', $data);
    }

    public function e_wallet()
    {
        $data['css']     = ['global'];
        $data['balance'] = Wallet::where('user_id', Auth::user()->id)
            ->pluck('balance')->first();
        return view('e-scape.commuter.e-wallet', $data);
    }

    public function home()
    {
        $data['css']  = ['global'];
        $data['info'] = Auth::user();
        return view('e-scape.commuter.menu', $data);
    }

    public function add_wallet_balance(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = Wallet::where('user_id', Auth::user()->id)->first();
        $query->increment('balance', $request->value);
        $transact = Transaction::create([
            'wallet_id' => $query->id,
            'amount'    => $request->value,
            'type'      => Transaction::TYPE_ADD_BALANCE
        ]);
        if ($query && $transact) {
            $rs = SharedFunctions::success_msg('Successful!');
            $rs['new_balance'] = Wallet::where('user_id', Auth::user()->id)
                ->pluck('balance')->first();
        }
        return response()->json($rs);
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
        $wallet = Wallet::create(['user_id' => $query->id]);
        if ($query && $wallet) $rs = SharedFunctions::success_msg('Registered successfully!');
        return response()->json($rs);
    }
}
