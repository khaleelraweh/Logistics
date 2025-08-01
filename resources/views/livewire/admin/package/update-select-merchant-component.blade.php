<div class="mb-3" wire:ignore>
    <label for="merchant_id" class="form-label">التاجر (اختياري)</label>
    <select class="form-select" wire:model="merchant_id" id="merchant_id" name="merchant_id">
        <option value="">بدون تاجر</option>
        @foreach($merchants as $merchant)
            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
        @endforeach
    </select>
</div>
