<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'activation_token' => Str::random(60),
            'status' => 'I',
        ];

        $user = User::create($formFields);

        #send email after successfull registration
        Mail::to($user->email)->send(new ActivationEmail($user));

        return response()->json([
            'status' => 'success',
            'message' => 'Your Registration is done successfully. Please check your email for verification!'
        ], 200);
    }

    public function activateAccount($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (is_null($user)) {
            return redirect()->route('user.registration')->with('error', 'Invalid activation token.');
        } else if($user->email_verified_at != null) {
            return redirect()->route('user.registration')->with('error', 'Your account is already activated.');
        }

        $user->status = 'A';
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('user.registration')->with('success', 'Account activated successfully! You can now log in.');
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

        #fetch user
        $user = User::where('email', $credential['email'])->first();
        if(is_null($user)) {
            return response()->json(['error' => 'User not found with this email.'], 401);
        }

        #check email verify
        if($user->email_verified_at == null) {
            return response()->json(['error' => 'Email is not verified. Please check email.'], 401);
        }

        #check status
        if($user->status == 'I') {
            return response()->json(['error' => 'Your account is deactivated.'], 401);
        }

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
            ], 200);
        }
        return response()->json(['error' => 'Invalid email or password.'], 401);
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
