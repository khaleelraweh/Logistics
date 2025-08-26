<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#deliveriesFiltersCollapse" aria-expanded="false" aria-controls="deliveriesFiltersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="deliveriesFiltersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.deliveries.index') }}" method="get">
                <div class="row g-2">

                    <!-- Keyword -->
                    <div class="col-md-4">
                        <input type="text" name="keyword" value="{{ request()->input('keyword') }}" class="form-control" placeholder="{{ __('filter.search_here') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <select name="status" class="form-select select2">
                            <option value="">{{ __('filter.all_statuses') }}</option>
                            @foreach(['pending','assigned_to_driver','driver_picked_up','in_transit','arrived_at_hub','out_for_delivery','delivered','delivery_failed','returned','cancelled','in_warehouse'] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ __('delivery.status_' . $status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver -->
                    <div class="col-md-3">
                        <select name="driver_id" class="form-select select2">
                            <option value="">{{ __('filter.all_drivers') }}</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_full_name ?? $driver->first_name . ' ' . $driver->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Delivered From -->
                    <div class="col-md-3">
                        <input type="date" name="delivered_from" value="{{ request('delivered_from') }}" class="form-control" placeholder="{{ __('filter.delivered_from') }}">
                    </div>

                    <!-- Delivered To -->
                    <div class="col-md-3">
                        <input type="date" name="delivered_to" value="{{ request('delivered_to') }}" class="form-control" placeholder="{{ __('filter.delivered_to') }}">
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3">
                        <select name="sort_by" class="form-select select2">
                            <option value="">{{ __('filter.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('filter.id') }}</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>{{ __('delivery.status') }}</option>
                            <option value="delivered_at" {{ request('sort_by') == 'delivered_at' ? 'selected' : '' }}>{{ __('delivery.delivered_at') }}</option>
                            <option value="assigned_at" {{ request('sort_by') == 'assigned_at' ? 'selected' : '' }}>{{ __('delivery.assigned_at') }}</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('filter.created_at') }}</option>
                        </select>
                    </div>

                    <!-- Order By -->
                    <div class="col-md-3">
                        <select name="order_by" class="form-select select2">
                            <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('filter.asc') }}</option>
                            <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('filter.desc') }}</option>
                        </select>
                    </div>

                    <!-- Limit By -->
                    <div class="col-md-3">
                        <select name="limit_by" class="form-select select2">
                            <option value="10" {{ request('limit_by') == '10' ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('limit_by') == '20' ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('limit_by') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('limit_by') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-12 d-flex align-items-end mt-3">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.deliveries.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
