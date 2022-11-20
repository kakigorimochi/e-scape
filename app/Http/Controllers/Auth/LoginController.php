<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Libraries\SharedFunctions;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function custom_login(Request $request)
    {
        $rs = SharedFunctions::prompt_msg('Login failed! Please try again.');
        $this->validate($request, [
            'email' => 'required|max:120',
            'password' => 'required|max:255'
        ]);
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password,
                'user_type' => $request->user_type == 'operator' ? 1 : 0
            ]);
        } else if (Auth::attempt([
            'phone'     => $request->email,
            'password'  => $request->password,
            'user_type' => $request->user_type == 'operator' ? 1 : 0
        ])) {
            goto login;
        } else if (Auth::attempt([
            'username'     => $request->email,
            'password'  => $request->password,
            'user_type' => $request->user_type == 'operator' ? 1 : 0
        ])) {
            goto login;
        }
        login:
        if (Auth::check()) {
            $rs = SharedFunctions::success_msg('Logged in successfully!');
            $rs['redirect'] = '/'.$request->user_type.'/index';
        }
        return response()->json($rs);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
