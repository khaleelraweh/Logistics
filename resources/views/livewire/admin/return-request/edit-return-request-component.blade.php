<form wire:submit.prevent="update">

    {{-- Package --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.package') }}</label>
        <div class="col-sm-10">
            <select wire:model="package_id" class="form-select">
                <option value="">{{ __('return_request.select_package') }}</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}">
                        {{ $package->tracking_number }} - {{ $package->receiver_first_name }} {{ $package->receiver_last_name }}
                    </option>
                @endforeach
            </select>
            @error('package_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>


    {{-- اختيار الطرد --}}

    {{-- المنتجات المرتبطة بالطرد --}}
    @if($packageProducts)
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"><h6>{{ __('return_request.return_items') }}</h6></label>
            <div class="col-sm-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('return_request.product') }}</th>
                            <th>{{ __('return_request.shipped_qty') }}</th>
                            <th>{{ __('return_request.return_qty') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packageProducts as $product)
                            <tr>
                                <td>{{ $product['custom_name'] ?? 'Product #' . $product['id'] }}</td>
                                <td>{{ $product['quantity'] }}</td>
                                <td>
                                    <input type="number" wire:model="returnQuantities.{{ $product['id'] }}" min="0" max="{{ $product['quantity'] }}" class="form-control" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif




    {{-- Driver --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.driver') }}</label>
        <div class="col-sm-10">
            <select wire:model="driver_id" class="form-select">
                <option value="">{{ __('return_request.select_driver') }}</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }} - {{ $driver->phone }}</option>
                @endforeach
            </select>
            @error('driver_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Return Type --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.return_type') }}</label>
        <div class="col-sm-10">
            <select wire:model="return_type" class="form-select">
                <option value="to_warehouse">{{ __('return_request.type_to_warehouse') }}</option>
                <option value="to_merchant">{{ __('return_request.type_to_merchant') }}</option>
                <option value="to_both">{{ __('return_request.type_to_both') }}</option>
            </select>
            @error('return_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Target Address --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.target_address') }}</label>
        <div class="col-sm-10">
            <input type="text" wire:model="target_address" class="form-control">
            @error('target_address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Requested At --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.requested_at') }}</label>
        <div class="col-sm-10">
            <input type="date" wire:model="requested_at" class="form-control">
            @error('requested_at') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Received At --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.received_at') }}</label>
        <div class="col-sm-10">
            <input type="date" wire:model="received_at" class="form-control">
            @error('received_at') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Status --}}
    {{-- <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.status') }}</label>
        <div class="col-sm-10">
            <select wire:model="status" class="form-select">
                <option value="requested">{{ __('return_request.status_requested') }}</option>
                <option value="cancelled">{{ __('return_request.status_cancelled') }}</option>
                <option value="in_transit">{{ __('return_request.status_in_transit') }}</option>
                <option value="rejected">{{ __('return_request.status_rejected') }}</option>
                <option value="received">{{ __('return_request.status_received') }}</option>
                <option value="partially_received">{{ __('return_request.status_partially_received') }}</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div> --}}

    {{-- Status --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('return_request.status') }}</label>
        <div class="col-sm-10">
            <select wire:model="status" class="form-select">
                @foreach($availableStatuses as $statusOption)
                    <option value="{{ $statusOption }}">{{ __('return_request.status_' . $statusOption) }}</option>
                @endforeach
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>


    {{-- Reason --}}
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">{{ __('general.reason') }}</label>
        <div class="col-sm-10">
            <textarea wire:model="reason" class="form-control" rows="3"></textarea>
            @error('reason') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Submit --}}
    @ability('admin', 'create_return_requests')
        <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ __('return_request.save_return_request') }}</button>
        </div>
    @endability

</form>
