@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('driver.manage_drivers') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('driver.edit_driver') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('driver.manage_drivers') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



<form action="{{ route('admin.drivers.update',$driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

    <div class="row">
        <!-- بيانات السائق -->
        <div class="col-md-6">
            <div class="card p-3 mb-4">
                <h5 class="mb-3">{{ __('driver.driver_info') }}</h5>

                @foreach (config('locales.languages') as $key => $val)
                    <div class="row mb-3">

                        <div class="col-sm-12">
                            <label for="name">
                                {{ __('driver.name') }}
                                <span class="language-type">
                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                        title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                    {{ __('language.' . $key) }}
                                </span>
                            </label>
                            <input name="name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('name.' . $key , $driver->getTranslation('name',$key)) }}">
                            @error('name.' . $key)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="phone">{{ __('driver.phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone' , $driver->phone) }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">{{ __('driver.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email' , $driver->email) }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username">{{ __('driver.username') }}</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username' , $driver->username) }}">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">{{ __('driver.password') }}</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="driver_image">{{ __('driver.driver_image') }}</label>
                    <input type="file" name="driver_image" id="driver_image" value="{{ old('driver_image') }}" class="file-input-overview ">
                    @error('driver_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- بيانات المركبة -->
        <div class="col-md-6">
            <div class="card p-3 mb-4">
                <h5 class="mb-3">{{ __('driver.vehicle_data') }}</h5>

                <div class="mb-3">
                    <label for="vehicle_type">{{ __('driver.vehicle_type') }}</label>
                    <input type="text" name="vehicle_type" id="vehicle_type" class="form-control" value="{{ old('vehicle_type' , $driver->vehicle_type) }}">
                    @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_number">{{ __('driver.vehicle_number') }}</label>
                    <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="{{ old('vehicle_number' , $driver->vehicle_number) }}">
                    @error('vehicle_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_model">{{ __('driver.vehicle_model') }}</label>
                    <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" value="{{ old('vehicle_model' , $driver->vehicle_model) }}">
                    @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_color">{{ __('driver.vehicle_color') }}</label>
                    <input type="text" name="vehicle_color" id="vehicle_color" class="form-control" value="{{ old('vehicle_color' , $driver->vehicle_color) }}">
                    @error('vehicle_coloe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_capacity_weight">{{ __('driver.vehicle_capacity_weight') }}</label>
                    <input type="number" step="0.01" name="vehicle_capacity_weight" id="vehicle_capacity_weight" class="form-control" value="{{ old('vehicle_capacity_weight',$driver->vehicle_capacity_weight) }}">
                    @error('vehicle_capacity_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_capacity_volume">{{ __('driver.vehicle_capacity_volume') }}</label>
                    <input type="number" step="0.01" name="vehicle_capacity_volume" id="vehicle_capacity_volume" class="form-control" value="{{ old('vehicle_capacity_volume' , $driver->vehicle_capacity_volume) }}">
                    @error('vehicle_capacity_volume')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_image">{{ __('driver.vehicle_image') }}</label>
                    <input type="file" name="vehicle_image" id="vehicle_image" class="file-input-overview ">
                    @error('vehicle_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>


    <!-- بيانات التراخيص والمستندات -->
    <div class="card p-3 mb-4">
        <h5 class="mb-3">{{ __('driver.license_and_documentation') }}</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="license_number">{{ __('driver.license_number') }}</label>
                <input type="text" name="license_number" id="license_number" class="form-control" value="{{ old('license_number' , $driver->license_number) }}">
                @error('license_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="license_expiry_date">{{ __('driver.license_expiry_date') }}</label>
                <input type="date" name="license_expiry_date" id="license_expiry_date" class="form-control" value="{{ old('license_expiry_date' , $driver->license_expiry_date) }}">
                @error('license_expiry_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="license_image">{{ __('driver.license_image') }}</label>
                <input type="file" name="license_image" id="license_image" value="{{ old('license_image') }}" class="file-input-overview ">
                @error('license_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_card_image">{{ __('driver.id_card_image') }}</label>
                <input type="file" name="id_card_image" id="id_card_image" class="file-input-overview ">
                @error('id_card_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <hr>

    <!-- بيانات التوظيف والإشراف -->
    <div class="card p-3 mb-4">
        <h5 class="mb-3">{{ __('driver.hire_and_supervision') }}</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="hired_date">{{ __('driver.hired_date') }}</label>
                <input type="date" name="hired_date" id="hired_date" class="form-control" value="{{ old('hired_date' , $driver->hired_date) }}">
                @error('hired_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="supervisor_id">{{ __('driver.supervisor_id') }}</label>
                <input type="text" name="supervisor_id" id="supervisor_id" class="form-control" value="{{ old('supervisor_id' , $driver->supervisor_id) }}">
                @error('supervisor_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <hr>

    <!-- الحالة -->
    <div class="card p-3 mb-4">
        <h5 class="mb-3">{{ __('driver.status') }}</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="availability_status">{{ __('driver.availability_status') }}</label>
                <select name="availability_status" class="form-select" required>
                    <option value="available">{{ __('driver.available') }}</option>
                    <option value="busy">{{ __('driver.busy') }}</option>
                    <option value="offline">{{ __('driver.offline') }}</option>
                </select>
                @error('availability_status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="status">{{ __('driver.status') }}</label>
                <select name="status" class="form-select" required>
                    <option value="active">{{ __('driver.status_active') }}</option>
                    <option value="inactive">{{ __('driver.status_inactive') }}</option>
                    <option value="suspended">{{ __('driver.status_suspended') }}</option>
                    <option value="terminated">{{ __('driver.status_terminated') }}</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="reason">{{ __('driver.reason') }}</label>
                <textarea name="reason" id="tinymceExample" rows="10" class="form-control">{!! old('reason' , $driver->reason) !!}</textarea>
                @error('reason')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    <!-- زر الحفظ -->
    <div class="text-center mb-5">
        <button type="submit" class="btn btn-success px-5">{{ __('driver.update_driver_data') }}</button>
    </div>
</form>

@endsection

@section('script')
    {{-- Call select2 plugin --}}

    <script>
        $(function() {
            $("#driver_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($driver->driver_image != '')
                        "{{ asset('assets/drivers/' . $driver->driver_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($driver->driver_image != '')
                        {
                            caption: "{{ $driver->driver_image }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.drivers.remove_driver_image', ['driver_id' => $driver->id, '_token' => csrf_token()]) }}",
                            key: {{ $driver->id }}
                        }
                    @endif
                ]
            });

            $("#vehicle_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($driver->vehicle_image != '')
                        "{{ asset('assets/drivers/' . $driver->vehicle_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($driver->vehicle_image != '')
                        {
                            caption: "{{ $driver->vehicle_image }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.drivers.remove_vehicle_image', ['driver_id' => $driver->id, '_token' => csrf_token()]) }}",
                            key: {{ $driver->id }}
                        }
                    @endif
                ]
            });

            $("#license_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($driver->license_image != '')
                        "{{ asset('assets/drivers/' . $driver->license_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($driver->license_image != '')
                        {
                            caption: "{{ $driver->license_image }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.drivers.remove_license_image', ['driver_id' => $driver->id, '_token' => csrf_token()]) }}",
                            key: {{ $driver->id }}
                        }
                    @endif
                ]
            });

            $("#id_card_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($driver->id_card_image != '')
                        "{{ asset('assets/drivers/' . $driver->id_card_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($driver->id_card_image != '')
                        {
                            caption: "{{ $driver->id_card_image }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.drivers.remove_id_card_image', ['driver_id' => $driver->id, '_token' => csrf_token()]) }}",
                            key: {{ $driver->id }}
                        }
                    @endif
                ]
            });
        });
    </script>
@endsection
