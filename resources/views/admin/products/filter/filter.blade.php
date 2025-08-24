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
            <form action="{{ route('admin.products.index') }}" method="get">
                <div class="row">

                    <!-- Keyword Search (Product) -->
                    <div class="col-md-3 mb-2 d-md-block">
                        <div class="form-group">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="{{ __('general.search_product') }}">
                        </div>
                    </div>


                    <!-- Status -->
                    <div class="col-md-2 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="status" class="form-select select2">
                                <option value="">{{ __('filter.show_all') }}</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>{{ __('filter.status_active') }}</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>{{ __('filter.status_inactive') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-2 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="sort_by" class="form-select select2">
                                <option value="">{{ __('filter.sort_by') }}</option>
                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('filter.id') }}</option>
                                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>{{ __('filter.name') }}</option>
                                <option value="sku" {{ request('sort_by') == 'sku' ? 'selected' : '' }}>{{ __('product.sku_code') }}</option>
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('filter.created_at') }}</option>
                                <option value="published_on" {{ request('sort_by') == 'published_on' ? 'selected' : '' }}>{{ __('filter.published_on') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Order By -->
                    <div class="col-md-2 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="order_by" class="form-select select2">
                                <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('filter.asc') }}</option>
                                <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('filter.desc') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
