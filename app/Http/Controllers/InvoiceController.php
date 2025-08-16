<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\WarehouseRental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_invoices, show_invoices')) {
            return redirect('admin/index');
        }

        $invoices = Invoice::with(['merchant', 'payable'])
            ->when(request()->keyword, function ($query) {
                $query->where('invoice_number', 'like', '%' . request()->keyword . '%')
                      ->orWhereHas('merchant', fn($q) => $q->where('name', 'like', '%' . request()->keyword . '%'));
            })
            ->when(request()->status, fn($query) => $query->where('status', request()->status))
            ->orderBy(request()->sort_by ?? 'created_at', request()->order_by ?? 'desc')
            ->paginate(request()->limit_by ?? 50);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $merchants = Merchant::all();

        // العناصر المرتبطة بالفواتير (غير المرتبطة بعد)
        $warehouseRentals = WarehouseRental::doesntHave('invoice')->get();
        $packages = Package::doesntHave('invoice')->get();

        return view('admin.invoices.create', compact('merchants', 'warehouseRentals', 'packages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'total_amount' => 'required|numeric|min:1',
            'currency' => 'required|string|max:3',
            'notes' => 'nullable|string',
            'payable_type' => 'required|string',
            'payable_id' => 'required|integer',
        ]);

        Invoice::create([
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'merchant_id' => $request->merchant_id,
            'total_amount' => $request->total_amount,
            'currency' => $request->currency,
            'status' => 'unpaid',
            'due_date' => $request->due_date ?? now()->addDays(15),
            'issued_at' => $request->issued_at ?? now(),
            'notes' => $request->notes,
            'payable_type' => $request->payable_type,
            'payable_id' => $request->payable_id,
        ]);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['merchant', 'payable', 'payments']);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $merchants = Merchant::all();
        return view('admin.invoices.edit', compact('invoice', 'merchants'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'total_amount' => 'required|numeric|min:1',
            'currency' => 'required|string|max:3',
            'status' => 'required|in:unpaid,partial,paid',
            'notes' => 'nullable|string',
        ]);

        $invoice->update([
            'merchant_id' => $request->merchant_id,
            'total_amount' => $request->total_amount,
            'currency' => $request->currency,
            'status' => $request->status,
            'due_date' => $request->due_date ?? $invoice->due_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function pay($invoiceId)
    {
        $invoice = Invoice::with('payments')->findOrFail($invoiceId);

        return view('admin.invoices.pay' ,compact('invoice'));
    }

    public function payInvoice(Request $request, $invoiceId)
    {
        $invoice = Invoice::with('payments')->findOrFail($invoiceId);

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . ($invoice->total_amount - $invoice->payments()->sum('amount')),
            'method' => 'required|in:cash,credit_card,bank_transfer,wallet,cod',
            'reference_note' => 'nullable|string',
            'payment_reference' => 'nullable|string',
        ]);

        $invoice->payments()->create([
            'merchant_id' => $invoice->merchant_id,
            'amount' => $request->amount,
            'currency' => $invoice->currency,
            'method' => $request->method,
            'status' => 'paid',
            'paid_on' => now(),
            'for' => 'combined',
            'reference_note' => $request->reference_note,
            'payment_reference' => $request->payment_reference,
            'created_by' => auth()->user()->name ?? 'system',
        ]);

        $invoice->updateStatus();

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
}
