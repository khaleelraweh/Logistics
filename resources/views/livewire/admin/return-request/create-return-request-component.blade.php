
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
                        <form>
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

                                            <div class="card receiver-info" id="receiverInfo2" style="display: none;">
                                                <div class="card-header bg-success py-2">
                                                    <i class="bi bi-person me-2"></i> معلومات المستلم - الطرد #987654321
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="info-label">الاسم الكامل</div>
                                                            <div class="info-value">سعيد عبدالله</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">رقم الهاتف</div>
                                                            <div class="info-value">+966598765432</div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="info-label">العنوان</div>
                                                            <div class="info-value">حي العليا، شارع العروبة، الرياض 67890</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">المدينة</div>
                                                            <div class="info-value">الرياض</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">المنطقة</div>
                                                            <div class="info-value">منطقة الرياض</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">خط الطول</div>
                                                            <div class="info-value coordinates">46.7343861</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-label">خط العرض</div>
                                                            <div class="info-value coordinates">24.7253899</div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="map-container">
                                                                <i class="bi bi-geo-alt me-2"></i> خريطة موقع المستلم
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Package Products -->
                                    <h5 class="section-title mt-4">منتجات الطرد</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered product-table">
                                            <thead>
                                                <tr>
                                                    <th>نوع المنتج</th>
                                                    <th>اسم المنتج</th>
                                                    <th>الكمية المشحونة</th>
                                                    <th>الكمية المراد إرجاعها</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>منتج مخزون</td>
                                                    <td>هاتف ذكي - Samsung Galaxy S22</td>
                                                    <td>2</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm" min="0" max="2" value="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>منتج مخصص</td>
                                                    <td>حقيبة جلدية</td>
                                                    <td>1</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm" min="0" max="1" value="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>منتج مخزون</td>
                                                    <td>سماعات لاسلكية - Sony WH-1000XM4</td>
                                                    <td>3</td>
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm" min="0" max="3" value="0">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif


                            <!-- Driver Selection -->
                            <h5 class="section-title">معلومات التسليم</h5>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">السائق</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="">اختر السائق</option>
                                        <option value="1">علي أحمد - سيارة</option>
                                        <option value="2">خالد سعيد - دراجة نارية</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Return Type -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">نوع الإرجاع</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="to_warehouse">إلى المستودع</option>
                                        <option value="to_merchant">إلى التاجر</option>
                                        <option value="to_both">إلى المستودع والتاجر</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Target Address -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">عنوان الوجهة</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="أدخل عنوان الوجهة">
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-form-label required-field">تاريخ الطلب</label>
                                    <input type="date" class="form-control" value="2023-11-15">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">تاريخ الاستلام</label>
                                    <input type="date" class="form-control" value="2023-11-20">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">الحالة</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="requested">مطلوب</option>
                                        <option value="in_transit">قيد النقل</option>
                                        <option value="received">تم الاستلام</option>
                                        <option value="rejected">مرفوض</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reason -->
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">السبب</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="أدخل سبب الإرجاع (إن وجد)"></textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-start pt-3">
                                <button type="button" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-2"></i> حفظ طلب الإرجاع
                                </button>
                                <a href="#" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-x-circle me-2"></i> إلغاء
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

