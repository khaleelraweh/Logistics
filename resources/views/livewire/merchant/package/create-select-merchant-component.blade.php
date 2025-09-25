<div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label" for="sender_first_name">{{ __('package.sender_first_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_first_name" id="sender_first_name" required>
            @error('sender_first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label" for="sender_middle_name">{{ __('package.sender_middle_name') }}</label>
            <input type="text" class="form-control" wire:model="sender_middle_name" id="sender_middle_name">
            @error('sender_middle_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label" for="sender_last_name">{{ __('package.sender_last_name') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_last_name" id="sender_last_name" required>
            @error('sender_last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="sender_email">{{ __('package.sender_email') }}</label>
            <input type="email" class="form-control" wire:model="sender_email" id="sender_email">
            @error('sender_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="sender_phone">{{ __('package.sender_phone') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="sender_phone" id="sender_phone" required>
            @error('sender_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
