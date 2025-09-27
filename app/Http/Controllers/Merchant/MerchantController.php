<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchantController extends Controller
{

    public function login()
    {
        return view('merchant.merchant-login');
    }

    public function register()
    {
        return view('merchant.merchant-register');
    }

    public function lock_screen()
    {
        session(['locked' => true]);
        return view('merchant.merchant-lock-screen');
    }


    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('merchant.login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('Incorrect password.')]);
        }

        session()->forget('locked');

        // return redirect()->route('admin.index');
        return redirect('/merchant/index');
    }


    public function recover_password()
    {
        return view('merchant.merchant-recoverpw');
    }

    // public function index()
    // {
    //     // جلب السائقين المتاحين فقط مع الإحداثيات
    //     $drivers = \App\Models\Driver::where('availability_status', 'available')
    //                 ->whereNotNull('latitude')
    //                 ->whereNotNull('longitude')
    //                 ->get(['id', 'first_name', 'last_name', 'latitude', 'longitude', 'phone']);

    //     // إحصائيات عامة
    //     $stats = [
    //         'drivers_total'    => \App\Models\Driver::count(),
    //         'drivers_available'=> \App\Models\Driver::where('availability_status', 'available')->count(),
    //         'drivers_busy'     => \App\Models\Driver::where('availability_status', 'busy')->count(),
    //         'packages_total'   => \App\Models\Package::count(),
    //         'packages_pending' => \App\Models\Package::where('status', 'pending')->count(),
    //         'packages_delivered'=> \App\Models\Package::where('status', 'delivered')->count(),
    //         'merchants_total'  => \App\Models\Merchant::count(),
    //         'warehouses_total' => \App\Models\Warehouse::count(),
    //     ];

    //     return view('merchant.index', compact('drivers', 'stats'));
    // }



    // public function index()
    // {
    //     $merchant = auth()->user(); // التاجر الحالي

    //     // إحصائيات الطرود حسب الحالات كلها
    //     $packageStats = [];
    //     foreach (\App\Models\Package::STATUSES as $status) {
    //         $packageStats[$status] = \App\Models\Package::where('merchant_id', $merchant->id)
    //             ->where('status', $status)
    //             ->count();
    //     }

    //     // إحصائيات إضافية
    //     $stats = [
    //         'packages_total'   => \App\Models\Package::where('merchant_id', $merchant->id)->count(),
    //         'warehouses_total' => \App\Models\WarehouseRental::where('merchant_id', $merchant->id)->count(),
    //     ];

    //     return view('merchant.index', compact('stats', 'packageStats'));
    // }

    // public function index()
    // {
    //     $merchantId = auth()->user()->merchant->id;

    //     // إحصائيات الطرود الخاصة بهذا التاجر فقط
    //     $packageStats = \App\Models\Package::where('merchant_id', $merchantId)
    //         ->selectRaw('status, COUNT(*) as count')
    //         ->groupBy('status')
    //         ->pluck('count', 'status')
    //         ->toArray();

    //     $stats = [
    //         'packages_total'    => \App\Models\Package::where('merchant_id', $merchantId)->count(),
    //         'packages_pending'  => \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
    //         'packages_delivered'=> \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'delivered')->count(),
    //         'warehouses_total'  => \App\Models\Warehouse::count(), // أو warehouses الخاصة به إن وجدت علاقة
    //     ];

    //     return view('merchant.index', compact('stats', 'packageStats'));
    // }

    public function index()
    {
        $merchantId = auth()->user()->merchant->id;

        // إجمالي الطرود
        $totalPackages = \App\Models\Package::where('merchant_id', $merchantId)->count();

        // إجمالي الرسوم
        $totalFees = \App\Models\Package::where('merchant_id', $merchantId)->sum('total_fee');

        // الدفع عند الاستلام COD
        $totalCOD = \App\Models\Package::where('merchant_id', $merchantId)->sum('cod_amount');

        // المدفوعات (مستلمة + متبقية)
        $paidAmount = \App\Models\Package::where('merchant_id', $merchantId)->sum('paid_amount');
        $dueAmount  = \App\Models\Package::where('merchant_id', $merchantId)->sum('due_amount');



        // إحصائيات الطرود الخاصة بهذا التاجر فقط
        $packageStats = \App\Models\Package::where('merchant_id', $merchantId)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $stats = [
            'packages_total'    => \App\Models\Package::where('merchant_id', $merchantId)->count(),
            'packages_pending'  => \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
            'packages_delivered'=> \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'delivered')->count(),
            'warehouses_total'  => \App\Models\Warehouse::count(), // أو warehouses الخاصة به إن وجدت علاقة
        ];

        return view('merchant.index', compact(
            'totalPackages','totalFees','totalCOD','paidAmount','dueAmount','stats','packageStats',
        ));
    }






}


