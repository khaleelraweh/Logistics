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
            <form action="{{ route('admin.stock_items.index') }}" method="get">
                <div class="row">

                    <!-- Keyword -->
                    <div class="col-md-3 mb-2">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                               placeholder="{{ __('general.search') }}">
                    </div>

                    <!-- Filter by Merchant -->
                    <div class="col-md-3 mb-2">
                        <select name="merchant_id" class="form-select">
                            <option value="">{{ __('merchant.select_merchant') }}</option>
                            @foreach(\App\Models\Merchant::pluck('name','id') as $id => $name)
                                <option value="{{ $id }}" {{ request('merchant_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Product -->
                    <div class="col-md-3 mb-2">
                        <select name="product_id" class="form-select">
                            <option value="">{{ __('product.select_product') }}</option>
                            @foreach(\App\Models\Product::pluck('name','id') as $id => $name)
                                <option value="{{ $id }}" {{ request('product_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Warehouse -->
                    <div class="col-md-3 mb-2">
                        <select name="warehouse_id" class="form-select">
                            <option value="">{{ __('warehouse.select_warehouse') }}</option>
                            @foreach(\App\Models\Warehouse::pluck('name','id') as $id => $name)
                                <option value="{{ $id }}" {{ request('warehouse_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by status -->
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-select">
                            <option value="">{{ __('panel.show_all') }}</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('panel.status_active') }}</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>{{ __('panel.status_inactive') }}</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3 mb-2">
                        <select name="sort_by" class="form-select">
                            <option value="">{{ __('panel.sort_by') }}</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('panel.id') }}</option>
                            <option value="quantity" {{ request('sort_by') == 'quantity' ? 'selected' : '' }}>{{ __('stock-item.quantity') }}</option>
                            <option value="published_on" {{ request('sort_by') == 'published_on' ? 'selected' : '' }}>{{ __('stock-item.published_on') }}</option>
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

                    <!-- Limit By -->
                    <div class="col-md-2 mb-2">
                        <select name="limit_by" class="form-select">
                            <option value="100" {{ request('limit_by') == '100' ? 'selected' : '' }}>100</option>
                            <option value="200" {{ request('limit_by') == '200' ? 'selected' : '' }}>200</option>
                            <option value="500" {{ request('limit_by') == '500' ? 'selected' : '' }}>500</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-4 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.stock_items.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
