<div>
    <table class="table table-bordered">
        <thead>
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
                    <td>
                        @if($merchant_id)
                            <select class="form-select" name="products[{{ $index }}][type]" wire:model="products.{{ $index }}.type">
                                <option value="custom">{{ __('product.custom') }}</option>
                                <option value="stock">{{ __('product.stock') }}</option>
                            </select>
                        @else
                            <input type="hidden" name="products[{{ $index }}][type]" value="custom">
                            <input type="text" class="form-control" readonly value="{{ __('product.custom') }}">
                        @endif
                    </td>

                    <td>
                        @if ($merchant_id && $product['type'] === 'stock')
                            <select class="form-select" name="products[{{ $index }}][stock_item_id]" wire:model="products.{{ $index }}.stock_item_id">
                                <option value="">{{ __('product.choose_stock') }}</option>
                                @foreach ($stockItems as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->product->name }} ({{ __('product.available_qty') }}: {{ $item->quantity }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="products[{{ $index }}][custom_name]" value="{{ $product['custom_name'] }}">
                        @else
                            <input type="text" class="form-control mb-1"
                                placeholder="{{ __('product.name_placeholder') }}"
                                name="products[{{ $index }}][custom_name]"
                                wire:model="products.{{ $index }}.custom_name">
                        @endif
                    </td>

                    <td>
                        <input type="number" class="form-control"
                            name="products[{{ $index }}][weight]"
                            placeholder="{{ __('product.weight_placeholder') }}"
                            wire:model="products.{{ $index }}.weight">
                    </td>

                    <td>
                        <input type="number" class="form-control"
                            name="products[{{ $index }}][quantity]"
                            placeholder="{{ __('product.quantity_placeholder') }}"
                            wire:model="products.{{ $index }}.quantity">
                    </td>

                    <td>
                        <input type="number" step="0.01" class="form-control"
                            name="products[{{ $index }}][price_per_unit]"
                            placeholder="{{ __('product.price_per_unit_placeholder') }}"
                            wire:model="products.{{ $index }}.price_per_unit"
                            @if ($merchant_id && $product['type'] === 'stock') readonly @endif>
                    </td>

                    <td>
                        <input type="number" class="form-control" readonly
                            name="products[{{ $index }}][total_price]"
                            placeholder="{{ __('product.total_placeholder') }}"
                            wire:model="products.{{ $index }}.total_price">
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger btn-sm"
                            wire:click.prevent="removeProduct({{ $index }})">
                            {{ __('product.delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary mt-2" wire:click.prevent="addProduct">
        + {{ __('product.add_new') }}
    </button>
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
