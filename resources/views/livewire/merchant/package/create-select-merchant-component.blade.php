<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-user me-2"></i>{{ __('package.sender_info') }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>{{ __('merchant.name') }}:</strong>
                <p class="mb-0">{{ $merchant_name }}</p>
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_name') }}:</strong>
                <p class="mb-0">{{ $sender_full_name }}</p>
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_email') }}:</strong>
                <p class="mb-0">{{ $sender_email }}</p>
            </div>
            <div class="mb-3">
                <strong>{{ __('package.sender_phone') }}:</strong>
                <p class="mb-0">{{ $sender_phone }}</p>
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
