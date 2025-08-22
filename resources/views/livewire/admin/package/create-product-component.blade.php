<div>
    <div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>{{ __('product.type') }}</th>
                    <th>{{ __('product.details') }}</th>
                    <th>{{ __('product.weight') }}</th>
                    <th>{{ __('product.quantity') }}</th>
                    <th>{{ __('product.price_per_unit') }}</th>
                    <th>{{ __('product.total') }}</th>
                    <th>{{ __('product.delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        {{-- النوع --}}
                        <td class="align-middle">
                            @if($merchant_id)
                                <select class="form-select form-select-sm"
                                        name="products[{{ $index }}][type]"
                                        wire:model="products.{{ $index }}.type">
                                    <option value="custom">{{ __('product.custom') }}</option>
                                    <option value="stock">{{ __('product.stock') }}</option>
                                </select>
                            @else
                                <input type="hidden" name="products[{{ $index }}][type]" value="custom">
                                <input type="text" class="form-control form-control-sm" readonly value="{{ __('product.custom') }}">
                            @endif
                        </td>

                        {{-- تفاصيل المنتج --}}
                        <td class="align-middle">
                            @if ($merchant_id && $product['type'] === 'stock')
                                <select class="form-select form-select-sm"
                                        name="products[{{ $index }}][stock_item_id]"
                                        wire:model="products.{{ $index }}.stock_item_id">
                                    <option value="">{{ __('product.choose_stock') }}</option>
                                    @foreach ($stockItems as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->product->name }} ({{ __('product.available_qty') }}: {{ $item->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="products[{{ $index }}][custom_name]" value="{{ $product['custom_name'] }}">
                            @else
                                <input type="text" class="form-control form-control-sm mb-1"
                                    placeholder="{{ __('product.name_placeholder') }}"
                                    name="products[{{ $index }}][custom_name]"
                                    wire:model="products.{{ $index }}.custom_name">
                            @endif
                        </td>

                        {{-- الوزن --}}
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm"
                                name="products[{{ $index }}][weight]"
                                placeholder="{{ __('product.weight_placeholder') }}"
                                wire:model="products.{{ $index }}.weight">
                        </td>

                        {{-- الكمية --}}
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm"
                                name="products[{{ $index }}][quantity]"
                                placeholder="{{ __('product.quantity_placeholder') }}"
                                wire:model="products.{{ $index }}.quantity">
                        </td>

                        {{-- سعر الوحدة --}}
                        <td class="align-middle">
                            <input type="number" step="0.01" class="form-control form-control-sm"
                                name="products[{{ $index }}][price_per_unit]"
                                placeholder="{{ __('product.price_per_unit_placeholder') }}"
                                wire:model="products.{{ $index }}.price_per_unit"
                                @if ($merchant_id && $product['type'] === 'stock') readonly @endif>
                        </td>

                        {{-- الإجمالي --}}
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm" readonly
                                name="products[{{ $index }}][total_price]"
                                placeholder="{{ __('product.total_placeholder') }}"
                                wire:model="products.{{ $index }}.total_price">
                        </td>

                        {{-- حذف --}}
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-danger btn-sm"
                                wire:click.prevent="removeProduct({{ $index }})">
                                {{ __('product.delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- زر إضافة منتج جديد --}}
    <div class="mt-2 d-flex justify-content-start">
        <button type="button" class="btn btn-secondary btn-sm" wire:click.prevent="addProduct">
            + {{ __('product.add_new') }}
        </button>
    </div>
</div>

<script>
    window.addEventListener('notify', event => {
        Swal.fire({
            icon: event.detail.type,
            title: event.detail.title || '{{ __("product.notify") }}',
            text: event.detail.message,
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            position: 'top-center',
            toast: true
        });
    });
</script>

<style>
    /* لجعل الجدول أكثر قابلية للعرض على الجوال */
    @media (max-width: 767px) {
        table.table thead {
            display: none;
        }

        table.table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }

        table.table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 0.3rem 0.5rem;
        }

        table.table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            flex: 1;
        }

        table.table tbody td:last-child {
            justify-content: center;
        }
    }
</style>

</div>
