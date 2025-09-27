<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
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
        $driverId = auth()->user()->driver->id;
        return view('driver.index');

    }






}


