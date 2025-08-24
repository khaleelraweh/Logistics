<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="filtersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.warehouses.index') }}" method="get">
                <div class="row">
                    <!-- Filter by status -->
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-select">
                            <option value="">{{ __('panel.show_all') }}</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                {{ __('panel.status_active') }}
                            </option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                {{ __('panel.status_inactive') }}
                            </option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3 mb-2">
                        <select name="sort_by" class="form-select">
                            <option value="">{{ __('panel.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('panel.id') }}</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>{{ __('warehouse.name') }}</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('panel.created_at') }}</option>
                        </select>
                    </div>

                    <!-- Order By -->
                    <div class="col-md-2 mb-2">
                        <select name="order_by" class="form-select">
                            <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('panel.asc') }}</option>
                            <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('panel.desc') }}</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-4 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.warehouses.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
