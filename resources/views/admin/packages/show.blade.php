@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-sm-0">{{ __('package.package_details') }} #{{ $package->id }}</h3>
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.packages.print', $package->id) }}" target="_blank">
        <i class="fas fa-download me-1"></i>
        {{ __('package.download_waybill') }}
    </a>


    <div class="row mt-4">
        <!-- معلومات الطرد -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-package-variant-closed me-2"></i> {{ __('package.package_info') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-barcode-scan me-2 text-muted"></i> {{ __('package.tracking_number') }}</span>
                            <span class="fw-bold">{{ $package->tracking_number ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-store me-2 text-muted"></i> {{ __('package.merchant') }}</span>
                            <span class="fw-bold">{{ $package->merchant?->name ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-circle-medium me-2 text-muted"></i> {{ __('package.status') }}</span>
                            <span class="badge bg-{{ getStatusColor($package->status) }}">{{ __('package.status_' . $package->status) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-truck-delivery me-2 text-muted"></i> {{ __('package.delivery_method') }}</span>
                            <span class="fw-bold">{{ __('package.method_' . $package->delivery_method) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-speedometer me-2 text-muted"></i> {{ __('package.delivery_speed') }}</span>
                            <span class="fw-bold">{{ __('package.speed_' . $package->delivery_speed) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-calendar-clock me-2 text-muted"></i> {{ __('package.delivery_date') }}</span>
                            <span class="fw-bold">{{ $package->delivery_date ? \Carbon\Carbon::parse($package->delivery_date)->format('Y-m-d h:i A') : '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-shape me-2 text-muted"></i> {{ __('package.package_type') }}</span>
                            <span class="fw-bold">{{ __('package.type_' . $package->package_type) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-ruler-square me-2 text-muted"></i> {{ __('package.package_size') }}</span>
                            <span class="fw-bold">{{ __('package.size_' . $package->package_size) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-weight-kilogram me-2 text-muted"></i> {{ __('package.weight') }}</span>
                            <span class="fw-bold">{{ $package->weight ?? '-' }} kg</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-arrow-expand-all me-2 text-muted"></i> {{ __('package.dimensionss') }}</span>
                            <span class="fw-bold">
                                {{ $package->dimensions['length'] ?? '-' }} x
                                {{ $package->dimensions['width'] ?? '-' }} x
                                {{ $package->dimensions['height'] ?? '-' }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-cash me-2 text-muted"></i> {{ __('package.total_fee') }}</span>
                            <span class="fw-bold text-success">{{ $package->total_fee ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- معلومات المرسل والمستلم -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-account-arrow-left me-2"></i> {{ __('package.sender_Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm me-3">
                            <span class="avatar-title bg-soft-primary rounded-circle text-primary font-size-16">
                                <i class="mdi mdi-account-outline"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $package->sender_first_name }} {{ $package->sender_last_name }}</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" width="30%"><i class="mdi mdi-email-outline me-1 text-muted"></i> {{ __('package.email') }}</th>
                                    <td>{{ $package->sender_email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-phone-outline me-1 text-muted"></i> {{ __('package.phone') }}</th>
                                    <td>{{ $package->sender_phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-map-marker-outline me-1 text-muted"></i> {{ __('package.address') }}</th>
                                    <td>{{ $package->sender_address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-earth me-1 text-muted"></i> {{ __('package.country') }}</th>
                                    <td>{{ $package->sender_country ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-account-arrow-right me-2"></i> {{ __('package.receiver_Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm me-3">
                            <span class="avatar-title bg-soft-success rounded-circle text-success font-size-16">
                                <i class="mdi mdi-account-outline"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $package->receiver_first_name }} {{ $package->receiver_last_name }}</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" width="30%"><i class="mdi mdi-email-outline me-1 text-muted"></i> {{ __('package.email') }}</th>
                                    <td>{{ $package->receiver_email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-phone-outline me-1 text-muted"></i> {{ __('package.phone') }}</th>
                                    <td>{{ $package->receiver_phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-map-marker-outline me-1 text-muted"></i> {{ __('package.address') }}</th>
                                    <td>{{ $package->receiver_address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-earth me-1 text-muted"></i> {{ __('package.country') }}</th>
                                    <td>{{ $package->receiver_country ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- المنتجات والخط الزمني -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-cube-scan me-2"></i> {{ __('package.products_in_package') }}</h5>
                </div>
                <div class="card-body">
                    @if($package->packageProducts->count())
                        <div class="table-responsive">
                            <table class="table table-sm table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('package.type') }}</th>
                                        <th>{{ __('package.custom_name') }}</th>
                                        <th>{{ __('package.quantity') }}</th>
                                        <th>{{ __('package.total_price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($package->packageProducts as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><span class="badge bg-soft-primary text-primary">{{ __('package.'.$product->type) }}</span></td>
                                            <td>{{ $product->custom_name ?? '-' }}</td>
                                            <td>{{ $product->quantity ?? '-' }}</td>
                                            <td class="fw-bold">{{ $product->total_price ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('package.no_products') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- تفاصيل الفاتورة والدفع المالي -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-cash-multiple me-2"></i> {{ __('package.invoice_payment') }}</h5>
                </div>
                <div class="card-body">
                    @php
                        $invoice = $package->invoice;
                    @endphp

                    @if($invoice)
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>{{ __('package.invoice_number') }}:</strong> {{ $invoice->invoice_number }}</div>
                            <div class="col-md-4"><strong>{{ __('package.total_amount') }}:</strong> {{ $invoice->total_amount }}</div>
                            <div class="col-md-4"><strong>{{ __('package.status') }}:</strong>
                                <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'warning' }}">{{ ucfirst($invoice->status) }}</span>
                            </div>
                        </div>

                        <!-- جدول الدفعات -->
                        @if($invoice->payments->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="15%">{{ __('invoice.amount') }}</th>
                                            <th width="15%">{{ __('invoice.method') }}</th>
                                            <th width="15%">{{ __('invoice.paid_on') }}</th>
                                            <th width="35%">{{ __('invoice.notes') }}</th>
                                            <th width="20%">{{ __('invoice.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->payments as $payment)
                                            <tr>
                                                <td class="fw-bold">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ __('invoice.methods.'.$payment->method) }}
                                                    </span>
                                                </td>
                                                <td>{{ $payment->paid_on?->format('d/m/Y H:i') ?? '-' }}</td>
                                                <td>{{ $payment->reference_note ?: '-' }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                                        class="btn btn-sm btn-outline-primary"
                                                        title="{{ __('invoice.edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('{{ __('invoice.confirm_delete') }}')"
                                                                    title="{{ __('invoice.delete') }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <i class="mdi mdi-information-outline me-2"></i> {{ __('package.no_payments') }}
                            </div>
                        @endif
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('package.no_invoice') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- الخط الزمني -->
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="card mt-4">
                <div class="card-header">{{ __('package.timeline_title') }}</div>
                <div class="card-body">
                    <section id="cd-timeline" class="cd-container">
                        @forelse($package->packageLogs as $log)
                            @php
                                $translatedStatus = __('package.status_' . $log->status);
                                $color = match($log->status) {
                                    'delivered'        => 'success',
                                    'out_for_delivery' => 'info',
                                    'in_warehouse'     => 'primary',
                                    'returned'         => 'danger',
                                    'pending'          => 'warning',
                                    'cancelled'        => 'dark',
                                    'delivery_failed'  => 'danger',
                                    default            => 'secondary',
                                };
                            @endphp

                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img bg-{{ $color }} text-white">
                                    <i class="mdi mdi-adjust"></i>
                                </div>

                                <div class="cd-timeline-content">
                                    <h3>{{ $translatedStatus }}</h3>
                                    <p class="mb-0 text-muted font-14">{{ $log->note ?? '-' }}</p>
                                    {{-- <span class="cd-date">{{ $log->logged_at->format('Y-m-d H:i') }}</span> --}}
                                    <span class="cd-date">{{ $log->logged_at->format('Y-m-d h:i A') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">{{ __('package.timeline_empty') }}</p>
                        @endforelse
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@php
 function getStatusColor($status) {
        return match($status) {
            'pending'           => 'warning',
            'assigned_to_driver'=> 'primary',
            'driver_picked_up'  => 'info',
            'in_transit'        => 'info',
            'arrived_at_hub'    => 'secondary',
            'out_for_delivery'  => 'primary',
            'delivered'         => 'success',
            'delivery_failed'   => 'danger',
            'returned'          => 'secondary',
            'cancelled'         => 'danger',
            'in_warehouse'      => 'secondary',
            default              => 'secondary',
        };
    }
@endphp
