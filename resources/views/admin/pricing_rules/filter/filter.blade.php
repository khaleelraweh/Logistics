<div class="card mb-4">
    <!-- Header مع زر الإظهار/الإخفاء -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- جسم الفلتر القابل للطي -->
    <div id="filtersCollapse" class="collapse">
        <div class="card-body">

            <!-- نموذج الفلاتر -->
            <form action="{{ route('admin.pricing_rules.index') }}" method="get">
                <div class="row g-2">

                    <!-- Search -->
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('filter.search_name_zone') }}" value="{{ request('search') }}">
                    </div>

                    <!-- Type -->
                    <div class="col-md-2">
                        <select name="type" class="form-select">
                            <option value="">{{ __('filter.all_types') }}</option>
                            <option value="delivery" {{ request('type') == 'delivery' ? 'selected' : '' }}>{{ __('pricing_rules.delivery') }}</option>
                            <option value="storage" {{ request('type') == 'storage' ? 'selected' : '' }}>{{ __('pricing_rules.storage') }}</option>
                            <option value="handling" {{ request('type') == 'handling' ? 'selected' : '' }}>{{ __('pricing_rules.handling') }}</option>
                        </select>
                    </div>

                    <!-- Zone -->
                    <div class="col-md-2">
                        <input type="text" name="zone" class="form-control" placeholder="{{ __('filter.zone') }}" value="{{ request('zone') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">{{ __('filter.all_status') }}</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>{{ __('filter.status_active') }}</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>{{ __('filter.status_inactive') }}</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-1">
                        <select name="sort_by" class="form-select">
                            <option value="created_at">{{ __('filter.price_type') }}</option>
                            <option value="base_price" {{ request('sort_by') == 'base_price' ? 'selected' : '' }}>{{ __('pricing_rules.base_price') }}</option>
                            <option value="price_per_kg" {{ request('sort_by') == 'price_per_kg' ? 'selected' : '' }}>{{ __('pricing_rules.price_per_kg') }}</option>
                        </select>
                    </div>

                    <!-- Order By -->
                    <div class="col-md-1">
                        <select name="order_by" class="form-select">
                            <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('filter.asc') }}</option>
                            <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('filter.desc') }}</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2 d-flex">
                        <button type="submit" class="btn btn-primary me-1 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.pricing_rules.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
