<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      if ($user->role == 'culture_agent') {
        return redirect()->route('culture.dashboard');
      } elseif ($user->role == 'division_head') {
        return redirect()->route('division.dashboard');
      } elseif ($user->role == 'admin_hc') {
        return redirect()->route('admin.dashboard');
      }
      return redirect('/dashboard');
    }

    return back()->withErrors(['email' => 'These credentials do not match our records.']);
  }


  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/login');
  }
}
