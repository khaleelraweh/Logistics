@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between bg-white p-3 rounded-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-truck-delivery-outline fs-2 text-primary me-3"></i>
                    <h4 class="mb-0 fw-bold">{{ __('shipping_partner.view_shipping_partner') }}</h4>
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.shipping_partners.edit', $shipping_partner->id) }}" class="btn btn-primary me-2">
                        <i class="mdi mdi-pencil-outline me-1"></i> {{ __('general.edit') }}
                    </a>
                    <form action="{{ route('admin.shipping_partners.destroy', $shipping_partner->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('{{ __('messages.are_you_sure') }}')">
                            <i class="mdi mdi-trash-can-outline me-1"></i> {{ __('general.delete') }}
                        </button>
                    </form>
                    <a href="{{ route('admin.shipping_partners.index') }}" class="btn btn-outline-secondary ms-2">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Shipping Partner Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-information-outline me-2"></i>
                        {{ __('shipping_partner.basic_info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 text-center">
                            @if($shipping_partner->logo)
                                <img src="{{ asset('assets/shipping_partners/' . $shipping_partner->logo) }}"
                                     class="img-fluid rounded-circle shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     alt="{{ $shipping_partner->name }}">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                     style="width: 150px; height: 150px; margin: 0 auto;">
                                    <i class="mdi mdi-truck-delivery fs-1 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3 class="fw-bold">{{ $shipping_partner->name }}</h3>
                            <span class="badge bg-{{ $shipping_partner->status ? 'success' : 'danger' }}">
                                {{ $shipping_partner->status ? __('general.active') : __('general.inactive') }}
                            </span>
                            <p class="mt-2">{{ $shipping_partner->description }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">{{ __('shipping_partner.address') }}</td>
                                    <td>{{ $shipping_partner->address }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.created_at') }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock-outline me-2"></i>
                                            {{ $shipping_partner->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.updated_at') }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-edit-outline me-2"></i>
                                            {{ $shipping_partner->updated_at->format('Y-m-d H:i') }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & API Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-account-box-outline me-2"></i>
                        {{ __('shipping_partner.contact_info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">{{ __('shipping_partner.contact_person') }}</td>
                                    <td>{{ $shipping_partner->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.contact_phone') }}</td>
                                    <td>
                                        <a href="tel:{{ $shipping_partner->contact_phone }}" class="text-decoration-none">
                                            <i class="mdi mdi-phone-outline me-2"></i>
                                            {{ $shipping_partner->contact_phone }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.contact_email') }}</td>
                                    <td>
                                        <a href="mailto:{{ $shipping_partner->contact_email }}" class="text-decoration-none">
                                            <i class="mdi mdi-email-outline me-2"></i>
                                            {{ $shipping_partner->contact_email }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-api me-2"></i>
                        {{ __('shipping_partner.api_info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-40 fw-bold text-muted">{{ __('shipping_partner.api_url') }}</td>
                                    <td>
                                        <code>{{ $shipping_partner->api_url ?? '-' }}</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.auth_type') }}</td>
                                    <td>{{ $shipping_partner->auth_type ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.api_token') }}</td>
                                    <td>
                                        @if($shipping_partner->api_token)
                                            <span class="badge bg-light text-dark" data-bs-toggle="tooltip" title="{{ $shipping_partner->api_token }}">
                                                ••••••••••••••••
                                            </span>
                                            <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $shipping_partner->api_token }}')">
                                                <i class="mdi mdi-content-copy"></i>
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">{{ __('shipping_partner.credentials') }}</td>
                                    <td>{{ $shipping_partner->credentails ?? '-' }}</td>
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

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('API Token copied to clipboard!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush

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

    code {
        background: #f8f9fa;
        padding: 2px 5px;
        border-radius: 3px;
        color: #d63384;
    }
</style>
@endpush
