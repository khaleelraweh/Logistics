<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverDashboardController extends Controller
{

    public function login()
    {
        return view('driver.driver-login');
    }

    public function register()
    {
        return view('driver.driver-register');
    }

    public function lock_screen()
    {
        session(['locked' => true]);
        return view('driver.driver-lock-screen');
    }


    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('driver.login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('Incorrect password.')]);
        }

        session()->forget('locked');

        // return redirect()->route('admin.index');
        return redirect('/driver/index');
    }


    public function recover_password()
    {
        return view('driver.driver-recoverpw');
    }


    public function index()
    {
        $user = Auth::user();
        $driver = $user->driver;

        // if (!$driver) {
        //     return redirect()->route('driver.login')->withErrors(['message' => 'لا يوجد سائق مرتبط بهذا الحساب.']);
        // }

        dd($user);
        $stats = [
            'assigned_packages' => $driver->deliveries()->count(),
            'in_progress'       => $driver->deliveries()->where('status', 'in_progress')->count(),
            'delivered'         => $driver->deliveries()->where('status', 'delivered')->count(),
            'canceled'          => $driver->deliveries()->where('status', 'canceled')->count(),
        ];

        return view('driver.index', compact('stats'));
    }







}


