<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>النوع</th>
                <th>تفاصيل المنتج</th>
                <th>الوزن</th>
                <th>الكمية</th>
                <th>سعر الوحدة</th>
                <th>الإجمالي</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>
                        {{-- نسمح فقط باختيار "مخصص" إذا لم يوجد تاجر --}}
                        @if($merchant_id)
                            <select
                                class="form-select"
                                name="products[{{ $index }}][type]"
                                wire:model="products.{{ $index }}.type"
                            >
                                <option value="custom">مخصص</option>
                                <option value="stock">من المخزون</option>
                            </select>
                        @else
                            <input type="hidden" name="products[{{ $index }}][type]" value="custom">
                            <input type="text" class="form-control" readonly value="مخصص">

                        @endif
                    </td>

                    <td>
                        @if ($merchant_id && $product['type'] === 'stock')
                            <select class="form-select" name="products[{{ $index }}][stock_item_id]" wire:model="products.{{ $index }}.stock_item_id">
                                <option value="">-- اختر من المخزون --</option>
                                @foreach ($stockItems as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->product->name }} (الكمية المتاحة: {{ $item->quantity }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden"
                                name="products[{{ $index }}][custom_name]"
                                value="{{ $product['custom_name'] }}"
                            >
                        @else
                            <input type="text" class="form-control mb-1"
                                placeholder="اسم المنتج"
                                name="products[{{ $index }}][custom_name]"
                                wire:model="products.{{ $index }}.custom_name">
                        @endif
                    </td>

                    <td>
                        <input type="number" class="form-control"
                            name="products[{{ $index }}][weight]"
                            placeholder="الوزن"
                            step="0.01"
                            wire:model="products.{{ $index }}.weight">
                    </td>

                    <td>
                        <input type="number" class="form-control"
                            name="products[{{ $index }}][quantity]"
                            placeholder="الكمية"
                            wire:model="products.{{ $index }}.quantity">
                    </td>

                    <td>
                        <input type="number" step="0.01" class="form-control"
                            name="products[{{ $index }}][price_per_unit]"
                            placeholder="سعر الوحدة"
                            wire:model="products.{{ $index }}.price_per_unit"
                            @if ($merchant_id && $product['type'] === 'stock') readonly @endif>
                    </td>

                    <td>
                        <input type="number" class="form-control" readonly
                            name="products[{{ $index }}][total_price]"
                            placeholder="الإجمالي"
                            wire:model="products.{{ $index }}.total_price">
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger btn-sm"
                            wire:click.prevent="removeProduct({{ $index }})">
                            حذف
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary mt-2" wire:click.prevent="addProduct">
        + إضافة منتج جديد
    </button>
</div>


<script>
    window.addEventListener('notify', event => {
        Swal.fire({
            icon: event.detail.type,   // success, warning, error, info, question
            title: event.detail.title || 'تنبيه',  // عنوان اختياري، إذا لم يرسل في الحدث يضع 'تنبيه'
            text: event.detail.message,
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            position: 'top-center',
            toast: true
        });
    });
</script>

