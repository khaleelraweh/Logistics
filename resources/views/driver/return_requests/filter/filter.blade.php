<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#returnRequestsFiltersCollapse" aria-expanded="false" aria-controls="returnRequestsFiltersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="returnRequestsFiltersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('driver.return_requests.index') }}" method="get">
                <div class="row g-2">

                    <!-- Keyword -->
                    <div class="col-md-4">
                        <input type="text" name="keyword" value="{{ request()->keyword }}" class="form-control" placeholder="{{ __('filter.search_here') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-2">
                        <select name="status" class="form-select select2">
                            <option value="">{{ __('filter.all_statuses') }}</option>
                            @foreach(['requested','in_transit','received','rejected','partially_received','status_cancelled'] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ __('return_request.status_' . $status) }}
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
                                    {{ $driver->first_name . ' ' . $driver->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Package -->
                    <div class="col-md-3">
                        <select name="package_id" class="form-select select2">
                            <option value="">{{ __('filter.all_packages') }}</option>
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}" {{ request('package_id') == $package->id ? 'selected' : '' }}>
                                    #{{ $package->id }} - {{ optional($package->merchant)->name ?? '---' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-2">
                        <select name="sort_by" class="form-select select2">
                            <option value="">{{ __('filter.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('filter.id') }}</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>{{ __('return_request.status') }}</option>
                            <option value="requested_at" {{ request('sort_by') == 'requested_at' ? 'selected' : '' }}>{{ __('return_request.requested_at') }}</option>
                            <option value="received_at" {{ request('sort_by') == 'received_at' ? 'selected' : '' }}>{{ __('return_request.received_at') }}</option>
                            <option value="published_on" {{ request('sort_by') == 'published_on' ? 'selected' : '' }}>{{ __('filter.published_on') }}</option>
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
                        <a href="{{ route('driver.return_requests.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
