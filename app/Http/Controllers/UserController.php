<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registration()
    {
        return view('registration');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16',
            'mobile' => 'required|digits:10'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $formFields = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'ip' => $request->ip(),
            'status' => 'I',
        ];

        User::create($formFields);

        return response()->json([
            'status' => 'success',
            'message' => 'Your Registration is done successfully!'
        ], 200);
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credential = $request->only('email', 'password');
        $remember = $request->has('remember');

        if(Auth::guard('web')->attempt($credential, $remember)) {
            $request->session()->regenerate();
            if($remember) {
                Cookie::queue('email', $request->email, 43200);
                Cookie::queue('password', $request->password, 43200);
            } else {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful!',
                'url' => url('/')
            ]);
        }
        return response()->json(['error' => 'Invalid email or password.'], 401);
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
