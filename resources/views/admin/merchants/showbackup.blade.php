@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between">
            <h4 class="mb-0">{{ __('merchant.merchant_details') }}</h4>
            <div>
                <a href="{{ route('admin.merchants.index') }}" class="btn btn-secondary btn-sm">{{ __('general.back') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- بيانات التاجر -->
{{-- <div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title">{{ __('merchant.basic_info') }}</h4>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('merchant.name') }}:</strong></div><div class="col-md-9">{{ $merchant->getTranslation('name', app()->getLocale()) }}</div></div>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('general.address') }}:</strong></div><div class="col-md-9">{{ $merchant->getTranslation('address', app()->getLocale()) }}</div></div>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('merchant.contact_person') }}:</strong></div><div class="col-md-9">{{ $merchant->getTranslation('contact_person', app()->getLocale()) }}</div></div>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('general.phone') }}:</strong></div><div class="col-md-9">{{ $merchant->phone }}</div></div>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('general.email') }}:</strong></div><div class="col-md-9">{{ $merchant->email }}</div></div>
                <div class="row mb-3"><div class="col-md-3"><strong>{{ __('merchant.api_key') }}:</strong></div><div class="col-md-9">{{ $merchant->api_key }}</div></div>
            </div>
            <div class="col-sm-4">
                @if($merchant->logo)
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>{{ __('merchant.logo') }}:</strong></div>
                        <div class="col-md-9">
                            <img src="{{ asset('assets/merchants/' . $merchant->logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 120px;">
                        </div>
                    </div>
                @endif
                <ul class="list-unstyled">
                    @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                        @if($merchant->$social)
                            <li><a href="{{ $merchant->$social }}" target="_blank">{{ ucfirst($social) }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div> --}}

<!-- بيانات التاجر -->
{{-- <div class="card mt-3">
    <div class="card-body">
        <div class="row align-items-start">
            <div class="col-md-8">
                <h4 class="card-title mb-4">{{ __('merchant.basic_info') }}</h4>

                @php
                    $fields = [
                        __('merchant.name') => $merchant->getTranslation('name', app()->getLocale()),
                        __('general.address') => $merchant->getTranslation('address', app()->getLocale()),
                        __('merchant.contact_person') => $merchant->getTranslation('contact_person', app()->getLocale()),
                        __('general.phone') => $merchant->phone,
                        __('general.email') => $merchant->email,
                        __('merchant.api_key') => $merchant->api_key,
                    ];
                @endphp

                @foreach ($fields as $label => $value)
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">{{ $label }}:</div>
                        <div class="col-md-8">{{ $value }}</div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="mb-3 text-center">
                    <strong class="d-block mb-2">{{ __('merchant.logo') }}:</strong>
                    @if($merchant->logo)
                        <img src="{{ asset('assets/merchants/' . $merchant->logo) }}" alt="Logo" class="img-thumbnail shadow-sm rounded" style="max-height: 120px;">
                    @else
                        <div class="border border-dashed rounded p-4 text-muted" style="height: 120px; display: flex; align-items: center; justify-content: center;">
                            <span>{{ __('merchant.no_logo_available') }}</span>
                        </div>
                    @endif
                </div>

                @php
                    $socials = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'];
                @endphp
                <ul class="list-unstyled text-center">
                    @foreach ($socials as $social)
                        @if($merchant->$social)
                            <li class="mb-1">
                                <a href="{{ $merchant->$social }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-{{ $social == 'website' ? 'globe' : $social }}"></i>
                                    {{ ucfirst($social) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div> --}}


<!-- بطاقة بيانات التاجر بشكل أنيق -->
{{-- <div class="card mt-3 shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center">
            @if($merchant->logo)
                <img src="{{ asset('assets/merchants/' . $merchant->logo) }}"
                     alt="Merchant Logo"
                     class="me-3 rounded-circle img-thumbnail avatar-lg"
                     style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <div class="me-3 rounded-circle border border-dashed d-flex align-items-center justify-content-center"
                     style="width: 100px; height: 100px; color: #888;">
                    <i class="fas fa-store fa-2x"></i>
                </div>
            @endif

            <div class="flex-grow-1">
                <h5 class="mt-0 font-size-18 mb-1">{{ $merchant->getTranslation('name', app()->getLocale()) }}</h5>
                <p class="text-muted mb-2">{{ $merchant->getTranslation('contact_person', app()->getLocale()) }}</p>

                <ul class="list-inline mb-0">
                    @php
                        $socials = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'];
                    @endphp
                    @foreach ($socials as $social)
                        @if($merchant->$social)
                            <li class="list-inline-item">
                                <a href="{{ $merchant->$social }}" target="_blank" class="text-reset"
                                   title="{{ ucfirst($social) }}" data-bs-toggle="tooltip">
                                    <i class="fab fa-{{ $social == 'website' ? 'globe' : $social }}"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach
                    @if($merchant->phone)
                        <li class="list-inline-item">
                            <a role="button" class="text-reset" title="{{ $merchant->phone }}" data-bs-toggle="tooltip">
                                <i class="fas fa-phone-alt"></i>
                            </a>
                        </li>
                    @endif
                    @if($merchant->email)
                        <li class="list-inline-item">
                            <a href="mailto:{{ $merchant->email }}" class="text-reset" title="{{ $merchant->email }}" data-bs-toggle="tooltip">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4 fw-semibold">{{ __('general.address') }}:</div>
            <div class="col-md-8 mb-2">{{ $merchant->getTranslation('address', app()->getLocale()) }}</div>

            <div class="col-md-4 fw-semibold">{{ __('merchant.api_key') }}:</div>
            <div class="col-md-8 mb-2">{{ $merchant->api_key }}</div>
        </div>
    </div>
</div>
 --}}


 <div class="card border-0 shadow-lg overflow-hidden">
    <!-- رأس البطاقة مع الشعار والمعلومات الأساسية -->
    <div class="card-header bg-primary bg-opacity-10 py-3 border-0">
        <div class="d-flex align-items-center">
            @if($merchant->logo)
                <div class="position-relative me-3">
                    <img src="{{ asset('assets/merchants/' . $merchant->logo) }}"
                         alt="{{ __('merchant.logo') }}"
                         class="rounded-3 shadow-sm object-fit-cover"
                         style="width: 80px; height: 80px;">
                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 translate-middle rounded-circle p-0"
                            style="width: 24px; height: 24px;"
                            data-bs-toggle="modal" data-bs-target="#logoModal">
                        <i class="bi bi-zoom-in fs-6"></i>
                    </button>
                </div>
            @else
                <div class="me-3 rounded-3 bg-light d-flex align-items-center justify-content-center shadow-sm"
                     style="width: 80px; height: 80px;">
                    <i class="bi bi-shop text-muted fs-2"></i>
                </div>
            @endif

            <div class="flex-grow-1">
                <h3 class="mb-1 text-dark">{{ $merchant->getTranslation('name', app()->getLocale()) }}</h3>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if($merchant->contact_person)
                        <span class="badge bg-white text-dark border border-secondary rounded-pill">
                            <i class="bi bi-person-fill me-1"></i>
                            {{ $merchant->getTranslation('contact_person', app()->getLocale()) }}
                        </span>
                    @endif

                    @if($merchant->email)
                        <a href="mailto:{{ $merchant->email }}"
                           class="badge bg-white text-primary border border-primary rounded-pill text-decoration-none">
                            <i class="bi bi-envelope-fill me-1"></i>
                            {{ __('general.email') }}
                        </a>
                    @endif

                    @if($merchant->phone)
                        <a href="tel:{{ $merchant->phone }}"
                           class="badge bg-white text-success border border-success rounded-pill text-decoration-none">
                            <i class="bi bi-telephone-fill me-1"></i>
                            {{ __('general.phone') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- جسم البطاقة -->
    <div class="card-body">
        <!-- الروابط الاجتماعية -->
        @php
            $socials = [
                'facebook' => ['icon' => 'bi-facebook', 'color' => 'primary'],
                'twitter' => ['icon' => 'bi-twitter', 'color' => 'info'],
                'instagram' => ['icon' => 'bi-instagram', 'color' => 'danger'],
                'linkedin' => ['icon' => 'bi-linkedin', 'color' => 'primary'],
                'youtube' => ['icon' => 'bi-youtube', 'color' => 'danger'],
                'website' => ['icon' => 'bi-globe', 'color' => 'success']
            ];

            $hasSocials = false;
            foreach($socials as $social => $data) {
                if($merchant->$social) {
                    $hasSocials = true;
                    break;
                }
            }
        @endphp

        @if($hasSocials)
            <div class="mb-4">
                <h6 class="mb-3 text-muted fw-semibold">
                    <i class="bi bi-share me-1"></i>
                    {{ __('merchant.social_links') }}
                </h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($socials as $social => $data)
                        @if($merchant->$social)
                            <a href="{{ $merchant->$social }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-{{ $data['color'] }} rounded-pill px-3"
                               data-bs-toggle="tooltip"
                               title="{{ ucfirst($social) }}">
                                <i class="{{ $data['icon'] }} me-1"></i>
                                {{ ucfirst($social) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- المعلومات التفصيلية -->
        <div class="row g-3">
            <div class="col-md-6">
                <div class="bg-light rounded p-3 h-100">
                    <h6 class="mb-3 text-muted fw-semibold">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ __('merchant.basic_info') }}
                    </h6>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 d-flex">
                            <span class="text-muted flex-shrink-0" style="width: 120px;">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ __('general.address') }}:
                            </span>
                            <span class="fw-semibold">
                                {{ $merchant->getTranslation('address', app()->getLocale()) }}
                            </span>
                        </li>
                        <li class="mb-2 d-flex">
                            <span class="text-muted flex-shrink-0" style="width: 120px;">
                                <i class="bi bi-key me-1"></i>
                                {{ __('merchant.api_key') }}:
                            </span>
                            <span class="fw-semibold">
                                {{ $merchant->api_key }}
                                <button class="btn btn-sm btn-link p-0 ms-2" data-bs-toggle="tooltip" title="{{ __('general.copy') }}">
                                    <i class="bi bi-copy"></i>
                                </button>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-light rounded p-3 h-100">
                    <h6 class="mb-3 text-muted fw-semibold">
                        <i class="bi bi-graph-up me-1"></i>
                        {{ __('merchant.stats') }}
                    </h6>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 bg-white rounded text-center">
                                <div class="text-muted small mb-1">{{ __('merchant.total_orders') }}</div>
                                <div class="h5 mb-0 fw-bold text-primary">1,245</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-white rounded text-center">
                                <div class="text-muted small mb-1">{{ __('merchant.total_sales') }}</div>
                                <div class="h5 mb-0 fw-bold text-success">$24,567</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-white rounded text-center">
                                <div class="text-muted small mb-1">{{ __('merchant.products') }}</div>
                                <div class="h5 mb-0 fw-bold text-info">87</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-white rounded text-center">
                                <div class="text-muted small mb-1">{{ __('merchant.rating') }}</div>
                                <div class="h5 mb-0 fw-bold text-warning">
                                    <i class="bi bi-star-fill"></i> 4.5
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- تذييل البطاقة -->
    <div class="card-footer bg-transparent border-0 py-3 d-flex justify-content-between">
        <button class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-pencil-square me-1"></i>
            {{ __('general.edit') }}
        </button>
        <div>
            <button class="btn btn-outline-primary rounded-pill px-4 me-2">
                <i class="bi bi-printer me-1"></i>
                {{ __('general.print') }}
            </button>
            <button class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-send me-1"></i>
                {{ __('general.contact') }}
            </button>
        </div>
    </div>
</div>

<!-- مودال عرض الشعار -->
<div class="modal fade" id="logoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $merchant->getTranslation('name', app()->getLocale()) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('assets/merchants/' . $merchant->logo) }}"
                     class="img-fluid rounded-3 shadow"
                     alt="{{ __('merchant.logo') }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>
                    {{ __('general.close') }}
                </button>
                <a href="{{ asset('assets/merchants/' . $merchant->logo) }}"
                   download
                   class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>
                    {{ __('general.download') }}
                </a>
            </div>
        </div>
    </div>
</div>




<!-- روابط التواصل الاجتماعي -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('general.social_links') }}</h4>
        <ul class="list-unstyled">
            @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                @if($merchant->$social)
                    <li><a href="{{ $merchant->$social }}" target="_blank">{{ ucfirst($social) }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

<!-- عقود إيجار المستودعات -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.warehouse_rentals') }} ({{ $merchant->warehouseRentals->count() }})</h4>
        @if($merchant->warehouseRentals->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('warehouse.rental_start') }}</th>
                            <th>{{ __('warehouse.rental_end') }}</th>
                            <th>{{ __('warehouse.price') }}</th>
                            <th>{{ __('general.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->warehouseRentals as $rental)
                            <tr>
                                <td>{{ $rental->id }}</td>
                                <td>{{ $rental->rental_start }}</td>
                                <td>{{ $rental->rental_end }}</td>
                                <td>{{ $rental->price }}</td>
                                <td>{!! $rental->status_label !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_warehouse_rentals_found') }}</p>
        @endif
    </div>
</div>

<!-- الرفوف المؤجرة -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.rental_shelves') }} ({{ $merchant->rentalShelves->count() }})</h4>
        @if($merchant->rentalShelves->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('warehouse.custom_price') }}</th>
                            <th>{{ __('warehouse.custom_start') }}</th>
                            <th>{{ __('warehouse.custom_end') }}</th>
                            <th>{{ __('warehouse.shelf_name') }}</th>
                            <th>{{ __('warehouse.warehouse_name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->rentalShelves as $rentalShelf)
                            <tr>
                                <td>{{ $rentalShelf->id }}</td>
                                <td>{{ $rentalShelf->custom_price }}</td>
                                <td>{{ $rentalShelf->custom_start }}</td>
                                <td>{{ $rentalShelf->custom_end }}</td>
                                <td>{{ $rentalShelf->shelf->name ?? '-' }}</td>
                                <td>{{ $rentalShelf->shelf->warehouse->getTranslation('name', app()->getLocale()) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_rental_shelves_found') }}</p>
        @endif
    </div>
</div>

<!-- المستودعات التي للتاجر رفوف فيها -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.merchant_warehouses') }} ({{ $merchant->warehouses->count() }})</h4>
        @if($merchant->warehouses->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('general.name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->warehouses as $warehouse)
                            <tr>
                                <td>{{ $warehouse->id }}</td>
                                <td>{{ $warehouse->getTranslation('name', app()->getLocale()) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_warehouses_found') }}</p>
        @endif
    </div>
</div>

<!-- المنتجات -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.merchant_products') }} ({{ $merchant->products->count() }})</h4>
        @if($merchant->products->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('general.name') }}</th>
                            <th>{{ __('general.price') }}</th>
                            <th>{{ __('general.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->status ? __('panel.status_active') : __('panel.status_inactive') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_products_found') }}</p>
        @endif
    </div>
</div>

<!-- المنتجات المخزنة في الرفوف -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.stock_items') }} ({{ $merchant->stockItems->count() }})</h4>
        @if($merchant->stockItems->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('general.product') }}</th>
                            <th>{{ __('general.quantity') }}</th>
                            <th>{{ __('general.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->stockItems as $stockItem)
                            <tr>
                                <td>{{ $stockItem->id }}</td>
                                <td>{{ $stockItem->product->name ?? '-' }}</td>
                                <td>{{ $stockItem->quantity }}</td>
                                <td>{{ $stockItem->status ? __('panel.status_active') : __('panel.status_inactive') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_stock_items_found') }}</p>
        @endif
    </div>
</div>

<!-- المستودعات مع الرفوف والمنتجات المخزنة -->
<div class="card">
    <div class="card-body">
        <h5>{{ __('merchant.merchant_warehouses') }}</h5>

        @if($merchant->warehouses->isNotEmpty())
            <div class="accordion" id="warehouseAccordion">
                @foreach($merchant->warehouses as $wIndex => $warehouse)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="headingWarehouse{{ $warehouse->id }}">
                            <button class="accordion-button {{ $wIndex !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseWarehouse{{ $warehouse->id }}" aria-expanded="{{ $wIndex === 0 ? 'true' : 'false' }}">
                                {{ $warehouse->getTranslation('name', app()->getLocale()) }} ({{ $warehouse->code }})
                            </button>
                        </h2>
                        <div id="collapseWarehouse{{ $warehouse->id }}" class="accordion-collapse collapse {{ $wIndex === 0 ? 'show' : '' }}"
                             aria-labelledby="headingWarehouse{{ $warehouse->id }}" data-bs-parent="#warehouseAccordion">
                            <div class="accordion-body">

                                @php
                                    // نعرض فقط الرفوف المستأجرة للتاجر ضمن هذا المستودع
                                    $rentedShelves = $merchant->rentalShelves->whereIn('shelf_id', $warehouse->shelves->pluck('id'));
                                @endphp

                                @if($rentedShelves->isNotEmpty())
                                    <div class="accordion" id="shelfAccordion{{ $warehouse->id }}">
                                        @foreach($rentedShelves as $sIndex => $rentalShelf)
                                            <div class="accordion-item mb-1">
                                                <h2 class="accordion-header" id="headingShelf{{ $rentalShelf->id }}">
                                                    <button class="accordion-button {{ $sIndex !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseShelf{{ $rentalShelf->id }}" aria-expanded="{{ $sIndex === 0 ? 'true' : 'false' }}">
                                                        {{ $rentalShelf->shelf->code ?? '-' }} | {{ __('rental.custom_price') }}: {{ $rentalShelf->custom_price ?? '-' }}
                                                    </button>
                                                </h2>
                                                <div id="collapseShelf{{ $rentalShelf->id }}" class="accordion-collapse collapse {{ $sIndex === 0 ? 'show' : '' }}"
                                                     aria-labelledby="headingShelf{{ $rentalShelf->id }}" data-bs-parent="#shelfAccordion{{ $warehouse->id }}">
                                                    <div class="accordion-body">

                                                        @php
                                                            $stockItems = $rentalShelf->stockItems;
                                                        @endphp

                                                        @if($stockItems->isNotEmpty())
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{ __('general.id') }}</th>
                                                                            <th>{{ __('general.product') }}</th>
                                                                            <th>{{ __('general.quantity') }}</th>
                                                                            <th>{{ __('general.status') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($stockItems as $stockItem)
                                                                            <tr>
                                                                                <td>{{ $stockItem->id }}</td>
                                                                                <td>{{ $stockItem->product->name ?? '-' }}</td>
                                                                                <td>{{ $stockItem->quantity }}</td>
                                                                                <td>{{ $stockItem->status ? __('panel.status_active') : __('panel.status_inactive') }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p class="text-muted">{{ __('merchant.no_stock_items_found') }}</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_rental_shelves_found') }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_warehouses_found') }}</p>
        @endif

    </div>
</div>

<!-- الطرود -->
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ __('merchant.packages') }}</h4>
        @php
            $packages = \App\Models\Package::where('merchant_id', $merchant->id)->get();
        @endphp
        @if($packages->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('general.id') }}</th>
                            <th>{{ __('general.receiver') }}</th>
                            <th>{{ __('general.status') }}</th>
                            <th>{{ __('general.total_fee') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->receiver_first_name }} {{ $package->receiver_last_name }}</td>
                                <td>{{ $package->status }}</td>
                                <td>{{ $package->total_fee }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">{{ __('merchant.no_packages_found') }}</p>
        @endif
    </div>
</div>
@endsection

