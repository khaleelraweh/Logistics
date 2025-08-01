<div>
    <div class="card">
        <div class="card-header">
            <h4>{{ __('package.collection') }}</h4>
        </div>
        <div class="card-body">
            {{-- 🧭 مسؤولية الدفع + تكاليف الشحن --}}
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label class="col-form-label">{{ __('package.payment_responsibility') }}</label>
                    <select wire:model="payment_responsibility" name="payment_responsibility" value="{{ old('payment_responsibility') }}" class="form-select">
                        <option value="merchant">{{ __('package.responsibility_merchant') }}</option>
                        <option value="recipient">{{ __('package.responsibility_recipient') }}</option>
                    </select>
                </div>

                <div class="col-sm-3">
                    <label class="col-form-label">{{ __('package.delivery_fee') }}</label>
                    <input wire:model="delivery_fee" name="delivery_fee" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-3">
                    <label class="col-form-label">{{ __('package.insurance_fee') }}</label>
                    <input wire:model="insurance_fee" name="insurance_fee" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-3">
                    <label class="col-form-label">{{ __('package.service_fee') }}</label>
                    <input wire:model="service_fee" name="service_fee" type="number" step="0.01" class="form-control">
                </div>
            </div>

            {{-- 💰 المبالغ --}}
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label class="col-form-label">{{ __('package.total_fee') }}</label>
                    <input type="number" name="total_fee" class="form-control" value="{{ $this->totalFee }}" readonly>
                </div>

                <div class="col-sm-4">
                    <label class="col-form-label">{{ __('package.paid_amount') }}</label>
                    <input wire:model="paid_amount" name="paid_amount" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-4">
                    <label class="col-form-label">{{ __('package.remaining_amount') }}</label>
                    <input type="number" name="due_amount" class="form-control" value="{{ $this->remainingAmount }}" readonly>
                </div>
            </div>

            {{-- 🏷️ الدفع عند الاستلام --}}
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label class="col-form-label">{{ __('package.cod_amount') }}</label>
                    <input wire:model="cod_amount" name="cod_amount" type="number" step="0.01" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
