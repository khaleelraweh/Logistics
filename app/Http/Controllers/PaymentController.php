<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . ($invoice->total_amount - $invoice->payments->sum('amount')),
            'method' => 'required|in:cash,credit_card,bank_transfer,wallet,cod',
            'reference_note' => 'nullable|string',
            'payment_reference' => 'nullable|string',
            'paid_on' => 'nullable|date',
            'merchant_id' => 'required|exists:merchants,id',
        ]);

        $invoice->payments()->create([
            'amount' => $request->amount,
            'method' => $request->method,
            'reference_note' => $request->reference_note,
            'payment_reference' => $request->payment_reference,
            'paid_on' => $request->paid_on ?? now(),
            'merchant_id' => $request->merchant_id,
            'status' => 'paid',

        ]);

        $invoice->updateStatus();

        return back()->with('success', __('payment.payment_added_successfully'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
   public function edit(Payment $payment)
    {
        // تحميل بيانات الفاتورة المرتبطة
        $invoice = $payment->invoice;

        return view('admin.payments.edit', compact('payment', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Payment $payment)
    // {
    //     $invoice = $payment->invoice;

    //     $request->validate([
    //         'amount' => 'required|numeric|min:1|max:' . ($invoice->total_amount - ($invoice->payments()->where('id', '!=', $payment->id)->sum('amount'))),
    //         'method' => 'required|in:cash,credit_card,bank_transfer,wallet,cod',
    //         'reference_note' => 'nullable|string',
    //         'payment_reference' => 'nullable|string',
    //         'paid_on' => 'required|date',
    //     ]);

    //     $payment->update([
    //         'amount' => $request->amount,
    //         'method' => $request->method,
    //         'reference_note' => $request->reference_note,
    //         'payment_reference' => $request->payment_reference,
    //         'paid_on' => $request->paid_on,
    //     ]);

    //     // تحديث حالة الفاتورة بعد تعديل الدفع
    //     $invoice->updateStatus();

    //     return redirect()->route('admin.invoices.show', $invoice->id)
    //                     ->with('success', 'تم تحديث الدفع بنجاح.');
    // }

    public function update(Request $request, Payment $payment)
    {
        $invoice = $payment->invoice;

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . ($invoice->total_amount - ($invoice->payments()->where('id', '!=', $payment->id)->sum('amount'))),
            'method' => 'required|in:cash,credit_card,bank_transfer,wallet,cod',
            'reference_note' => 'nullable|string',
            'payment_reference' => 'nullable|string',
            'paid_on' => 'nullable|date', // صارت مش إلزامية
        ]);

        $payment->update([
            'amount' => $request->amount,
            'method' => $request->method,
            'reference_note' => $request->reference_note,
            'payment_reference' => $request->payment_reference,
            'paid_on' => $request->paid_on ?? now(), // إذا فارغة يحط التاريخ الحالي
        ]);

        // تحديث حالة الفاتورة بعد تعديل الدفع
        $invoice->updateStatus();

        return back()->with('success', __('payment.payment_recorded_successfully'));

        // return redirect()->route('admin.invoices.show', $invoice->id)
        //                 ->with('success', 'تم تحديث الدفع بنجاح.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        // الحصول على الفاتورة المرتبطة قبل حذف الدفع
        $invoice = $payment->invoice;

        // حذف الدفع
        $payment->delete();

        // تحديث حالة الفاتورة بعد حذف الدفع
        $invoice->updateStatus();

        return back()->with('success', __('payment.payment_removed_successfully'));

        // return redirect()->route('admin.invoices.show', $invoice->id)
        //                 ->with('success', 'تم حذف الدفع بنجاح.');
    }

}
