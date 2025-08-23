<div>
    <div class="row mb-3">
        <div class="col-12 mb-3">
            <label for="receiver_merchant_id" class="form-label">{{ __('general.merchant') }} ({{ __('general.optional') }})</label>
            <select class="form-select" wire:model="receiver_merchant_id" id="receiver_merchant_id" name="receiver_merchant_id">
                <option value="">{{ __('general.select') }}</option>
                @foreach($merchants as $merchant)
                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label" for="receiver_first_name">{{ __('package.receiver_first_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="receiver_first_name" name="receiver_first_name" id="receiver_first_name" required>
            @error('receiver_first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label" for="receiver_middle_name">{{ __('package.receiver_middle_name') }}</label>
            <input type="text" class="form-control" wire:model="receiver_middle_name" name="receiver_middle_name" id="receiver_middle_name">
            @error('receiver_middle_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label" for="receiver_last_name">{{ __('package.receiver_last_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="receiver_last_name" name="receiver_last_name" id="receiver_last_name" required>
            @error('receiver_last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="receiver_email">{{ __('package.receiver_email') }}</label>
            <input type="email" class="form-control" wire:model="receiver_email" name="receiver_email" id="receiver_email">
            @error('receiver_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="receiver_phone">{{ __('package.receiver_phone') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="receiver_phone" name="receiver_phone" id="receiver_phone" required>
            @error('receiver_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
