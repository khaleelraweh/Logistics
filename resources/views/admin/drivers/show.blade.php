@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('driver.view_driver') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">{{ __('driver.drivers') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('driver.view_driver') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- بطاقة العنوان الرئيسية -->
            <div class="card card-profile overflow-hidden mb-5" style="border-radius: 15px;">
                <div class="card-header bg-gradient-primary p-3 position-relative" style="background-color: black;">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="text-dark mb-0">{{ __('driver.driver_details') }}</h4>
                            <h2 class="text-dark">{{ $driver->driver_full_name }}  </h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-dark btn-sm me-2">
                                <i class="fas fa-edit me-1"></i> {{ __('general.edit') }}
                            </a>
                            <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark btn-sm" onclick="return confirm('{{ __('messages.are_you_sure') }}')">
                                    <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100">
                        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                            <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
                            <g class="moving-waves">
                                <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40)" />
                                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                                <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                                <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                                <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95)" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mt-4">
                        <!-- الصورة الشخصية -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-blog card-plain h-100">
                                <div class="card-header p-0 mt-n4 mx-3">
                                    <div class="shadow-lg rounded-circle overflow-hidden" style="width: 150px; height: 150px; margin: 0 auto;">
                                        @if($driver->driver_image)
                                        <img src="{{ asset('assets/drivers/' . $driver->driver_image) }}"
                                             class="img-fluid w-100 h-100 object-cover cursor-pointer"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             onclick="showImageInModal('{{ asset('assets/drivers/' . $driver->driver_image) }}', '{{ __('driver.driver_image') }}')">
                                        @else
                                        <div class="bg-gradient-dark w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user text-dark" style="font-size: 3rem;"></i>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="mb-0">{{ $driver->driver_full_name }}</h5>
                                    <p class="text-sm text-muted mb-2">{{ $driver->username }}</p>
                                    <span class="badge bg-gradient-{{ $driver->status == 'active' ? 'success' : 'danger' }} mb-2">
                                        {{ $driver->status == 'active' ? __('driver.status_active') : __('driver.status_inactive') }}
                                    </span>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button class="btn btn-sm btn-icon-only btn-rounded btn-outline-secondary mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $driver->email }}">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon-only btn-rounded btn-outline-secondary mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $driver->phone }}">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- المعلومات الأساسية -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-gradient-info p-3">
                                    <h6 class="mb-0 text-dark">{{ __('driver.personal_info') }}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0">
                                            <div class="d-flex">
                                                <i class="fas fa-id-card me-2 mt-1 text-info"></i>
                                                <span class="text-sm">{{ $driver->username }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <div class="d-flex">
                                                <i class="fas fa-envelope me-2 mt-1 text-info"></i>
                                                <span class="text-sm">{{ $driver->email }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <div class="d-flex">
                                                <i class="fas fa-phone me-2 mt-1 text-info"></i>
                                                <span class="text-sm">{{ $driver->phone }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <div class="d-flex">
                                                <i class="fas fa-calendar-alt me-2 mt-1 text-info"></i>
                                                <span class="text-sm">{{ $driver->hired_date }}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 pb-0">
                                            <div class="d-flex">
                                                <i class="fas fa-user-shield me-2 mt-1 text-info"></i>
                                                <span class="text-sm">{{ $driver->supervisor_id ? $driver->supervisor->full_name : '-' }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات المركبة -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-gradient-success p-3">
                                    <h6 class="mb-0 text-dark">{{ __('driver.vehicle_info') }}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon icon-shape bg-success shadow text-center rounded-circle me-3">
                                            <i class="fas fa-car text-dark opacity-10"></i>
                                        </div>
                                        <div>
                                            <span class="text-sm"> {{ __('driver.vehicle_type_' . $driver->vehicle_type ) }} </span>
                                            <h6 class="mb-0"> {{ __('driver.vehicle_model_' . $driver->vehicle_model ) }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="border-radius-lg p-2 bg-gray-100 text-center mb-2">
                                                <h6 class="mb-0 text-sm">{{ $driver->vehicle_number }}</h6>
                                                <span class="text-xs">{{ __('driver.vehicle_number') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border-radius-lg p-2 bg-gray-100 text-center mb-2">
                                                <h6 class="mb-0 text-sm"> {{ __('driver.vehicle_color_' . $driver->vehicle_color ) }} </h6>
                                                <span class="text-xs">{{ __('driver.vehicle_color') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border-radius-lg p-2 bg-gray-100 text-center">
                                                <h6 class="mb-0 text-sm">{{ __('driver.vehicle_capacity_weight_' . $driver->vehicle_capacity_weight ) }} </h6>
                                                <span class="text-xs">{{ __('driver.weight_capacity') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border-radius-lg p-2 bg-gray-100 text-center">
                                                <h6 class="mb-0 text-sm"> {{ __('driver.vehicle_capacity_volume_' . $driver->vehicle_capacity_volume ) }} </h6>
                                                <span class="text-xs">{{ __('driver.volume_capacity') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات الرخصة -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-gradient-warning p-3">
                                    <h6 class="mb-0 text-dark">{{ __('driver.license_info') }}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon icon-shape bg-warning shadow text-center rounded-circle me-3">
                                            <i class="fas fa-id-card-alt text-dark opacity-10"></i>
                                        </div>
                                        <div>
                                            <span class="text-sm">{{ $driver->license_number }}</span>
                                            <h6 class="mb-0 {{ \Carbon\Carbon::parse($driver->license_expiry_date)->isPast() ? 'text-danger' : 'text-success' }}">
                                                {{ $driver->license_expiry_date }}
                                            </h6>
                                        </div>
                                    </div>
                                    @if($driver->license_image)
                                    <div class="text-center mt-4">
                                        <img src="{{ asset('assets/drivers/' . $driver->license_image) }}"
                                             class="rounded img-fluid shadow cursor-pointer"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             onclick="showImageInModal('{{ asset('assets/drivers/' . $driver->license_image) }}', '{{ __('driver.license_image') }}')">
                                        <p class="text-xs text-muted mt-2">{{ __('driver.license_image') }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Modal لعرض الصورة بحجم كبير -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-dark" id="imageModalTitle"></h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" class="img-fluid rounded-bottom" alt="">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showImageInModal(imageSrc, title) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = title;
    }

    // تهيئة أدوات التلميح
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
    .card-profile {
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-profile:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .waves {
        position: relative;
        width: 100%;
        height: 60px;
        margin-bottom: -7px;
        min-height: 60px;
        max-height: 60px;
    }

    .moving-waves > use {
        animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
    }

    .moving-waves > use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }

    .moving-waves > use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }

    .moving-waves > use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }

    .moving-waves > use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }

    @keyframes move-forever {
        0% { transform: translate3d(-90px,0,0); }
        100% { transform: translate3d(85px,0,0); }
    }

    .card-background {
        background-size: cover;
        background-position: center;
        min-height: 200px;
        border-radius: 12px !important;
        overflow: hidden;
    }

    .card-background:after {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        height: 100%;
        z-index: 1;
        width: 100%;
        display: block;
        content: "";
        background: rgba(0, 0, 0, 0.4);
    }

    .card-background .card-body {
        position: relative;
        z-index: 2;
    }

    .move-on-hover {
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .move-on-hover:hover {
        transform: translateY(-10px);
    }

    /* تحسينات رؤية النص على الخلفيات الملونة */
    .card-header .text-dark,
    .card-header.bg-gradient-primary .text-dark,
    .card-header.bg-gradient-info .text-dark,
    .card-header.bg-gradient-success .text-dark,
    .card-header.bg-gradient-warning .text-dark,
    .card-header.bg-gradient-dark .text-white {
        color: var(--bs-dark) !important;
    }

    .bg-gradient-primary .text-dark,
    .bg-gradient-info .text-dark,
    .bg-gradient-success .text-dark,
    .bg-gradient-warning .text-dark {
        color: var(--bs-dark) !important;
    }

    .bg-gradient-dark .text-white {
        color: var(--bs-white) !important;
    }

    .icon-shape .text-dark {
        color: var(--bs-dark) !important;
    }
</style>
@endpush
