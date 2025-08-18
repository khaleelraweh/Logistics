<div class="card-body">
    <form action="{{ route('admin.shelves.index') }}" method="get">
        <div class="row">
            <!-- Keyword -->
            <div class="col-8 col-sm-4 col-md-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"
                        class="form-control" placeholder="{{ __('panel.keyword') }}">
                </div>
            </div>

            <!-- Status -->
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">{{ __('panel.show_all') }}</option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.status_active') }}
                        </option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.status_inactive') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Warehouse -->
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="warehouse_id" class="form-control select2">
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
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="rented" class="form-control">
                        <option value="">{{ __('shelf.all_rental_status') }}</option>
                        <option value="1" {{ request('rented') == '1' ? 'selected' : '' }}>{{ __('shelf.rented') }}</option>
                        <option value="0" {{ request('rented') == '0' ? 'selected' : '' }}>{{ __('shelf.not_rented') }}</option>
                    </select>
                </div>
            </div>

            <!-- Sort By -->
            <div class="d-none d-sm-block col-sm-4 col-md-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">{{ __('panel.sort_by') }}</option>
                        <option value="id" {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>
                            {{ __('panel.id') }}
                        </option>
                        <option value="name" {{ old('sort_by', request()->input('sort_by')) == 'name' ? 'selected' : '' }}>
                            {{ __('panel.title') }}
                        </option>
                        <option value="created_at" {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>
                            {{ __('panel.created_at') }}
                        </option>
                        <option value="published_on" {{ old('sort_by', request()->input('sort_by')) == 'published_on' ? 'selected' : '' }}>
                            {{ __('panel.published_on') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Order By -->
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                            {{ __('panel.asc') }}
                        </option>
                        <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                            {{ __('panel.desc') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Limit -->
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <!-- Buttons -->
            <div class="col-2 col-sm-2 col-md-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">{{ __('panel.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
