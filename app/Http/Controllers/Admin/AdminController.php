<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);

        $credential = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credential, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Email or Password mab be incorrect'])->onlyInput('email');
    }

    public function index() {
        return view('admin.index');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
