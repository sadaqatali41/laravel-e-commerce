<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

        $seconds = config('constants.CACHE_EXP') + 180;

        $metrics = Cache::remember('admin_dashboard_metrics', $seconds, function(){

            return [
                'totalUsers' => User::count(),
                'totalProducts' => Product::count(),
                'totalOrders' => Order::count(),
        
                'todaysSales' => Order::whereDate('created_at', Carbon::today())
                                    ->where('payment_status', 'SUCCESS')
                                    ->sum('total_amt'),
        
                'pendingOrders' => Order::where('payment_status', 'PENDING')->count(),
        
                'lowStockProducts' => Product::whereHas('attributes', function ($query) {
                    $query->where('qty', '<', 5);
                })->count()
            ];
        });

        return view('admin.index', $metrics);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
