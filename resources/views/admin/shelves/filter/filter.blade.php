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
            <!-- زر إغلاق داخلي -->
            {{-- <div class="text-end mb-2">
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                    <i class="fas fa-times me-1"></i>{{ __('general.close') }}
                </button>
            </div> --}}

            <!-- نموذج الفلاتر -->
            <form action="{{ route('admin.shelves.index') }}" method="get">
                <div class="row">

                    <!-- Warehouse -->
                    <div class="col-md-3 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="warehouse_id" class="form-select select2" style="width: 100%;">
                                <option value="">{{ __('shelf.all_warehouses') }}</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                        {{ $warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Rental Status -->
                    <div class="col-md-2 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="rented" class="form-select">
                                <option value="">{{ __('shelf.all_rental_status') }}</option>
                                <option value="1" {{ request('rented') == '1' ? 'selected' : '' }}>{{ __('shelf.rented') }}</option>
                                <option value="0" {{ request('rented') == '0' ? 'selected' : '' }}>{{ __('shelf.not_rented') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-2 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="sort_by" class="form-select">
                                <option value="">{{ __('panel.sort_by') }}</option>
                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>{{ __('panel.id') }}</option>
                                <option value="warehouse_name" {{ request('sort_by') == 'warehouse_name' ? 'selected' : '' }}>{{ __('shelf.warehouse_name') }}</option>
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('panel.created_at') }}</option>
                                <option value="published_on" {{ request('sort_by') == 'published_on' ? 'selected' : '' }}>{{ __('panel.published_on') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-1 mb-2  d-md-block">
                        <div class="form-group">
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
                    </div>

                    <!-- Order By -->
                    <div class="col-md-1 mb-2 d-md-block">
                        <div class="form-group">
                            <select name="order_by" class="form-select">
                                <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>
                                    {{ __('panel.asc') }}
                                </option>
                                <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>
                                    {{ __('panel.desc') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.shelves.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
