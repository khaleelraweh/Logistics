<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.admin-login');
    }

    public function register()
    {
        return view('admin.admin-register');
    }

    public function lock_screen()
    {
        session(['locked' => true]);
        return view('admin.admin-lock-screen');
    }


    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('admin.login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('Incorrect password.')]);
        }

        session()->forget('locked');

        // return redirect()->route('admin.index');
        return redirect('/admin/index');
    }


    public function recover_password()
    {
        return view('admin.admin-recoverpw');
    }

    // public function index()
    // {
    //     return view('admin.index');
    // }

    // public function index()
    // {
    //     // جلب السائقين المتاحين فقط مع الإحداثيات
    //     $drivers = \App\Models\Driver::where('availability_status', 'available')
    //                 ->whereNotNull('latitude')
    //                 ->whereNotNull('longitude')
    //                 ->get(['id', 'first_name', 'last_name', 'latitude', 'longitude', 'phone']);

    //     return view('admin.index', compact('drivers'));
    // }

    public function index()
{
    // جلب السائقين المتاحين فقط مع الإحداثيات
    $drivers = \App\Models\Driver::where('availability_status', 'available')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get(['id', 'first_name', 'last_name', 'latitude', 'longitude', 'phone']);

    // إحصائيات عامة
    $stats = [
        'drivers_total'    => \App\Models\Driver::count(),
        'drivers_available'=> \App\Models\Driver::where('availability_status', 'available')->count(),
        'drivers_busy'     => \App\Models\Driver::where('availability_status', 'busy')->count(),
        'packages_total'   => \App\Models\Package::count(),
        'packages_pending' => \App\Models\Package::where('status', 'pending')->count(),
        'packages_delivered'=> \App\Models\Package::where('status', 'delivered')->count(),
        'merchants_total'  => \App\Models\Merchant::count(),
        'warehouses_total' => \App\Models\Warehouse::count(),
    ];

    return view('admin.index', compact('drivers', 'stats'));
}



}
