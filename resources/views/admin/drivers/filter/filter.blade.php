<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#driversFiltersCollapse" aria-expanded="false" aria-controls="driversFiltersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="driversFiltersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.drivers.index') }}" method="get">
                <div class="row g-2">

                    <!-- Keyword -->
                    <div class="col-md-6">
                        <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}" class="form-control" placeholder="{{ __('filter.search_here') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <select name="status" class="form-select select2">
                            <option value="">{{ __('filter.all_statuses') }}</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('driver.status_active') }}</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('driver.status_inactive') }}</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>{{ __('driver.status_suspended') }}</option>
                            <option value="terminated" {{ request('status') == 'terminated' ? 'selected' : '' }}>{{ __('driver.status_terminated') }}</option>
                        </select>
                    </div>

                    <!-- Availability Status -->
                    <div class="col-md-3">
                        <select name="availability_status" class="form-select select2">
                            <option value="">{{ __('filter.all_availability_statuses') }}</option>
                            <option value="available" {{ request('availability_status') == 'available' ? 'selected' : '' }}>{{ __('driver.available') }}</option>
                            <option value="busy" {{ request('availability_status') == 'busy' ? 'selected' : '' }}>{{ __('driver.busy') }}</option>
                            <option value="offline" {{ request('availability_status') == 'offline' ? 'selected' : '' }}>{{ __('driver.offline') }}</option>
                        </select>
                    </div>

                    <!-- Vehicle Type -->
                    <div class="col-md-3">
                        <select name="vehicle_type" class="form-select select2">
                            <option value="">{{ __('filter.all_vehicle_types') }}</option>
                            <option value="car" {{ request('vehicle_type') == 'car' ? 'selected' : '' }}>{{ __('driver.vehicle_type_car') }}</option>
                            <option value="van" {{ request('vehicle_type') == 'van' ? 'selected' : '' }}>{{ __('driver.vehicle_type_van') }}</option>
                            <option value="small_truck" {{ request('vehicle_type') == 'small_truck' ? 'selected' : '' }}>{{ __('driver.vehicle_type_small_truck') }}</option>
                            <option value="big_truck" {{ request('vehicle_type') == 'big_truck' ? 'selected' : '' }}>{{ __('driver.vehicle_type_big_truck') }}</option>
                            <option value="motorcycle" {{ request('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>{{ __('driver.vehicle_type_motorcycle') }}</option>
                            <option value="other" {{ request('vehicle_type') == 'other' ? 'selected' : '' }}>{{ __('general.other') }}</option>
                        </select>
                    </div>

                    <!-- Supervisor -->
                    <div class="col-md-3">
                        <select name="supervisor_id" class="form-select select2">
                            <option value="">{{ __('filter.all_supervisors') }}</option>
                            @foreach ($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}" {{ request('supervisor_id') == $supervisor->id ? 'selected' : '' }}>
                                    {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City -->
                    <div class="col-md-3">
                        <input type="text" name="city" value="{{ request('city') }}" class="form-control" placeholder="{{ __('filter.city') }}">
                    </div>

                    <!-- Region -->
                    <div class="col-md-3">
                        <input type="text" name="region" value="{{ request('region') }}" class="form-control" placeholder="{{ __('filter.region') }}">
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3">
                        <select name="sort_by" class="form-select select2">
                            <option value="">{{ __('filter.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('filter.id') }}</option>
                            <option value="first_name" {{ request('sort_by') == 'first_name' ? 'selected' : '' }}>{{ __('filter.name') }}</option>
                            <option value="mobile" {{ request('sort_by') == 'mobile' ? 'selected' : '' }}>{{ __('filter.phone') }}</option>
                            <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>{{ __('filter.email') }}</option>
                            <option value="total_deliveries" {{ request('sort_by') == 'total_deliveries' ? 'selected' : '' }}>{{ __('filter.total_deliveries') }}</option>
                            <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>{{ __('filter.rating') }}</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('filter.created_at') }}</option>
                            <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>{{ __('filter.updated_at') }}</option>
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
                        <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
