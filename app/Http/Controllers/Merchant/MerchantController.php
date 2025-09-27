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


