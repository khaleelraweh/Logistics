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



    // public function index()
    // {
    //     $driver = Auth::user()->driver;

    //     $stats = [
    //         'assigned_packages' => $driver->deliveries()->count(),
    //         'in_progress'       => $driver->deliveries()->where('status', 'in_progress')->count(),
    //         'delivered'         => $driver->deliveries()->where('status', 'delivered')->count(),
    //         'canceled'          => $driver->deliveries()->where('status', 'canceled')->count(),
    //     ];

    //     return view('driver.index', compact('stats'));
    // }

    public function index()
{
    $driver = Auth::user()->driver;
    $today = now()->format('Y-m-d');

    $stats = [
        'deliveries' => [
            'assigned_to_driver' => $driver->deliveries()->where('status', 'assigned_to_driver')->count(),
            'in_transit' => $driver->deliveries()->where('status', 'in_transit')->count(),
            'delivered' => $driver->deliveries()->where('status', 'delivered')->count(),
            'cancelled' => $driver->deliveries()->where('status', 'cancelled')->count(),
        ],
        'pickups' => [
            'pending' => $driver->pickupRequests()->where('status', 'pending')->count(),
            'accepted' => $driver->pickupRequests()->where('status', 'accepted')->count(),
            'completed' => $driver->pickupRequests()->where('status', 'completed')->count(),
            'cancelled' => $driver->pickupRequests()->where('status', 'cancelled')->count(),
        ],
        'returns' => [
            'assigned_to_driver' => $driver->returnRequests()->where('status', 'assigned_to_driver')->count(),
            'picked_up' => $driver->returnRequests()->where('status', 'picked_up')->count(),
            'in_transit' => $driver->returnRequests()->where('status', 'in_transit')->count(),
            'received' => $driver->returnRequests()->where('status', 'received')->count(),
        ],
        'today_tasks' => [
            'deliveries' => $driver->deliveries()
                ->whereDate('created_at', $today)
                ->count(),
            'pickups' => $driver->pickupRequests()
                ->whereDate('created_at', $today)
                ->count(),
            'returns' => $driver->returnRequests()
                ->whereDate('created_at', $today)
                ->count(),
        ]
    ];

    return view('driver.index', compact('stats'));
}








}


