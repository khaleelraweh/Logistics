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
    //     $merchantId = auth()->user()->merchant->id;

    //     // إجمالي الطرود
    //     $totalPackages = \App\Models\Package::where('merchant_id', $merchantId)->count();

    //     // إجمالي الرسوم
    //     $totalFees = \App\Models\Package::where('merchant_id', $merchantId)->sum('total_fee');

    //     // الدفع عند الاستلام COD
    //     $totalCOD = \App\Models\Package::where('merchant_id', $merchantId)->sum('cod_amount');

    //     // المدفوعات (مستلمة + متبقية)
    //     $paidAmount = \App\Models\Package::where('merchant_id', $merchantId)->sum('paid_amount');
    //     $dueAmount  = \App\Models\Package::where('merchant_id', $merchantId)->sum('due_amount');



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

    //     return view('merchant.index', compact(
    //         'totalPackages','totalFees','totalCOD','paidAmount','dueAmount','stats','packageStats',
    //     ));
    // }

    public function index()
    {
        $merchantId = auth()->user()->merchant->id;

        // الإحصائيات الأساسية
        $stats = [
            'packages_total' => \App\Models\Package::where('merchant_id', $merchantId)->count(),
            'packages_pending' => \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
            'packages_delivered' => \App\Models\Package::where('merchant_id', $merchantId)->where('status', 'delivered')->count(),
            'warehouses_total' => \App\Models\Warehouse::count(),
        ];

        // إحصائيات الطرود حسب الحالة
        $packageStats = \App\Models\Package::where('merchant_id', $merchantId)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // التقارير المالية
        $financialReports = [
            // إجمالي المبالغ
            'total_revenue' => \App\Models\Package::where('merchant_id', $merchantId)->sum('total_fee'),
            'total_cod' => \App\Models\Package::where('merchant_id', $merchantId)->sum('cod_amount'),
            'total_paid' => \App\Models\Package::where('merchant_id', $merchantId)->sum('paid_amount'),
            'total_due' => \App\Models\Package::where('merchant_id', $merchantId)->sum('due_amount'),

            // طرود قيد التسليم (في الطريق)
            'in_transit_packages' => \App\Models\Package::where('merchant_id', $merchantId)
                ->whereIn('status', ['in_transit', 'out_for_delivery', 'arrived_at_hub'])
                ->count(),
            'in_transit_value' => \App\Models\Package::where('merchant_id', $merchantId)
                ->whereIn('status', ['in_transit', 'out_for_delivery', 'arrived_at_hub'])
                ->sum('total_fee'),
            'in_transit_cod' => \App\Models\Package::where('merchant_id', $merchantId)
                ->whereIn('status', ['in_transit', 'out_for_delivery', 'arrived_at_hub'])
                ->sum('cod_amount'),

            // التحصيل المقبوض مع الناقل
            'collected_by_carrier' => \App\Models\Package::where('merchant_id', $merchantId)
                ->where('status', 'delivered')
                ->sum('paid_amount'),

            // المبالغ المستحقة
            'pending_collection' => \App\Models\Package::where('merchant_id', $merchantId)
                ->where('status', 'delivered')
                ->sum('due_amount'),

            // إحصائيات حسب طريقة الدفع
            'payment_methods' => \App\Models\Package::where('merchant_id', $merchantId)
                ->selectRaw('payment_method, COUNT(*) as count, SUM(total_fee) as revenue, SUM(cod_amount) as cod_total')
                ->groupBy('payment_method')
                ->get()
                ->toArray(),

            // إحصائيات الشهر الحالي
            'current_month' => [
                'packages' => \App\Models\Package::where('merchant_id', $merchantId)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'revenue' => \App\Models\Package::where('merchant_id', $merchantId)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('total_fee'),
                'delivered' => \App\Models\Package::where('merchant_id', $merchantId)
                    ->where('status', 'delivered')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
            ]
        ];

        // الطرود الأخيرة (آخر 5 طرود)
        $recentPackages = \App\Models\Package::where('merchant_id', $merchantId)
            ->with('merchant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('merchant.index', compact(
            'stats',
            'packageStats',
            'financialReports',
            'recentPackages'
        ));
    }






}


