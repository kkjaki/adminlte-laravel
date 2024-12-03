<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard'; // Redirect user biasa

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override fungsi login untuk validasi role
    protected function authenticated(Request $request, $user)
    {
        if ($user->role !== 'user') {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Anda tidak memiliki akses sebagai user.']);
        }
    }
}