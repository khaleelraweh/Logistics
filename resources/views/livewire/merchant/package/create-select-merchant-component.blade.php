<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-user me-2"></i>{{ __('package.sender_info') }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>{{ __('merchant.name') }}:</strong>
                <p class="mb-0">{{ $merchant_name }}</p>
                <input type="hidden" id="merchant_id" name="merchant_id" value="{{ $merchant_id }}">
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_name') }}:</strong>
                <p class="mb-0">{{ $sender_full_name }}</p>
                <input type="hidden" name="sender_full_name" value="{{ $sender_full_name }}">

                <!-- إذا تريد تقسيم الاسم إلى أول ووسط وآخر -->
                @php
                    $names = explode(' ', $sender_full_name);
                    $first_name = $names[0] ?? '';
                    $last_name  = end($names) ?? '';
                    $middle_name = count($names) > 2 ? implode(' ', array_slice($names, 1, count($names) - 2)) : '';
                @endphp
                <input type="hidden" name="sender_first_name" id="sender_first_name" value="{{ $first_name }}">
                <input type="hidden" name="sender_middle_name" id="sender_middle_name" value="{{ $middle_name }}">
                <input type="hidden" name="sender_last_name" id="sender_last_name" value="{{ $last_name }}">
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_email') }}:</strong>
                <p class="mb-0">{{ $sender_email }}</p>
                <input type="hidden" name="sender_email" value="{{ $sender_email }}">
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_phone') }}:</strong>
                <p class="mb-0">{{ $sender_phone }}</p>
                <input type="hidden" name="sender_phone" value="{{ $sender_phone }}">
            </div>
        </div>
    </div>
</div>

<style>
    .card-body p {
        background-color: #f8f9fa;
        padding: 8px 12px;
        border-radius: 5px;
        margin-bottom: 0;
        font-weight: 500;
    }
    .card-body strong {
        display: block;
        margin-bottom: 4px;
        color: #495057;
    }
</style>
