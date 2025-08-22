<div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="merchant_id" class="form-label">{{ __('general.merchant') }} ({{ __('general.optional') }})</label>
            <select class="form-select" wire:model="merchant_id" id="merchant_id" name="merchant_id">
                <option value="">{{ __('general.select') }}</option>
                @foreach($merchants as $merchant)
                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">{{ __('package.sender_first_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_first_name" name="sender_first_name" required>
            @error('sender_first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">{{ __('package.sender_middle_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_middle_name" name="sender_middle_name" required>
            @error('sender_middle_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">{{ __('package.sender_last_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_last_name" name="sender_last_name" required>
            @error('sender_last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">{{ __('package.sender_email') }}</label>
            <input type="email" class="form-control" wire:model="sender_email" name="sender_email">
            @error('sender_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('package.sender_phone') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_phone" name="sender_phone" required>
            @error('sender_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
