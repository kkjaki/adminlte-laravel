<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = 'good_receipts.dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override fungsi login untuk validasi role
    protected function authenticated(Request $request, $user)
    {
        if ($user->role !== 'admin') {
            Auth::logout();
            return redirect()->route('auth.login')
                ->withErrors(['email' => 'Anda tidak memiliki akses sebagai admin.']);
        }
    }

    // Override untuk menampilkan view login admin
    public function showLoginForm()
    {
        return view('auth.loginkhususadmin');
    }
}
