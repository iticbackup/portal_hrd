<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;
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

    protected function credentials(Request $request)
    {
        return [
            'nik' => request()->nik,
            'password' => request()->password,
            // 'is_active' => 1
        ];
    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'nik' => 'required',
            'password' => 'required',
        ],[
            'nik.required' => 'NIK Wajib diisi',
            'password.required' => 'Password Wajib diisi'
        ]);
        
        // if(auth()->attempt(array($input['username'])))
        // $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';
        RateLimiter::clear('login.'.$request->ip());
        if(auth()->attempt(array($fieldType => $input['nik'], 'password' => $input['password'])))
        {
            auth()->logoutOtherDevices(request()->password);
            return redirect()->route('home');
            // return redirect()->intended();
        }else{
            return redirect()->route('login')
                ->with('error','NIK / Password Salah.');
        }
    }
}
