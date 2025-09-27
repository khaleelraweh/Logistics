<?php

namespace App\Http\Controllers\FrontendDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendDashboardController extends Controller
{

    public function login()
    {
        return view('frontend_dashboard.frontend-dashboard-login');
    }

    public function register()
    {
        return view('frontend_dashboard.frontend-dashboard-register');
    }

    public function lock_screen()
    {
        session(['locked' => true]);
        return view('frontend_dashboard.frontend-dashboard-lock-screen');
    }


    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('frontend_dashboard.login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('Incorrect password.')]);
        }

        session()->forget('locked');

        // return redirect()->route('admin.index');
        return redirect('/frontend_dashboard/index');
    }


    public function recover_password()
    {
        return view('frontend_dashboard.frontend-dashboard-recoverpw');
    }


    public function index()
    {
        return view('frontend_dashboard.index');

    }






}


