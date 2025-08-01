@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between bg-white p-3 rounded-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-truck-delivery-outline fs-2 text-primary me-3"></i>
                    <h4 class="mb-0 fw-bold">تفاصيل الشحنة الخارجية</h4>
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.external_shipments.edit', $shipment->id) }}" class="btn btn-primary me-2">
                        <i class="mdi mdi-pencil-outline me-1"></i> تعديل
                    </a>
                    <a href="{{ route('admin.external_shipments.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> عودة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-information-outline me-2"></i>
                        معلومات الشحنة الأساسية
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">رقم التتبع الخارجي</td>
                                    <td>
                                        <span class="badge bg-light text-dark fs-6">
                                            {{ $shipment->external_tracking_number }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">شريك الشحن</td>
                                    <td>
                                        @if($shipment->shippingPartner)
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-account-tie-outline me-2"></i>
                                            {{ $shipment->shippingPartner->name }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">الطرد</td>
                                    <td>
                                        @if($shipment->package)
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            {{ $shipment->package->package_number }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">الحالة</td>
                                    <td>
                                        <span class="badge bg-{{
                                            $shipment->status == 'delivered' ? 'success' :
                                            ($shipment->status == 'in_transit' ? 'primary' : 'warning')
                                        }}">
                                            {{ ucfirst($shipment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">عرض الحالة</td>
                                    <td>
                                        <span class="badge bg-{{ $shipment->status_visible ? 'success' : 'secondary' }}">
                                            {{ $shipment->status_visible ? 'مرئي' : 'مخفي' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-clock-outline me-2"></i>
                        التواريخ والأوقات
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">تاريخ التسليم</td>
                                    <td>
                                        @if($shipment->delivery_date)
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-check-outline me-2"></i>
                                            {{ $shipment->delivery_date->format('Y-m-d') }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">تاريخ التزامن</td>
                                    <td>
                                        @if($shipment->synced_at)
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-sync me-2"></i>
                                            {{ $shipment->synced_at->format('Y-m-d H:i') }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">تاريخ التسليم الفعلي</td>
                                    <td>
                                        @if($shipment->delivered_at)
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-truck-check-outline me-2"></i>
                                            {{ $shipment->delivered_at->format('Y-m-d H:i') }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">تاريخ النشر</td>
                                    <td>
                                        @if($shipment->published_on)
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-star me-2"></i>
                                            {{ $shipment->published_on->format('Y-m-d') }}
                                        </span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-account-details-outline me-2"></i>
                        معلومات المسؤول
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">مُنشأ بواسطة</td>
                                    <td>{{ $shipment->created_by }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">مُحدّث بواسطة</td>
                                    <td>{{ $shipment->updated_by ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .table-borderless tbody tr td {
        padding: 0.75rem 0.5rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .table-borderless tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
@endpush
