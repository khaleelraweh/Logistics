
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">{{ __('return_request.add_return_request') }}</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('return_request.add_return_request') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('return_request.return_request_information') }}
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <!-- Package Selection -->
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label required-field">{{ __('package.package') }}</label>
                                <div class="col-sm-10">
                                    {{-- <select id="packageSelect" class="form-select" onchange="showPackageDetails()"> --}}
                                    <select wire:model="package_id" class="form-select ">
                                        <option value="">{{ __('package.select_package') }}</option>
                                         @foreach($packages as $package)
                                            <option value="{{ $package->id }}">
                                                {{ $package->tracking_number }} - {{ $package->receiver_full_name }} ({{ $package->receiver_city }})
                                            </option>
                                        @endforeach

                                    </select>
                                    <div class="form-text">{{ __('package.select_package_message') }}</div>
                                </div>
                            </div>

                               {{-- المنتجات المرتبطة بالطرد --}}

                            @if($packageProducts)
                                  <!-- Package Details (Initially Hidden) -->
                                <div id="packageDetails" class="package-details">
                                    <h5 class="section-title">{{ __('package.package_details') }} </h5>

                                    <div class="row">
                                        <!-- Sender Information -->
                                        <div class="col-md-6">
                                            <div class="card sender-info" id="senderInfo1">
                                                <div class="card-header bg-info py-2">
                                                    <i class="bi bi-person me-2"></i> {{ __('package.sender_info') }}  - {{ __('package.package') }} #{{ $package->tracking_number }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="info-label"> {{ __('general.full_name') }}</div>
                                                            <div class="info-value">{{ $package->sender_full_name }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.phone') }}</div>
                                                            <div class="info-value">+{{ $package->sender_phone }}</div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="info-label">{{ __('general.address') }}</div>
                                                             @php
                                                                $addressParts = array_filter([
                                                                    $package->sender_district,
                                                                    $package->sender_city,
                                                                    $package->sender_region,
                                                                    $package->sender_country,
                                                                    $package->sender_postal_code,
                                                                ]); // إزالة القيم الفارغة

                                                                $shortAddress = implode(' ، ', array_slice($addressParts, 0, 2)); // أول قيمتين فقط
                                                                $fullAddress = implode(' ، ', $addressParts); // كامل النص
                                                            @endphp

                                                            <div class="info-value"> {{ $fullAddress }}   </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.city') }}</div>
                                                            <div class="info-value">{{ $package->sender_city }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.region') }}</div>
                                                            <div class="info-value">{{ $package->sender_region }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.latitude') }}</div>
                                                            <div class="info-value coordinates">{{ $package->sender_latitude }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.longitude') }}</div>
                                                            <div class="info-value coordinates">{{ $package->sender_longitude }}</div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="map-container">
                                                                <i class="bi bi-geo-alt me-2"></i> {{ __('package.sender_location_map') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- Receiver Information -->
                                        <div class="col-md-6">
                                            <div class="card receiver-info" id="receiverInfo1">
                                                <div class="card-header bg-success py-2">
                                                    <i class="bi bi-person me-2"></i>  {{ __('package.receiver_info') }} - {{ __('package.package') }} #{{ $package->tracking_number }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.full_name') }}</div>
                                                            <div class="info-value">{{ $package->receiver_full_name }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.phone') }}</div>
                                                            <div class="info-value">+{{ $package->phone }}</div>
                                                        </div>
                                                        <div class="col-12">
                                                             @php
                                                                $addressParts = array_filter([
                                                                    $package->receiver_district,
                                                                    $package->receiver_city,
                                                                    $package->receiver_region,
                                                                    $package->receiver_country,
                                                                    $package->receiver_postal_code,
                                                                ]); // إزالة القيم الفارغة

                                                                $shortReceiverAddress = implode(' ، ', array_slice($addressParts, 0, 2)); // أول قيمتين فقط
                                                                $fullReceiverAddress = implode(' ، ', $addressParts); // كامل النص
                                                            @endphp

                                                            <div class="info-label">{{ $package->address }}</div>
                                                            <div class="info-value"> {{ $fullReceiverAddress }} </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.city') }}</div>
                                                            <div class="info-value">{{ $package->receiver_city }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.region') }}</div>
                                                            <div class="info-value"> {{ $package->receiver_region }} </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.latitude') }}</div>
                                                            <div class="info-value coordinates">{{ $package->receiver_latitude }}</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">{{ __('general.longitude') }}</div>
                                                            <div class="info-value coordinates">{{ $package->receiver_longitude }}</div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="map-container">
                                                                <i class="bi bi-geo-alt me-2"></i>  {{ __('package.receiver_location_map') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Package Products -->
                                    <h5 class="section-title mt-4">{{ __('package.package_items') }}</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered product-table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('product.product_type') }}</th>
                                                    <th>{{ __('product.product_name') }}</th>
                                                    <th>{{ __('product.quantity_shipped') }}</th>
                                                    <th> {{ __('product.quantity_to_be_returned') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($packageProducts as $product)
                                                    <tr>
                                                        <td> {{ __('product.'.$product['type'] ?? 'not_set') }}</td>
                                                        <td>{{ $product['custom_name'] ?? 'Product #' . $product['id'] }}</td>
                                                        <td>{{ $product['quantity'] }}</td>
                                                        <td>
                                                            <input type="number" wire:model="returnQuantities.{{ $product['id'] }}" min="0" max="{{ $product['quantity'] }}" class="form-control" />
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif


                            <!-- Driver Selection -->
                            <h5 class="section-title">{{ __('return_request.delivery_information') }}</h5>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">{{ __('driver.driver') }}</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value=""> {{ __('driver.select_driver') }} </option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->driver_full_name }}  -  {{ __('driver.vehicle_type_'. $driver->vehicle_type) }} - {{ $driver->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Return Type -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field"> {{ __('return_request.return_type') }}</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="to_warehouse">{{ __('return_request.type_to_warehouse') }}</option>
                                        <option value="to_merchant">{{ __('return_request.type_to_merchant') }}</option>
                                        <option value="to_both">{{ __('return_request.type_to_both') }}</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Target Address -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"> {{ __('return_request.target_address') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model="target_address" class="form-control">
                                    @error('target_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-form-label required-field"> {{ __('return_request.requested_at') }} </label>
                                    <input type="date" wire:model="requested_at" class="form-control">
                                    @error('requested_at') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">{{ __('return_request.received_at') }}</label>
                                    <input type="date" class="form-control" value="2023-11-20">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">{{ __('return_request.status') }}</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                         <option value="requested">{{ __('return_request.status_requested') }}</option>
                                        <option value="cancelled">{{ __('return_request.status_cancelled') }}</option>
                                        <option value="in_transit">{{ __('return_request.status_in_transit') }}</option>
                                        <option value="rejected">{{ __('return_request.status_rejected') }}</option>
                                        <option value="received">{{ __('return_request.status_received') }}</option>
                                        <option value="partially_received">{{ __('return_request.status_partially_received') }}</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <!-- Reason -->
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">{{ __('general.reason') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="{{ __('return_request.reason_message') }}"></textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end pt-3">
                                @ability('admin', 'create_return_requests')
                                    <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                        <i class="ri-save-3-line me-2"></i>
                                        <i class="bi bi-save me-2"></i>
                                        {{ __('return_request.save_return_request') }}
                                    </button>
                                @endability

                                <a href="{{ route('admin.return_requests.index') }}" class="btn btn-outline-danger ms-2">
                                    <i class="ri-arrow-go-back-line me-1"></i>
                                    {{ __('panel.cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // دالة لعرض تفاصيل الطرد عند الاختيار
        function showPackageDetails() {
            const packageSelect = document.getElementById('packageSelect');
            const packageDetails = document.getElementById('packageDetails');
            const selectedValue = packageSelect.value;

            // إخفاء جميع معلومات المرسلين والمستلمين
            document.querySelectorAll('.sender-info, .receiver-info').forEach(el => {
                el.style.display = 'none';
            });

            if (selectedValue) {
                // إظهار تفاصيل الطرد
                packageDetails.style.display = 'block';

                // إظهار المعلومات المناسبة للطرد المحدد
                document.getElementById('senderInfo' + selectedValue).style.display = 'block';
                document.getElementById('receiverInfo' + selectedValue).style.display = 'block';
            } else {
                // إخفاء تفاصيل الطرد إذا لم يتم اختيار أي طرد
                packageDetails.style.display = 'none';
            }
        }

        // تهيئة أولية لإظهار بيانات افتراضية إذا كان هناك قيمة محددة مسبقاً
        document.addEventListener('DOMContentLoaded', function() {
            // يمكنك هنا تهيئة القيم إذا كانت هناك قيمة محددة مسبقاً
            // document.getElementById('packageSelect').value = '1';
            // showPackageDetails();
        });
    </script> --}}

