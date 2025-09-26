<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class=" fas fa-file-invoice-dollar "></i> {{ __('package.collection') }}</5>
        </div>
        <div class="card-body">

            {{-- 🧭 مسؤولية الدفع + طريقة الدفع + طريقة التحصيل --}}
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.payment_responsibility') }}</label>
                    <select wire:model="payment_responsibility" name="payment_responsibility" id="payment_responsibility" class="form-select">
                        <option value="merchant">{{ __('package.responsibility_merchant') }}</option>
                        <option value="recipient">{{ __('package.responsibility_recipient') }}</option>
                    </select>
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.payment_method') }}</label>
                    <select wire:model="payment_method" name="payment_method" id="payment_method" class="form-select">
                        <option value="prepaid">{{ __('package.payment_prepaid') }}</option>
                        <option value="cash_on_delivery">{{ __('package.payment_cod') }}</option>
                        <option value="exchange">{{ __('package.payment_exchange') }}</option>
                        <option value="bring">{{ __('package.payment_bring') }}</option>
                    </select>
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.collection_method') }}</label>
                    <select wire:model="collection_method"  name="collection_method" id="collection_method" class="form-select">
                        <option value="cash">{{ __('package.collection_cash') }}</option>
                        <option value="cheque">{{ __('package.collection_cheque') }}</option>
                        <option value="bank_transfer">{{ __('package.collection_bank_transfer') }}</option>
                        <option value="e_wallet">{{ __('package.collection_e_wallet') }}</option>
                        <option value="credit_card">{{ __('package.collection_credit_card') }}</option>
                        <option value="mada">{{ __('package.collection_mada') }}</option>
                    </select>
                </div>
            </div>

            {{-- 💰 التكاليف --}}
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.delivery_fee') }}</label>
                    <p class="mb-0">{{ $delivery_fee }}</p>
                    <input wire:model="delivery_fee" name="delivery_fee" id="delivery_fee" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.insurance_fee') }}</label>
                    <p class="mb-0">{{ $insurance_fee }}</p>
                    <input wire:model="insurance_fee" name="insurance_fee" id="insurance_fee" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.service_fee') }}</label>
                    <p class="mb-0">{{ $service_fee }}</p>
                    <input wire:model="service_fee" name="service_fee" id="service_fee" type="number" step="0.01" class="form-control">
                </div>
            </div>

            {{-- 💰 المبالغ --}}
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.total_fee') }}</label>
                    <p class="mb-0">{{ $this->totalFee  }}</p>
                    <input type="number" name="total_fee" id="total_fee" class="form-control" value="{{ $this->totalFee }}" readonly>
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.paid_amount') }}</label>
                    <p class="mb-0">{{ $paid_amount  }}</p>
                    <input wire:model="paid_amount" name="paid_amount" id="paid_amount" type="number" step="0.01" class="form-control">
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="col-form-label">{{ __('package.remaining_amount') }}</label>
                    <p class="mb-0">{{ $this->remainingAmount  }}</p>
                    <input type="number" name="due_amount" id="due_amount" class="form-control" value="{{ $this->remainingAmount }}" readonly>
                </div>
            </div>

            {{-- 🏷️ الدفع عند الاستلام --}}
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label class="col-form-label">{{ __('package.cod_amount') }}</label>
                    <input wire:model="cod_amount" name="cod_amount" id="cod_amount" type="number" step="0.01" class="form-control">
                </div>
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
</style>
