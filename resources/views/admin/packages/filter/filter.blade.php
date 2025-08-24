<div class="card mb-4">
    <!-- Header -->
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#packagesFiltersCollapse" aria-expanded="false" aria-controls="packagesFiltersCollapse">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <!-- Filter Body -->
    <div id="packagesFiltersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.packages.index') }}" method="get">
                <div class="row g-2">
                    <!-- Keyword -->
                    <div class="col-md-2">
                        <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}" class="form-control" placeholder="{{ __('filter.search_here') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-2">
                        <select name="status" class="form-select select2">
                            <option value="">{{ __('filter.show_all') }}</option>
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3">
                        <select name="sort_by" class="form-select select2">
                            <option value=""> {{ __('filter.sort_by') }} </option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                            <option value="tracking_number" {{ request('sort_by') == 'tracking_number' ? 'selected' : '' }}>
                                {{ __('package.tracking_number') }}
                            </option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>
                                {{ __('package.status') }}
                            </option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                {{ __('package.created_at') }}
                            </option>
                            <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>
                                {{ __('package.updated_at') }}
                            </option>
                            <!-- يمكن إضافة باقي الحقول هنا حسب الحاجة -->
                        </select>
                    </div>

                    <!-- Delivery Method -->
                    <div class="col-md-2">
                        <select name="delivery_method" class="form-select select2">
                            <option value="">{{ __('filter.all_delivery_methods') }}</option>
                            <option value="standard" {{ request('delivery_method') == 'standard' ? 'selected' : '' }}>
                                {{ __('package.standard') }}
                            </option>
                            <option value="express" {{ request('delivery_method') == 'express' ? 'selected' : '' }}>
                                {{ __('package.express') }}
                            </option>
                            <option value="pickup" {{ request('delivery_method') == 'pickup' ? 'selected' : '' }}>
                                {{ __('package.pickup') }}
                            </option>
                            <option value="courier" {{ request('delivery_method') == 'courier' ? 'selected' : '' }}>
                                {{ __('package.courier') }}
                            </option>
                        </select>
                    </div>

                    <!-- Package Type -->
                    <div class="col-md-2">
                        <select name="package_type" class="form-select select2">
                            <option value="">{{ __('filter.all_package_types') }}</option>
                            <option value="box" {{ request('package_type') == 'box' ? 'selected' : '' }}>Box</option>
                            <option value="envelope" {{ request('package_type') == 'envelope' ? 'selected' : '' }}>Envelope</option>
                            <option value="pallet" {{ request('package_type') == 'pallet' ? 'selected' : '' }}>Pallet</option>
                            <option value="tube" {{ request('package_type') == 'tube' ? 'selected' : '' }}>Tube</option>
                            <option value="bag" {{ request('package_type') == 'bag' ? 'selected' : '' }}>Bag</option>
                        </select>
                    </div>

                    <!-- حجم الطرد -->
                    <div class="col-md-2">
                        <select name="package_size" class="form-select select2">
                            <option value="">{{ __('filter.all_package_sizes') }}</option>
                            <option value="small" {{ request('package_size')=='small'?'selected':'' }}>Small</option>
                            <option value="medium" {{ request('package_size')=='medium'?'selected':'' }}>Medium</option>
                            <option value="large" {{ request('package_size')=='large'?'selected':'' }}>Large</option>
                            <option value="oversized" {{ request('package_size')=='oversized'?'selected':'' }}>Oversized</option>
                        </select>
                    </div>

                    <!-- مصدر الطرد -->
<div class="col-md-2">
    <select name="origin_type" class="form-select select2">
        <option value="">{{ __('filter.all_origin_types') }}</option>
        <option value="warehouse" {{ request('origin_type')=='warehouse'?'selected':'' }}>Warehouse</option>
        <option value="store" {{ request('origin_type')=='store'?'selected':'' }}>Store</option>
        <option value="home" {{ request('origin_type')=='home'?'selected':'' }}>Home</option>
        <option value="other" {{ request('origin_type')=='other'?'selected':'' }}>Other</option>
    </select>
</div>

<!-- سرعة التوصيل -->
<div class="col-md-2">
    <select name="delivery_speed" class="form-select select2">
        <option value="">{{ __('filter.all_delivery_speeds') }}</option>
        <option value="standard" {{ request('delivery_speed')=='standard'?'selected':'' }}>Standard</option>
        <option value="express" {{ request('delivery_speed')=='express'?'selected':'' }}>Express</option>
        <option value="same_day" {{ request('delivery_speed')=='same_day'?'selected':'' }}>Same Day</option>
        <option value="next_day" {{ request('delivery_speed')=='next_day'?'selected':'' }}>Next Day</option>
    </select>
</div>

<!-- مسؤولية الدفع -->
<div class="col-md-2">
    <select name="payment_responsibility" class="form-select select2">
        <option value="">{{ __('filter.all_payment_responsibilities') }}</option>
        <option value="merchant" {{ request('payment_responsibility')=='merchant'?'selected':'' }}>Merchant</option>
        <option value="recipient" {{ request('payment_responsibility')=='recipient'?'selected':'' }}>Recipient</option>
    </select>
</div>

<!-- طريقة الدفع -->
<div class="col-md-2">
    <select name="payment_method" class="form-select select2">
        <option value="">{{ __('filter.all_payment_methods') }}</option>
        <option value="prepaid" {{ request('payment_method')=='prepaid'?'selected':'' }}>Prepaid</option>
        <option value="cash_on_delivery" {{ request('payment_method')=='cash_on_delivery'?'selected':'' }}>COD</option>
        <option value="exchange" {{ request('payment_method')=='exchange'?'selected':'' }}>Exchange</option>
        <option value="bring" {{ request('payment_method')=='bring'?'selected':'' }}>Bring</option>
    </select>
</div>

<!-- طريقة التحصيل -->
<div class="col-md-2">
    <select name="collection_method" class="form-select select2">
        <option value="">{{ __('filter.all_collection_methods') }}</option>
        <option value="cash" {{ request('collection_method')=='cash'?'selected':'' }}>Cash</option>
        <option value="cheque" {{ request('collection_method')=='cheque'?'selected':'' }}>Cheque</option>
        <option value="bank_transfer" {{ request('collection_method')=='bank_transfer'?'selected':'' }}>Bank Transfer</option>
        <option value="e_wallet" {{ request('collection_method')=='e_wallet'?'selected':'' }}>E-Wallet</option>
        <option value="credit_card" {{ request('collection_method')=='credit_card'?'selected':'' }}>Credit Card</option>
        <option value="mada" {{ request('collection_method')=='mada'?'selected':'' }}>Mada</option>
    </select>
</div>


                    <!-- Order By -->
                    <div class="col-md-2">
                        <select name="order_by" class="form-select select2">
                            <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>{{ __('filter.asc') }}</option>
                            <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>{{ __('filter.desc') }}</option>                        </select>
                    </div>

                    <!-- Limit By -->
                    <div class="col-md-1">
                        <select name="limit_by" class="form-select select2">
                            <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                            <option value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                            <option value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                            <i class="fas fa-search me-1"></i>{{ __('general.filter') }}
                        </button>
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary flex-grow-1">
                            <i class="fas fa-undo me-1"></i>{{ __('general.reset') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
