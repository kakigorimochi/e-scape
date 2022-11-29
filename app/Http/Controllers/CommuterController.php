<?php

namespace App\Http\Controllers;

use App\Libraries\SharedFunctions;
use App\Model\Dispatch;
use App\Model\Journey;
use App\Model\Location;
use App\Model\Transaction;
use App\Model\User;
use App\Model\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data['balance'] = floatval(Wallet::where('user_id', Auth::user()->id)
            ->pluck('balance')->first());
        return view('e-scape.commuter.e-wallet', $data);
    }

    public function home()
    {
        $data['css']     = ['global'];
        $data['info']    = Auth::user();
        $data['journey'] = false;
        if (Journey::where('user_id', Auth::user()->id)->where('status', 2)->first())
            $data['journey'] = true;
        return view('e-scape.commuter.menu', $data);
    }

    public function mode_of_payment()
    {
        $data['css'] = ['global'];
        return view('e-scape.commuter.e-modeofpayment', $data);
    }

    public function new_balance()
    {
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $query = Transaction::where('wallet_id', $wallet->id)
            ->where('type', Transaction::TYPE_ADD_BALANCE)
            ->where('status', Transaction::STATUS_INACTIVE)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $data['css']         = ['global'];
        $data['added_value'] = $query->amount;
        $data['new_balance'] = $wallet->balance;
        return view('e-scape.commuter.e-newbalance', $data);
    }

    public function pay_journey()
    {
        $journey              = Journey::where('user_id', Auth::user()->id)->where('status', 2)->first();
        $journey->origin      = Location::where('id', $journey->origin_id)->pluck('name')->first();
        $journey->destination = Location::where('id', $journey->destination_id)->pluck('name')->first();
        $data['css']          = ['global'];
        $data['journey']      = $journey;
        $data['uuid']         = Auth::user()->uuid;
        $data['wallet']       = Wallet::where('user_id', Auth::user()->id)->first();
        return view('e-scape.commuter.e-payment', $data);
    }

    public function single_journey_ticket()
    {
        $data['css']       = ['global'];
        $data['locations'] = Location::all();
        return view('e-scape.commuter.e-ticket', $data);
    }

    public function topup()
    {
        $data['css'] = ['global'];
        return view('e-scape.commuter.e-topup', $data);
    }

    public function add_wallet_balance(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = Wallet::where('user_id', Auth::user()->id)->first();
        $query->increment('balance', $request->value);
        $transact = Transaction::create([
            'wallet_id' => $query->id,
            'amount'    => $request->value,
            'type'      => Transaction::TYPE_ADD_BALANCE,
            'status'    => Transaction::STATUS_PENDING
        ]);
        if ($query && $transact) $rs = SharedFunctions::success_msg('Pending transaction created successfully!');
        return response()->json($rs);
    }

    public function cancel_transaction()
    {
        $rs = SharedFunctions::default_msg();
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $query = Transaction::where('wallet_id', $wallet->id)
            ->where('type', Transaction::TYPE_ADD_BALANCE)
            ->where('status', Transaction::STATUS_PENDING)
            ->first();
        $wallet->decrement('balance', $query->amount);
        if ($query->delete()) $rs = SharedFunctions::success_msg('Cancelled transaction successfully!');
        return response()->json($rs);
    }

    public function cancel_journey(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = Journey::where('id', $request->id)->delete();
        if ($query) $rs = SharedFunctions::success_msg('Cancelled journey successfully!');
        return response()->json($rs);
    }

    public function journey_paid(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        $query = Journey::where('id', $request->id)->first();
        if ($query) {
            $query->status = Journey::STATUS_PAID;
            $wallet = Wallet::where('user_id', Auth::user()->id)->first();
            $transaction = Transaction::create([
                'wallet_id' => $wallet->id,
                'amount'    => $query->amount,
                'type'      => Transaction::TYPE_OPERATOR_PAYMENT,
                'status'    => Transaction::STATUS_INACTIVE
            ]);
            $wallet->balance -= $query->amount;
            $dispatch = Dispatch::where('location_id', $query->destination_id)->first();
            if ($dispatch) $dispatch->tickets++;
            else {
                $dispatch = new Dispatch;
                $dispatch->location_id = $query->destination_id;
                $dispatch->tickets = 1;
            }
            if ($query->save() && $dispatch->save() && $transaction && $wallet->save())
                $rs = SharedFunctions::success_msg('Journey paid successfully!');
        }
        return response()->json($rs);
    }

    public function pay_transaction()
    {
        $rs = SharedFunctions::default_msg();
        $wallet_id = Wallet::where('user_id', Auth::user()->id)->pluck('id')->first();
        $query = Transaction::where('wallet_id', $wallet_id)
            ->where('type', Transaction::TYPE_ADD_BALANCE)
            ->where('status', Transaction::STATUS_PENDING)
            ->update(['status' => Transaction::STATUS_INACTIVE]);
        if ($query) $rs = SharedFunctions::success_msg('Journey paid successfully!');
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
            'password'  => bcrypt($request->password)
        ]);
        $wallet = Wallet::create(['user_id' => $query->id]);
        if ($query && $wallet) $rs = SharedFunctions::success_msg('Registered successfully!');
        return response()->json($rs);
    }

    public function submit_journey(Request $request)
    {
        $rs = SharedFunctions::default_msg();
        // todo: the amount value
        $query = Journey::create([
            'user_id'        => Auth::user()->id,
            'origin_id'      => $request->origin_id,
            'destination_id' => $request->destination_id,
            'amount'         => rand(10, 70),
            'origin_type'    => $request->origin_type,
            'status'         => Journey::STATUS_PENDING
        ]);
        if ($query) $rs = SharedFunctions::success_msg('Journey created successfully!');
        return response()->json($rs);
    }
}
