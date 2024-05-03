<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';
    protected $tries = 3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(AuthRequest $request)
    {


        $user = User::whereEmail($request->email)->first();
        if ($user == null) {
            session()->flash('message', __('auth.no_email'));
            return to_route('login');
        }
        if ($user->status == 0) {
            session()->flash('message', __('auth.in_active_user'));
            return to_route('login');
        } else if ($user->status == 2) {
            session()->flash('message', __('auth.suspend_user'));
            return to_route('login');
        }


        if (Auth::attempt($request->validated())) {
            return redirect('/home')->with('message', __('auth.sucess'));
        }


        return back()->with('message', __('auth.failed'));
    }
}
