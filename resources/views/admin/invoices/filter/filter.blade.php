<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#invoicesFiltersCollapse" aria-expanded="false" aria-controls="invoicesFiltersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="invoicesFiltersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.invoices.index') }}" method="get">
                <div class="row g-2">

                    <!-- Keyword -->
                    <div class="col-md-6">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="{{ __('filter.search_here') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <select name="status" class="form-select select2">
                            <option value="">{{ __('filter.all_statuses') }}</option>
                            @foreach(['unpaid','partial','paid'] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ __('invoice.status_' . $status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Merchant -->
                    <div class="col-md-3">
                        <select name="merchant_id" class="form-select select2">
                            <option value="">{{ __('filter.all_merchants') }}</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" {{ request('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Classification (Polymorphic) -->
                    <div class="col-md-3">
                        <select name="payable_type" class="form-select select2">
                            <option value="">{{ __('filter.all_types') }}</option>
                            <option value="App\Models\Package" {{ request('payable_type') == 'App\Models\Package' ? 'selected' : '' }}>
                                {{ __('package.package') }}
                            </option>
                            <option value="App\Models\WarehouseRental" {{ request('payable_type') == 'App\Models\WarehouseRental' ? 'selected' : '' }}>
                                {{ __('warehouse_rental.warehouse_rental') }}
                            </option>
                        </select>
                    </div>


                    <!-- Issued From / To -->
                    <div class="col-md-1 d-flex align-items-center justify-content-center">{{ __('general.from') }}</div>
                    <div class="col-md-2">
                        <input type="date" name="issued_from" value="{{ request('issued_from') }}" class="form-control">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">{{ __('general.to') }}</div>
                    <div class="col-md-2">
                        <input type="date" name="issued_to" value="{{ request('issued_to') }}" class="form-control">
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-2">
                        <select name="sort_by" class="form-select select2">
                            <option value="">{{ __('filter.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('filter.id') }}</option>
                            <option value="invoice_number" {{ request('sort_by') == 'invoice_number' ? 'selected' : '' }}>{{ __('invoice.invoice_number') }}</option>
                            <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>{{ __('invoice.total_amount') }}</option>
                            <option value="paid_amount" {{ request('sort_by') == 'paid_amount' ? 'selected' : '' }}>{{ __('invoice.paid_amount') }}</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>{{ __('invoice.status') }}</option>
                            <option value="issued_at" {{ request('sort_by') == 'issued_at' ? 'selected' : '' }}>{{ __('invoice.issued_at') }}</option>
                        </select>
                    </div>

                    <!-- Order By -->
                    <div class="col-md-2">
                        <select name="order_by" class="form-select select2">
                            <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('filter.asc') }}</option>
                            <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('filter.desc') }}</option>
                        </select>
                    </div>

                    <!-- Limit By -->
                    <div class="col-md-2">
                        <select name="limit_by" class="form-select select2">
                            @foreach([10,20,50,100] as $limit)
                                <option value="{{ $limit }}" {{ request('limit_by') == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-12 d-flex align-items-end mt-3">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
