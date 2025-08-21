
 <div class="row mb-3">
    <div class="col-12">
        <label for="merchant_id" class="form-label">التاجر (اختياري)</label>
        <select class="form-select" wire:model="merchant_id" id="merchant_id" name="merchant_id">
            <option value="">بدون تاجر</option>
            @foreach($merchants as $merchant)
                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-4">
        <label for="sender_first_name" class="form-label">
            {{ __('package.sender_first_name') }} <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control {{ $errors->has('sender_first_name') ? 'is-invalid' : '' }}"
            id="sender_first_name" name="sender_first_name" value="{{ old('sender_first_name') }}" required>
        @error('sender_first_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="sender_middle_name" class="form-label">
            {{ __('package.sender_middle_name') }} <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control {{ $errors->has('sender_middle_name') ? 'is-invalid' : '' }}"
            id="sender_middle_name" name="sender_middle_name" value="{{ old('sender_middle_name') }}" required>
        @error('sender_middle_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="sender_last_name" class="form-label">
            {{ __('package.sender_last_name') }} <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control {{ $errors->has('sender_last_name') ? 'is-invalid' : '' }}"
            id="sender_last_name" name="sender_last_name" value="{{ old('sender_last_name') }}" required>
        @error('sender_last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-6">
        <label for="sender_email" class="form-label">{{ __('package.sender_email') }}</label>
        <input type="email" class="form-control {{ $errors->has('sender_email') ? 'is-invalid' : '' }}" id="sender_email" name="sender_email" value="{{ old('sender_email') }}">
        @error('sender_email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="sender_phone" class="form-label">{{ __('package.sender_phone') }}  <span class="text-danger">*</span></label>
        <input type="text" class="form-control {{ $errors->has('sender_phone') ? 'is-invalid' : '' }}" id="sender_phone" name="sender_phone" value="{{ old('sender_phone') }}" required>
        @error('sender_phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
