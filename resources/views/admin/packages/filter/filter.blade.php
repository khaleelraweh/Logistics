<div class="card mb-4">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="fas fa-filter me-2 text-primary"></i>{{ __('general.filters') }}
        </h6>
        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false">
            <i class="fas fa-sliders-h me-1"></i>{{ __('general.show_filters') }}
        </button>
    </div>

    <div id="filtersCollapse" class="collapse">
        <div class="card-body">
            <form action="{{ route('admin.packages.index') }}" method="get">
                <div class="row">

                    <!-- التاجر المرسل -->
                    <div class="col-md-3 mb-2">
                        <select name="merchant_id" class="form-select select2">
                            <option value="">{{ __('shelf.all_merchants') }}</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" {{ request('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                    {{ $merchant->name }} - {{ $merchant->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- التاجر المستقبل -->
                    <div class="col-md-3 mb-2">
                        <select name="receiver_merchant_id" class="form-select select2">
                            <option value="">{{ __('shelf.all_merchants') }}</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" {{ request('receiver_merchant_id') == $merchant->id ? 'selected' : '' }}>
                                    {{ $merchant->name }} - {{ $merchant->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- اسم المرسل -->
                    <div class="col-md-3 mb-2">
                        <input type="text" name="sender_name" class="form-control" placeholder="{{ __('package.sender_name') }}" value="{{ request('sender_name') }}">
                    </div>

                    <!-- عنوان المرسل -->
                    <div class="col-md-2 mb-2">
                        <input type="text" name="sender_city" class="form-control" placeholder="{{ __('package.sender_city') }}" value="{{ request('sender_city') }}">
                    </div>

                    <!-- اسم المستلم -->
                    <div class="col-md-3 mb-2">
                        <input type="text" name="receiver_name" class="form-control" placeholder="{{ __('package.receiver_name') }}" value="{{ request('receiver_name') }}">
                    </div>

                    <!-- عنوان المستلم -->
                    <div class="col-md-2 mb-2">
                        <input type="text" name="receiver_city" class="form-control" placeholder="{{ __('package.receiver_city') }}" value="{{ request('receiver_city') }}">
                    </div>

                    <div class="col-md-2 mb-2">
                        <input type="text" name="receiver_district" class="form-control" placeholder="{{ __('package.receiver_district') }}" value="{{ request('receiver_district') }}">
                    </div>

                    <!-- الكمية -->
                    <div class="col-md-2 mb-2">
                        <input type="number" name="quantity_min" class="form-control" placeholder="{{ __('package.quantity_min') }}" value="{{ request('quantity_min') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="number" name="quantity_max" class="form-control" placeholder="{{ __('package.quantity_max') }}" value="{{ request('quantity_max') }}">
                    </div>

                    <!-- مسؤولية الدفع -->
                    <div class="col-md-2 mb-2">
                        <select name="payment_responsibility" class="form-select">
                            <option value="">{{ __('package.payment_responsibility') }}</option>
                            <option value="merchant" {{ request('payment_responsibility')=='merchant' ? 'selected':'' }}>Merchant</option>
                            <option value="recipient" {{ request('payment_responsibility')=='recipient' ? 'selected':'' }}>Recipient</option>
                        </select>
                    </div>

                    <!-- طريقة التحصيل -->
                    <div class="col-md-2 mb-2">
                        <select name="collection_method" class="form-select">
                            <option value="">{{ __('package.collection_method') }}</option>
                            <option value="cash" {{ request('collection_method')=='cash' ? 'selected':'' }}>Cash</option>
                            <option value="cheque" {{ request('collection_method')=='cheque' ? 'selected':'' }}>Cheque</option>
                            <option value="bank_transfer" {{ request('collection_method')=='bank_transfer' ? 'selected':'' }}>Bank Transfer</option>
                            <option value="e_wallet" {{ request('collection_method')=='e_wallet' ? 'selected':'' }}>E-wallet</option>
                            <option value="credit_card" {{ request('collection_method')=='credit_card' ? 'selected':'' }}>Credit Card</option>
                            <option value="mada" {{ request('collection_method')=='mada' ? 'selected':'' }}>Mada</option>
                        </select>
                    </div>

                    <!-- الحالة -->
                    <div class="col-md-2 mb-2">
                        <select name="status" class="form-select">
                            <option value="">{{ __('panel.show_all') }}</option>
                            @foreach(\App\Models\Package::STATUSES as $status)
                                <option value="{{ $status }}" {{ request('status')==$status?'selected':'' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3 mb-2 d-flex align-items-end">
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
