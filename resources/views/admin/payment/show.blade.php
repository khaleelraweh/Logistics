@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h4 class="mb-0">{{ __('rental.rental_details') }} #{{ $warehouseRental->id }}</h4>
                <div class="small mt-1">
                    {!! $warehouseRental->status_label !!}
                </div>
            </div>

            <div class="card-body">
                {{-- تفاصيل العقد --}}
                <div class="mb-4">
                    <h6 class="text-muted">{{ __('merchant.name') }}</h6>
                    <p class="fw-semibold">{{ $warehouseRental->merchant->name ?? __('general.not_specified') }}</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted">{{ __('rental.rental_start') }}</h6>
                            <p class="fw-semibold">{{ $warehouseRental->rental_start?->format('Y-m-d') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted">{{ __('rental.rental_end') }}</h6>
                            <p class="fw-semibold">{{ $warehouseRental->rental_end?->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted">{{ __('general.total_price') }}</h6>
                    <p class="fw-semibold">{{ $warehouseRental->price }} {{ __('general.sar') }}</p>
                </div>

                {{-- الرفوف المستأجرة --}}
                @if($warehouseRental->shelves->isNotEmpty())
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-warehouse me-2"></i> {{ __('rental.rented_shelves') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('warehouse.name') }}</th>
                                    <th>{{ __('shelf.code') }}</th>
                                    <th>{{ __('general.size') }}</th>
                                    <th>{{ __('general.price') }}</th>
                                    <th>{{ __('rental.custom_start') }}</th>
                                    <th>{{ __('rental.custom_end') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($warehouseRental->shelves as $shelf)
                                    <tr>
                                        <td>{{ $shelf->warehouse->name ?? '-' }}</td>
                                        <td>{{ $shelf->code }}</td>
                                        <td>{{ $shelf->size() }}</td>
                                        <td>{{ $shelf->pivot->custom_price }} {{ __('general.sar') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($shelf->pivot->custom_start)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($shelf->pivot->custom_end)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- الفاتورة المرتبطة --}}
                @if($warehouseRental->invoice)
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-file-invoice-dollar me-2"></i> {{ __('invoice.details') }}</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>{{ __('invoice.number') }}:</strong> {{ $warehouseRental->invoice->invoice_number }}</p>
                            <p><strong>{{ __('invoice.status') }}:</strong> {{ ucfirst($warehouseRental->invoice->status) }}</p>
                            <p><strong>{{ __('general.total_amount') }}:</strong> {{ $warehouseRental->invoice->total_amount }} {{ __('general.sar') }}</p>
                            <p><strong>{{ __('invoice.amount_paid') }}:</strong> {{ $warehouseRental->invoice->payments->sum('amount')  }} {{ __('general.sar') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('invoice.issued_at') }}:</strong> {{ $warehouseRental->invoice->issued_at?->format('Y-m-d') }}</p>
                            <p><strong>{{ __('invoice.due_date') }}:</strong> {{ $warehouseRental->invoice->due_date?->format('Y-m-d') }}</p>
                            <p><strong>{{ __('invoice.notes') }}:</strong> {{ $warehouseRental->invoice->notes }}</p>
                            <p><strong>{{ __('invoice.remaining_amount') }}:</strong> {{ $warehouseRental->invoice->total_amount - $warehouseRental->invoice->payments->sum('amount') }} {{ __('general.sar') }}</p>
                        </div>
                    </div>




                    {{-- المدفوعات المرتبطة --}}
                    @if($warehouseRental->invoice->payments->isNotEmpty())
                        <hr>
                        <h6 class="mb-2">{{ __('invoice.payments') }}</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('payment.date') }}</th>
                                        <th>{{ __('payment.amount') }}</th>
                                        <th>{{ __('payment.method') }}</th>
                                        <th>{{ __('payment.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($warehouseRental->invoice->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->paid_on?->format('Y-m-d') }}</td>
                                            <td>{{ $payment->amount }} {{ __('general.sar') }}</td>
                                            {{-- <td>{{ $payment->method }}</td>
                                            <td>{{ ucfirst($payment->status) }}</td> --}}
                                            <td>{{ __('payment.' . $payment->method) }}</td>
                                            <td>{{ __('payment.' . $payment->status) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif

                @if($warehouseRental->invoice && $warehouseRental->invoice->status != 'paid')
                    <hr>
                    <h6>{{ __('rental.add_payment') }}</h6>
                    <form action="{{ route('admin.warehouse_rentals.pay_invoice', $warehouseRental->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>{{ __('payment.amount') }}</label>
                            <input type="number" name="amount" class="form-control"
                                max="{{ $warehouseRental->invoice->total_amount - $warehouseRental->invoice->payments->sum('amount') }}" required>
                        </div>
                        <div class="mb-2">
                            <label>{{ __('payment.method') }}</label>
                            <select name="method" class="form-select" required>
                                <option value="cash">{{ __('payment.cash') }}</option>
                                <option value="credit_card">{{ __('payment.credit_card') }}</option>
                                <option value="bank_transfer">{{ __('payment.bank_transfer') }}</option>
                                <option value="wallet">{{ __('payment.wallet') }}</option>
                                <option value="cod">{{ __('payment.cod') }}</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>{{ __('payment.reference_note') }}</label>
                            <input type="text" name="reference_note" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>{{ __('payment.payment_reference') }}</label>
                            <input type="text" name="payment_reference" class="form-control">
                        </div>
                        <button class="btn btn-success">{{ __('payment.pay') }}</button>
                    </form>
                @endif



            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('admin.warehouse_rentals.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
                <div>
                    @ability('admin', 'update_warehouse_rentals')
                        <a href="{{ route('admin.warehouse_rentals.edit', $warehouseRental->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                        </a>
                    @endability
                    @ability('admin', 'delete_warehouse_rentals')
                        <a href="javascript:void(0)" class="btn btn-danger"
                           onclick="confirmDelete('delete-rental-{{ $warehouseRental->id }}',
                                                 '{{ __('panel.confirm_delete_message') }}',
                                                 '{{ __('panel.yes_delete') }}',
                                                 '{{ __('panel.cancel') }}')">
                            <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                        </a>
                        <form action="{{ route('admin.warehouse_rentals.destroy', $warehouseRental->id) }}"
                              method="post" class="d-none" id="delete-rental-{{ $warehouseRental->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endability
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
