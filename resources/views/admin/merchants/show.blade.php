@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bi bi-shop-window fs-3 me-2 text-primary"></i>
                <h4 class="mb-0">{{ __('merchant.merchant_details') }}</h4>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.merchants.edit', $merchant->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-pencil-square me-1"></i> {{ __('general.edit') }}
                </a>
                <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- البطاقة الرئيسية -->
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="card-header bg-transparent border-0 py-3">
        <div class="d-flex align-items-center">
            <div class="position-relative me-4">
                @if($merchant->logo)
                    <img src="{{ asset('assets/merchants/' . $merchant->logo) }}"
                         alt="{{ __('merchant.logo') }}"
                         class="rounded-3 shadow-sm"
                         style="width: 100px; height: 100px; object-fit: cover;">
                    <button class="btn btn-sm btn-primary position-absolute top-0 end-0 translate-middle rounded-circle p-0"
                            style="width: 28px; height: 28px;"
                            data-bs-toggle="modal" data-bs-target="#logoModal">
                        <i class="bi bi-zoom-in fs-6"></i>
                    </button>
                @else
                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center shadow-sm"
                         style="width: 100px; height: 100px;">
                        <i class="bi bi-shop text-muted fs-1"></i>
                    </div>
                @endif
            </div>

            <div class="flex-grow-1">
                <div class="d-flex align-items-center flex-wrap gap-3 mb-2">
                    <h3 class="mb-0 text-dark">{{ $merchant->getTranslation('name', app()->getLocale()) }}</h3>
                    <span class="badge rounded-pill bg-{{ $merchant->status ? 'success' : 'danger' }} bg-opacity-10 text-{{ $merchant->status ? 'success' : 'danger' }}">
                        {{ $merchant->status ? __('panel.status_active') : __('panel.status_inactive') }}
                    </span>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if($merchant->contact_person)
                        <span class="badge bg-light text-dark rounded-pill">
                            <i class="bi bi-person-fill me-1"></i>
                            {{ $merchant->getTranslation('contact_person', app()->getLocale()) }}
                        </span>
                    @endif

                    @if($merchant->email)
                        <a href="mailto:{{ $merchant->email }}" class="badge bg-light text-primary rounded-pill text-decoration-none">
                            <i class="bi bi-envelope-fill me-1"></i>
                            {{ $merchant->email }}
                        </a>
                    @endif

                    @if($merchant->phone)
                        <a href="tel:{{ $merchant->phone }}" class="badge bg-light text-success rounded-pill text-decoration-none">
                            <i class="bi bi-telephone-fill me-1"></i>
                            {{ $merchant->phone }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="row">
            <div class="col-xl-12">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#overview" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">{{ __('merchant.overview') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">{{ __('merchant.warehouses') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">{{ __('merchant.products') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">{{ __('merchant.packages') }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        <div class="row g-4">
                            <!-- المعلومات الأساسية -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="bi bi-info-square me-2 text-primary"></i>
                                            {{ __('merchant.basic_info') }}
                                        </h5>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                        <i class="bi bi-geo-alt text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">{{ __('general.address') }}</small>
                                                        <span class="fw-semibold">{{ $merchant->address }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                        <i class="bi bi-key text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">{{ __('merchant.api_key') }}</small>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-semibold text-truncate" style="max-width: 150px;" id="apiKey">{{ $merchant->api_key }}</span>
                                                            <button class="btn btn-link p-0 ms-2" onclick="copyToClipboard('apiKey')" data-bs-toggle="tooltip" title="{{ __('general.copy') }}">
                                                                <i class="bi bi-copy"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                        <i class="bi bi-calendar text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">{{ __('general.created_at') }}</small>
                                                        <span class="fw-semibold">{{ $merchant->created_at->format('Y-m-d') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                        <i class="bi bi-arrow-repeat text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">{{ __('general.updated_at') }}</small>
                                                        <span class="fw-semibold">{{ $merchant->updated_at->format('Y-m-d') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- الإحصائيات -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="bi bi-graph-up me-2 text-primary"></i>
                                            {{ __('merchant.stats') }}
                                        </h5>

                                        <div class="row g-3">
                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-primary mb-1">
                                                        <i class="bi bi-cart fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->warehouses->count() ,2) }}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_warehouses') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-success mb-1">
                                                        <i class="bi bi-currency-dollar fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->rentalShelves->count(), 2) }}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_shelves') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-info mb-1">
                                                        <i class="bi bi-box-seam fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->products->count() , 2 )}}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_products') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-warning mb-1">
                                                        <i class="bi bi-star-fill fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->stockitems->count(), 2) }}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_stock_items') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-info mb-1">
                                                        <i class="bi bi-box-seam fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->packages->count() , 2 )}}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_packages') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="text-warning mb-1">
                                                        <i class="bi bi-star-fill fs-4"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-bold">{{ number_format($merchant->returnRequests->count(), 2) }}</h5>
                                                    <small class="text-muted">{{ __('merchant.total_return_requests') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">
                                                <i class="bi bi-share me-2 text-primary"></i>
                                                {{ __('general.social_links') }}
                                            </h5>

                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($socials as $social => $data)
                                                    @if($merchant->$social)
                                                        <a href="{{ $merchant->$social }}"
                                                        target="_blank"
                                                        class="btn btn-outline-{{ $data['color'] }} rounded-pill px-3"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ ucfirst($social) }}">
                                                            <i class="{{ $data['icon'] }} me-1"></i>
                                                            {{ ucfirst($social) }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="tab-pane" id="profile1" role="tabpanel">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">{{ __('rental.warehouse_rentals') }} ({{ $merchant->warehouseRentals->count() }})</h4>

                                @if($merchant->warehouseRentals->isNotEmpty())
                                    <div class="accordion" id="warehouseRentalsAccordion">

                                        @foreach($merchant->warehouseRentals as $rental)

                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header" id="headingRental{{ $rental->id }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRental{{ $rental->id }}" aria-expanded="false" aria-controls="collapseRental{{ $rental->id }}">
                                                        {{ __('general.id') }}: {{ $rental->id }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.rental_start') }}: {{ $rental->rental_start }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.rental_end') }}: {{ $rental->rental_end }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.price') }}: {{ number_format($rental->price, 2) }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {!! $rental->status_label !!}
                                                    </button>
                                                </h2>
                                                <div id="collapseRental{{ $rental->id }}" class="accordion-collapse collapse" aria-labelledby="headingRental{{ $rental->id }}" data-bs-parent="#warehouseRentalsAccordion">
                                                    <div class="accordion-body">

                                                        @php
                                                            // جلب المستودعات مباشرة من الرفوف المرتبطة بالعقد
                                                            $warehouses = $rental->shelves->pluck('warehouse')->unique('id');
                                                        @endphp

                                                        @if($warehouses->isNotEmpty())
                                                            <ul class="list-group">
                                                                @foreach($warehouses as $warehouse)
                                                                    <li class="list-group-item">
                                                                        <strong>{{ $warehouse?->getTranslation('name', app()->getLocale()) ?? __('warehouse.unknown_warehouse') }}</strong>

                                                                        @php
                                                                            // الرفوف الخاصة بهذا العقد وهذا المستودع
                                                                            $rentedShelves = $rental->shelves->filter(function($shelf) use ($warehouse) {
                                                                                return $shelf->warehouse_id == $warehouse->id;
                                                                            });
                                                                        @endphp

                                                                        @if($rentedShelves->isNotEmpty())
                                                                            <ul class="list-group mt-2">
                                                                                @foreach($rentedShelves as $shelf)
                                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                        {{ $shelf->code ?? __('warehouse.unknown_shelf') }}
                                                                                        <span class="badge bg-primary rounded-pill">
                                                                                            {{ __('rental.custom_price') }}: {{ number_format($shelf->pivot->custom_price, 2) }}
                                                                                        </span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <p class="text-muted mt-2">{{ __('merchant.no_rental_shelves_found_in_warehouse') }}</p>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-muted">{{ __('merchant.no_warehouses_found_for_rental') }}</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_warehouse_rentals_found') }}</p>
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="tab-pane" id="profile1" role="tabpanel">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ __('rental.warehouse_rentals') }} ({{ $merchant->warehouseRentals->count() }})
                                </h4>

                                @if($merchant->warehouseRentals->isNotEmpty())
                                    <div class="accordion" id="warehouseRentalsAccordion">

                                        @foreach($merchant->warehouseRentals as $rental)
                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header" id="headingRental{{ $rental->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseRental{{ $rental->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseRental{{ $rental->id }}">

                                                        {{ __('general.id') }}: {{ $rental->id }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.rental_start') }}: {{ $rental->rental_start }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.rental_end') }}: {{ $rental->rental_end }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {{ __('rental.price') }}: {{ number_format($rental->price, 2) }}
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        {!! $rental->status_label !!}
                                                    </button>
                                                </h2>

                                                <div id="collapseRental{{ $rental->id }}" class="accordion-collapse collapse"
                                                    aria-labelledby="headingRental{{ $rental->id }}"
                                                    data-bs-parent="#warehouseRentalsAccordion">
                                                    <div class="accordion-body">

                                                        <!-- المبالغ -->
                                                        <p><strong>💰 {{ __('invoice.total_amount') }}:</strong> {{ number_format($rental->invoice?->total_amount ?? $rental->price, 2) }}</p>
                                                        <p><strong>✅ {{ __('invoice.paid_amount') }}:</strong> {{ number_format($rental->paid_amount, 2) }}</p>
                                                        <p><strong>⚠️ {{ __('invoice.remaining_amount') }}:</strong> {{ number_format($rental->remaining_amount, 2) }}</p>

                                                        <!-- الإجراءات -->
                                                        <div class="mt-3">
                                                            @if($rental->invoice)
                                                                <a href="{{ route('admin.invoices.show', $rental->invoice->id) }}"
                                                                class="btn btn-sm btn-info">
                                                                    📄 {{ __('invoice.open_invoice') }}
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin.invoices.create', ['payable_type' => 'WarehouseRental', 'payable_id' => $rental->id]) }}"
                                                                class="btn btn-sm btn-success">
                                                                    ➕ {{ __('invoice.create_invoice') }}
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('admin.warehouse_rentals.edit', $rental->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                                ✏️ {{ __('rental.edit_contract') }}
                                                            </a>

                                                            @if($rental->invoice)
                                                                <a href="{{ route('admin.invoices.show', $rental->invoice->id) }}#payments"
                                                                class="btn btn-sm btn-primary">
                                                                    💵 {{ __('payment.add_payment') }}
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <!-- المستودعات المرتبطة -->
                                                        @php
                                                            $warehouses = $rental->shelves->pluck('warehouse')->unique('id');
                                                        @endphp

                                                        @if($warehouses->isNotEmpty())
                                                            <ul class="list-group mt-3">
                                                                @foreach($warehouses as $warehouse)
                                                                    <li class="list-group-item">
                                                                        <strong>{{ $warehouse?->getTranslation('name', app()->getLocale()) ?? __('warehouse.unknown_warehouse') }}</strong>
                                                                        @php
                                                                            $rentedShelves = $rental->shelves->where('warehouse_id', $warehouse->id);
                                                                        @endphp

                                                                        @if($rentedShelves->isNotEmpty())
                                                                            <ul class="list-group mt-2">
                                                                                @foreach($rentedShelves as $shelf)
                                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                        {{ $shelf->code ?? __('warehouse.unknown_shelf') }}
                                                                                        <span class="badge bg-primary rounded-pill">
                                                                                            {{ __('rental.custom_price') }}: {{ number_format($shelf->pivot->custom_price, 2) }}
                                                                                        </span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_warehouse_rentals_found') }}</p>
                                @endif
                            </div>
                        </div>
                    </div> --}}


                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ __('rental.warehouse_rentals') }} ({{ $merchant->warehouseRentals->count() }})
                                </h4>

                                @if($merchant->warehouseRentals->isNotEmpty())
                                    <div class="accordion" id="warehouseRentalsAccordion">

                                        @foreach($merchant->warehouseRentals as $rental)
                                            @php
                                                // الفاتورة المرتبطة (إن وجدت)
                                                $invoice = $rental->invoice;
                                                $paid = $invoice ? $invoice->payments->sum('amount') : 0;
                                                $remaining = $invoice ? max(0, $invoice->total_amount - $paid) : $rental->price;
                                            @endphp

                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header" id="headingRental{{ $rental->id }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseRental{{ $rental->id }}" aria-expanded="false"
                                                            aria-controls="collapseRental{{ $rental->id }}">
                                                        {{ __('general.id') }}: {{ $rental->id }}
                                                        &nbsp; | &nbsp;
                                                        {{ __('rental.rental_start') }}: {{ $rental->rental_start }}
                                                        &nbsp; | &nbsp;
                                                        {{ __('rental.rental_end') }}: {{ $rental->rental_end }}
                                                        &nbsp; | &nbsp;
                                                        {{ __('rental.price') }}: {{ number_format($rental->price, 2) }}
                                                        &nbsp; | &nbsp;
                                                        {!! $rental->status_label !!}
                                                    </button>
                                                </h2>
                                                <div id="collapseRental{{ $rental->id }}" class="accordion-collapse collapse"
                                                    aria-labelledby="headingRental{{ $rental->id }}"
                                                    data-bs-parent="#warehouseRentalsAccordion">
                                                    <div class="accordion-body">

                                                        <!-- المبالغ -->
                                                        <div class="mb-3">
                                                            <p><strong>{{ __('invoice.total') }}:</strong> {{ number_format($invoice->total_amount ?? $rental->price, 2) }}</p>
                                                            <p class="text-success"><strong>{{ __('invoice.paid') }}:</strong> {{ number_format($paid, 2) }}</p>
                                                            <p class="text-danger"><strong>{{ __('invoice.remaining') }}:</strong> {{ number_format($remaining, 2) }}</p>
                                                        </div>

                                                        <!-- روابط التحكم -->
                                                        <div class="d-flex gap-2 mb-3">
                                                            @if($invoice)
                                                                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                                                    {{ __('invoice.open_invoice') }}
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('admin.warehouse_rentals.edit', $rental->id) }}" class="btn btn-sm btn-outline-secondary">
                                                                {{ __('rental.edit_contract') }}
                                                            </a>

                                                            @if($invoice)
                                                                <a href="{{ route('admin.invoices.pay.create', $invoice->id) }}" class="btn btn-sm btn-outline-success">
                                                                    {{ __('invoice.add_payment') }}
                                                                </a>

                                                                <a href="{{ route('admin.invoices.show', $rental->invoice->id) }}#payments"
                                                                class="btn btn-sm btn-primary">
                                                                    💵 {{ __('payment.add_payment') }}
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <!-- المستودعات والرفوف -->
                                                        @php
                                                            $warehouses = $rental->shelves->pluck('warehouse')->unique('id');
                                                        @endphp

                                                        @if($warehouses->isNotEmpty())
                                                            <ul class="list-group">
                                                                @foreach($warehouses as $warehouse)
                                                                    <li class="list-group-item">
                                                                        <strong>{{ $warehouse?->getTranslation('name', app()->getLocale()) ?? __('warehouse.unknown_warehouse') }}</strong>
                                                                        @php
                                                                            $rentedShelves = $rental->shelves->where('warehouse_id', $warehouse->id);
                                                                        @endphp
                                                                        @if($rentedShelves->isNotEmpty())
                                                                            <ul class="list-group mt-2">
                                                                                @foreach($rentedShelves as $shelf)
                                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                        {{ $shelf->code ?? __('warehouse.unknown_shelf') }}
                                                                                        <span class="badge bg-primary rounded-pill">
                                                                                            {{ __('rental.custom_price') }}: {{ number_format($shelf->pivot->custom_price, 2) }}
                                                                                        </span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <p class="text-muted mt-2">{{ __('merchant.no_rental_shelves_found_in_warehouse') }}</p>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-muted">{{ __('merchant.no_warehouses_found_for_rental') }}</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_warehouse_rentals_found') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>



                    <!-- تبويب المنتجات والمخزونات -->
                    <div class="tab-pane fade" id="messages1" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ __('merchant.products') }} ({{ $merchant->products->count() }})</h4>

                                @if($merchant->products->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>{{ __('general.image') }}</th>
                                                    <th>{{ __('general.name') }}</th>
                                                    <th>{{ __('general.price') }}</th>
                                                    <th>{{ __('general.quantity') }}</th>
                                                    <th>{{ __('general.status') }}</th>
                                                    <th>{{ __('general.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($merchant->products as $product)
                                                    <tr>
                                                        <td>
                                                            @if($product->image)
                                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                                    alt="{{ $product->name }}"
                                                                    class="rounded"
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                    style="width: 50px; height: 50px;">
                                                                    <i class="bi bi-image text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ number_format($product->price, 2) }} {{ __('general.currency') }}</td>
                                                        <td>
                                                            <span class="badge bg-light text-dark">{{ $product->quantity }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $product->status ? 'success' : 'secondary' }}">
                                                                {{ $product->status ? __('panel.status_active') : __('panel.status_inactive') }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                                <i class="bi bi-eye me-1"></i> {{ __('general.view') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-box-seam fs-1 text-muted"></i>
                                        <p class="text-muted mt-3">{{ __('merchant.no_products_found') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- المنتجات المخزنة في المستودعات والرفوف -->
                        <div class="card mt-3 border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ __('merchant.stock_items') }} ({{ $merchant->stockItems->count() }})</h4>

                                @php
                                    // استخرج الرفوف المستأجرة للتاجر التي مرتبطة بمستودع ولها مخزونات
                                    $rentalShelves = $merchant->rentalShelves->filter(function($rentalShelf) {
                                        return optional($rentalShelf->shelf)->warehouse && $rentalShelf->stockItems->isNotEmpty();
                                    });
                                @endphp

                                @if($rentalShelves->isNotEmpty())
                                    <div class="accordion" id="warehouseAccordion">
                                        @foreach($rentalShelves->groupBy(fn($r) => $r->shelf->warehouse->id) as $warehouseId => $shelvesInWarehouse)
                                            @php
                                                $warehouse = optional($shelvesInWarehouse->first()->shelf)->warehouse;
                                            @endphp

                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header" id="headingWarehouse{{ $warehouseId }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseWarehouse{{ $warehouseId }}" aria-expanded="false">
                                                        🏬 {{ $warehouse?->getTranslation('name', app()->getLocale()) ?? __('warehouse.unknown_warehouse') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseWarehouse{{ $warehouseId }}" class="accordion-collapse collapse"
                                                    aria-labelledby="headingWarehouse{{ $warehouseId }}" data-bs-parent="#warehouseAccordion">
                                                    <div class="accordion-body">

                                                        <div class="accordion" id="shelfAccordion{{ $warehouseId }}">
                                                            @foreach($shelvesInWarehouse as $index => $rentalShelf)
                                                                @php
                                                                    $shelf = $rentalShelf->shelf;
                                                                    $stockItems = $rentalShelf->stockItems;
                                                                @endphp

                                                                <div class="accordion-item mb-1">
                                                                    <h2 class="accordion-header" id="headingShelf{{ $rentalShelf->id }}">
                                                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#collapseShelf{{ $rentalShelf->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                                                            🗄️ {{ $shelf?->code ?? __('warehouse.unknown_shelf') }}
                                                                            | {{ __('rental.custom_price') }}: {{ $rentalShelf->custom_price ?? '-' }}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapseShelf{{ $rentalShelf->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                                        aria-labelledby="headingShelf{{ $rentalShelf->id }}" data-bs-parent="#shelfAccordion{{ $warehouseId }}">
                                                                        <div class="accordion-body">

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
                                                                                                <td>
                                                                                                    <span class="badge bg-{{ $stockItem->status ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $stockItem->status ? 'success' : 'secondary' }}">
                                                                                                        {{ $stockItem->status ? __('panel.status_active') : __('panel.status_inactive') }}
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-archive fs-1 text-muted"></i>
                                        <p class="text-muted mt-3">{{ __('merchant.no_stock_items_found') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="settings1" role="tabpanel">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">{{ __('merchant.packages') }}</h4>
                                @php
                                    $packages = \App\Models\Package::where('merchant_id', $merchant->id)->get();
                                    $packageIds = $packages->pluck('id');
                                    $returnRequests = \App\Models\ReturnRequest::whereIn('package_id', $packageIds)->get();
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
                                                        <td>{{ $package->statusLabel() }}</td>
                                                        <td>{{ $package->total_fee }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_packages_found') }}</p>
                                @endif

                                <h4 class="card-title mt-4">{{ __('merchant.return_requests') }}</h4>

                                @if($returnRequests->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('general.id') }}</th>
                                                    <th>{{ __('return_request.package') }}</th>
                                                    <th>{{ __('general.status') }}</th>
                                                    <th>{{ __('general.return_type') }}</th>
                                                    <th>{{ __('general.reason') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($returnRequests as $request)
                                                    <tr>
                                                        <td>{{ $request->id }}</td>
                                                        <td>
                                                            {{ $request->package->tracking_number }} -
                                                            <small>{{ $request->package->receiver_first_name ?? '' }} {{ $request->package->receiver_last_name ?? '' }}</small>

                                                        </td>
                                                        <td>
                                                            @switch($request->status)
                                                                @case('requested')
                                                                    <span class="badge bg-success">{{ __('return_request.status_requested') }}</span>
                                                                    @break

                                                                @case('cancelled')
                                                                    <span class="badge bg-danger">{{ __('return_request.status_cancelled') }}</span>
                                                                    @break

                                                                @case('in_transit')
                                                                    <span class="badge bg-warning">{{ __('return_request.status_in_transit') }}</span>
                                                                    @break

                                                                @case('rejected')
                                                                    <span class="badge bg-danger">{{ __('return_request.status_rejected') }}</span>
                                                                    @break

                                                                @case('received')
                                                                    <span class="badge bg-primary">{{ __('return_request.status_received') }}</span>
                                                                    @break

                                                                @case('partially_received')
                                                                    <span class="badge bg-info">{{ __('return_request.status_partially_received') }}</span>
                                                                    @break

                                                                @default
                                                                    <span class="badge bg-secondary">{{ __('return_request.status_unknown') }}</span>
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            {{ __('return_request.type_'. $request->return_type) }}
                                                        </td>
                                                        <td>{{ $request->reason ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">{{ __('merchant.no_return_requests_found') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>


            </div>

        </div>
    </div>


</div>

<!-- مودال عرض الشعار -->
<div class="modal fade" id="logoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg me-1"></i>
                    {{ __('general.close') }}
                </button>
                <a href="{{ asset('assets/merchants/' . $merchant->logo) }}"
                   download
                   class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-download me-1"></i>
                    {{ __('general.download') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function copyToClipboard(elementId) {
        const element = document.getElementById(elementId);
        const text = element.innerText;

        navigator.clipboard.writeText(text).then(() => {
            const tooltip = new bootstrap.Tooltip(element.nextElementSibling, {
                title: '{{ __("general.copied") }}',
                trigger: 'manual'
            });
            tooltip.show();

            setTimeout(() => {
                tooltip.hide();
            }, 2000);
        });
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
