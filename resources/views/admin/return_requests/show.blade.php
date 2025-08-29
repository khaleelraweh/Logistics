@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between bg-white p-3 rounded-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-file-document-outline fs-2 text-primary me-3"></i>
                    <h4 class="mb-0 fw-bold">{{ __('return_request.view_return_request') }}</h4>
                </div>
                <div class="d-flex">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('return_request.view_return_request') }}</li>
                    </ol>
                    {{-- <a href="{{ route('admin.return_requests.edit', $return_request->id) }}" class="btn btn-primary me-2">
                        <i class="mdi mdi-pencil-outline me-1"></i> {{ __('return_request.edit') }}
                    </a>
                    <a href="{{ route('admin.return_requests.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('return_request.back') }}
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Return Request Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-information-outline me-2"></i>
                        {{ __('return_request.return_request_info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">{{ __('return_request.id') }}</td>
                                    <td class="fw-semibold">#{{ $return_request->id }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.package') }}</td>
                                    <td>

                                        @if($return_request->package)
                                            <span class="badge bg-light text-dark">{{ $return_request->package->tracking_number }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.sender') }}</td>
                                    <td>
                                        @if($return_request->package)
                                            <span class="d-flex align-items-center">
                                                @if($return_request->package->merchant)
                                                    <i class="mdi mdi-store-outline me-2"></i>
                                                    {{ $return_request->package->merchant->name }} - {{ $return_request->package->merchant->contact_person }}
                                                @else
                                                    <i class="mdi mdi-user-outline me-2"></i>
                                                    {{ $return_request->package->sender_full_name }}
                                                @endif
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.receiver') }}</td>
                                    <td>
                                        @if($return_request->package)
                                            <span class="d-flex align-items-center">
                                                @if($return_request->package->receiverMerchant)
                                                    <i class="mdi mdi-store-outline me-2"></i>
                                                    {{ $return_request->package->receiverMerchant->name }} - {{ $return_request->package->receiverMerchant->contact_person }}
                                                @else
                                                    <i class="mdi mdi-user-outline me-2"></i>
                                                    {{ $return_request->package->receiver_full_name }}
                                                @endif
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.driver') }}</td>
                                    <td>
                                        @if($return_request->driver)
                                            <span class="d-flex align-items-center">
                                                <i class="mdi mdi-account-tie-outline me-2"></i>
                                                {{ $return_request->driver->driver_full_name }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.return_type') }}</td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            {{ __('return_request.type_' . ($return_request->return_type ?? '')) ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.target_address') }}</td>
                                    <td>{{ $return_request->target_address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.status') }}</td>
                                    <td>{!! $return_request->statusLabel() !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-clock-outline me-2"></i>
                        {{ __('return_request.additional_info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">{{ __('return_request.requested_at') }}</td>
                                    <td>
                                        @if($return_request->requested_at)
                                            <span class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-clock-outline me-2"></i>
                                                {{ $return_request->requested_at->format('Y-m-d H:i') }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.received_at') }}</td>
                                    <td>
                                        @if($return_request->received_at)
                                            <span class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-check-outline me-2"></i>
                                                {{ $return_request->received_at->format('Y-m-d H:i') }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.created_at') }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-plus-outline me-2"></i>
                                            {{ $return_request->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.updated_at') }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-edit-outline me-2"></i>
                                            {{ $return_request->updated_at->format('Y-m-d H:i') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.reason') }}</td>
                                    <td>{{ $return_request->reason ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('return_request.note') }}</td>
                                    <td>{{ $return_request->note ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Items Section -->
    @if($return_request->returnItems && $return_request->returnItems->count())
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-package-variant-closed me-2"></i>
                        {{ __('return_request.return_items') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">{{ __('return_request.item_id') }}</th>
                                    <th>{{ __('return_request.type') }}</th>
                                    <th>{{ __('return_request.quantity') }}</th>
                                    <th>{{ __('return_request.note') }}</th>
                                    <th class="pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($return_request->returnItems as $item)
                                <tr>
                                    <td class="ps-4 fw-semibold">#{{ $item->id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->type == 'product' ? 'success' : 'info' }} bg-opacity-10 text-{{ $item->type == 'product' ? 'success' : 'info' }}">
                                            {{ ucfirst($item->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td>{{ $item->note ?? '-' }}</td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
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
