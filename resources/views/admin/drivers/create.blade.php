@extends('layouts.admin')

@section('content')


    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('driver.add_driver') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">{{ __('driver.manage_drivers') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('driver.add_driver') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div id="progrss-wizard" class="twitter-bs-wizard">
                        <ul class="twitter-bs-wizard-nav nav-justified">
                            <li class="nav-item">
                                <a href="#driver-information" class="nav-link" data-toggle="tab">
                                    <span class="step-number"> <i class="mdi mdi-account-tie" style="font-size: 1.4rem;"></i> </span>
                                    <span class="step-title">{{ __('driver.driver_info') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#vehicle-information" class="nav-link" data-toggle="tab">
                                    <span class="step-number"> <i class="mdi mdi-train-car" style="font-size: 1.4rem;"></i></span>
                                    <span class="step-title">{{ __('driver.vehicle_info') }}</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#license-and-documentation" class="nav-link" data-toggle="tab">
                                    <span class="step-number"><i class="mdi mdi-license" style="font-size: 1.4rem;"></i></span>
                                    <span class="step-title">{{ __('driver.license_and_documentation') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#hire-and-supervision" class="nav-link" data-toggle="tab">
                                    <span class="step-number"><i class="mdi mdi-account-supervisor" style="font-size: 1.4rem;"></i></span>
                                    <span class="step-title">{{ __('driver.hire_and_supervision') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                    <span class="step-number"><i class="fas fa-check-circle" ></i></span>
                                    <span class="step-title">{{ __('driver.confirm_details') }}</span>
                                </a>
                            </li>
                        </ul>

                        <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="bar" class="progress mt-4">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                            </div>
                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <!-- step1: Driver Information -->
                                <div class="tab-pane" id="driver-information">

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-info-circle text-primary"></i>
                                        </div>
                                        <h5 class="mb-0">{{ __('driver.driver_info') }}</h5>
                                    </div>

                                    @foreach (config('locales.languages') as $key => $val)
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="first_name">{{ __('driver.driver_first_name') }}
                                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                    </label>
                                                    <input name="first_name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('first_name.' . $key) }}">
                                                    @error('first_name.' . $key)<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="middle_name">{{ __('driver.driver_middle_name') }}
                                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                    </label>
                                                    <input name="middle_name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('middle_name.' . $key) }}">
                                                    @error('middle_name.' . $key)<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="last_name">{{ __('driver.driver_last_name') }}
                                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                    </label>
                                                    <input name="last_name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('last_name.' . $key) }}">
                                                    @error('last_name.' . $key)<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone">{{ __('driver.phone') }}</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="phone">
                                                @error('phone')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">{{ __('driver.email') }}</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                                                @error('email')<span class="text-danger">{{ $message }}</span> @enderror

                                            </div>
                                        </div>
                                    </div>



                                    <div class="mb-5"></div>

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-geo-alt text-primary"></i>
                                        </div>
                                        <h5 class="mb-0">{{ __('general.address_details') }}</h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="country">{{ __('driver.country') }}</label>
                                                <input type="text" class="form-control" name="country" value="{{ old('country') }}" id="country">
                                                @error('country')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="region">{{ __('driver.region') }}</label>
                                                <input type="text" class="form-control" name="region" value="{{ old('region') }}" id="region">
                                                @error('region')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="city">{{ __('driver.city') }}</label>
                                                <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="city">
                                                @error('city')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="district">{{ __('driver.district') }}</label>
                                                <input type="text" class="form-control" name="district" value="{{ old('district') }}" id="district">
                                                @error('district')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5"></div>

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-geo-alt text-primary"></i>
                                        </div>
                                        <h5 class="mb-0">{{ __('general.location') }}</h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="latitude">{{ __('driver.latitude') }}</label>
                                                <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" id="latitude">
                                                @error('latitude')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="longitude">{{ __('driver.longitude') }}</label>
                                                <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" id="longitude">
                                                @error('longitude')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="map" style="width: 100%; height: 300px;"></div>
                                        </div>
                                    </div>


                                </div>
                                <!-- step2: Vehicle Information -->
                                {{-- <div class="tab-pane" id="vehicle-information">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_type">{{ __('driver.vehicle_type') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_type" value="{{ old('vehicle_type') }}" placeholder="{{ __('driver.vehicle_type') }}" id="vehicle_type">
                                                    @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_model">{{ __('driver.vehicle_model') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_model" value="{{ old('vehicle_model') }}" placeholder="{{ __('driver.vehicle_model') }}" id="vehicle_model">
                                                    @error('vehicle_model')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_number">{{ __('driver.vehicle_number') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="{{ __('driver.vehicle_number') }}" id="vehicle_number">
                                                    @error('vehicle_number')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_color">{{ __('driver.vehicle_color') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_color" value="{{ old('vehicle_color') }}" placeholder="{{ __('driver.vehicle_color') }}" id="vehicle_color">
                                                    @error('vehicle_color')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_capacity_weight">{{ __('driver.vehicle_capacity_weight') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_capacity_weight" value="{{ old('vehicle_capacity_weight') }}" placeholder="{{ __('driver.vehicle_capacity_weight') }}" id="vehicle_capacity_weight">
                                                    @error('vehicle_capacity_weight')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_capacity_volume">{{ __('driver.vehicle_capacity_volume') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_capacity_volume" value="{{ old('vehicle_capacity_volume') }}" placeholder="{{ __('driver.vehicle_capacity_volume') }}" id="vehicle_capacity_volume">
                                                    @error('vehicle_capacity_volume')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_image">{{ __('driver.vehicle_image') }}</label>
                                                    <input type="file" class="form-control" name="vehicle_image" value="{{ old('vehicle_image') }}" placeholder="{{ __('driver.vehicle_image') }}" id="vehicle_image">
                                                    @error('vehicle_image')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- step2: Vehicle Information -->
                                <div class="tab-pane" id="vehicle-information">
                                    <div>
                                        <div class="row">
                                            <!-- vehicle_type -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_type">{{ __('driver.vehicle_type') }}</label>
                                                    <select class="form-select select2" name="vehicle_type" id="vehicle_type">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>{{ __('driver.vehicle_type_car') }}</option>
                                                        <option value="van" {{ old('vehicle_type') == 'van' ? 'selected' : '' }}>{{ __('driver.vehicle_type_van') }}</option>
                                                        <option value="small_truck" {{ old('vehicle_type') == 'small_truck' ? 'selected' : '' }}>{{ __('driver.vehicle_type_small_truck') }}</option>
                                                        <option value="big_truck" {{ old('vehicle_type') == 'big_truck' ? 'selected' : '' }}>{{ __('driver.vehicle_type_big_truck') }}</option>
                                                        <option value="motorcycle" {{ old('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>{{ __('driver.vehicle_type_motorcycle') }}</option>
                                                        <option value="other" {{ old('vehicle_type') == 'other' ? 'selected' : '' }}>{{ __('general.other') }}</option>
                                                    </select>
                                                    @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- vehicle_model -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_model">{{ __('driver.vehicle_model') }}</label>
                                                    <select class="form-select select2" name="vehicle_model" id="vehicle_model">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        <option value="toyota" {{ old('vehicle_model') == 'toyota' ? 'selected' : '' }}>{{ __('driver.vehicle_model_toyota') }}</option>
                                                        <option value="nissan" {{ old('vehicle_model') == 'nissan' ? 'selected' : '' }}>{{ __('driver.vehicle_model_nissan') }}</option>
                                                        <option value="ford" {{ old('vehicle_model') == 'ford' ? 'selected' : '' }}>{{ __('driver.vehicle_model_ford') }}</option>
                                                        <option value="mercedes" {{ old('vehicle_model') == 'mercedes' ? 'selected' : '' }}>{{ __('driver.vehicle_model_mercedes') }}</option>
                                                        <option value="other" {{ old('vehicle_model') == 'other' ? 'selected' : '' }}>{{ __('general.other') }}</option>
                                                    </select>
                                                    @error('vehicle_model')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- vehicle_number -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_number">{{ __('driver.vehicle_number') }}</label>
                                                    <input type="text" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="{{ __('driver.vehicle_number') }}" id="vehicle_number">
                                                    @error('vehicle_number')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- vehicle_color -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_color">{{ __('driver.vehicle_color') }}</label>
                                                    <select class="form-select select2" name="vehicle_color" id="vehicle_color">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        <option value="white" {{ old('vehicle_color') == 'white' ? 'selected' : '' }}>{{ __('driver.vehicle_color_white') }}</option>
                                                        <option value="black" {{ old('vehicle_color') == 'black' ? 'selected' : '' }}>{{ __('driver.vehicle_color_black') }}</option>
                                                        <option value="silver" {{ old('vehicle_color') == 'silver' ? 'selected' : '' }}>{{ __('driver.vehicle_color_silver') }}</option>
                                                        <option value="red" {{ old('vehicle_color') == 'red' ? 'selected' : '' }}>{{ __('driver.vehicle_color_red') }}</option>
                                                        <option value="blue" {{ old('vehicle_color') == 'blue' ? 'selected' : '' }}>{{ __('driver.vehicle_color_blue') }}</option>
                                                        <option value="green" {{ old('vehicle_color') == 'green' ? 'selected' : '' }}>{{ __('driver.vehicle_color_green') }}</option>
                                                        <option value="gray" {{ old('vehicle_color') == 'gray' ? 'selected' : '' }}>{{ __('driver.vehicle_color_gray') }}</option>
                                                        <option value="other" {{ old('vehicle_color') == 'other' ? 'selected' : '' }}>{{ __('general.other') }}</option>
                                                    </select>
                                                    @error('vehicle_color')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- vehicle_capacity_weight -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_capacity_weight">{{ __('driver.vehicle_capacity_weight') }}</label>
                                                    <select class="form-select select2" name="vehicle_capacity_weight" id="vehicle_capacity_weight">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        <option value="lt1" {{ old('vehicle_capacity_weight') == 'lt1' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_weight_lt1') }}</option>
                                                        <option value="1to3" {{ old('vehicle_capacity_weight') == '1to3' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_weight_1to3') }}</option>
                                                        <option value="3to7" {{ old('vehicle_capacity_weight') == '3to7' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_weight_3to7') }}</option>
                                                        <option value="gt7" {{ old('vehicle_capacity_weight') == 'gt7' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_weight_gt7') }}</option>
                                                    </select>
                                                    @error('vehicle_capacity_weight')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <!-- vehicle_capacity_volume -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_capacity_volume">{{ __('driver.vehicle_capacity_volume') }}</label>
                                                    <select class="form-select select2" name="vehicle_capacity_volume" id="vehicle_capacity_volume">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        <option value="small" {{ old('vehicle_capacity_volume') == 'small' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_volume_small') }}</option>
                                                        <option value="medium" {{ old('vehicle_capacity_volume') == 'medium' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_volume_medium') }}</option>
                                                        <option value="large" {{ old('vehicle_capacity_volume') == 'large' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_volume_large') }}</option>
                                                        <option value="huge" {{ old('vehicle_capacity_volume') == 'huge' ? 'selected' : '' }}>{{ __('driver.vehicle_capacity_volume_huge') }}</option>
                                                    </select>
                                                    @error('vehicle_capacity_volume')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <!-- step3: License and Documentation -->
                                <div class="tab-pane" id="license-and-documentation">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="license_number">{{ __('driver.license_number') }}</label>
                                                    <input type="text" class="form-control" name="license_number" value="{{ old('license_number') }}" placeholder="{{ __('driver.license_number') }}" id="license_number">
                                                    @error('license_number')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="license_expiry_date">{{ __('driver.license_expiry_date') }}</label>
                                                    <input type="date" class="form-control" name="license_expiry_date" value="{{ old('license_expiry_date') }}" placeholder="{{ __('driver.license_expiry_date') }}" id="license_expiry_date">
                                                    @error('license_expiry_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="license_image">{{ __('driver.license_image') }}</label>
                                                    <input type="file" class="form-control" name="license_image" value="{{ old('license_image') }}" placeholder="{{ __('driver.license_image') }}" id="license_image">
                                                    @error('license_image')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <!-- vehicle_image -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_image">{{ __('driver.vehicle_image') }}</label>
                                                    <input type="file" class="form-control" name="vehicle_image" id="vehicle_image">
                                                    @error('vehicle_image')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="driver_image">{{ __('driver.driver_image') }}</label>
                                                    <input type="file" class="form-control" name="driver_image" value="{{ old('driver_image') }}" id="driver_image">
                                                    @error('driver_image')<span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="id_card_image">{{ __('driver.id_card_image') }}</label>
                                                    <input type="file" class="form-control" name="id_card_image" value="{{ old('id_card_image') }}" placeholder="{{ __('driver.id_card_image') }}" id="id_card_image">
                                                    @error('id_card_image')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- step4: Hire and Supervision -->
                                <div class="tab-pane" id="hire-and-supervision">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">{{ __('driver.username') }}</label>
                                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="{{ __('driver.username') }}" id="username">
                                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="password">{{ __('driver.password') }}</label>
                                                    <input type="text" class="form-control" name="password" value="{{ old('password') }}" placeholder="{{ __('driver.password') }}" id="password">
                                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="hired_date">{{ __('driver.hired_date') }}</label>
                                                    <input type="date" class="form-control" name="hired_date" value="{{ old('hired_date') }}" placeholder="{{ __('driver.hired_date') }}" id="hired_date">
                                                    @error('hired_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="supervisor_id">{{ __('driver.supervisor_id') }}</label>
                                                       <select name="supervisor_id" class="form-select select2">
                                                        <option value="">{{ __('general.select') }}</option>
                                                        @forelse ($supervisors as $supervisor)
                                                            <option value="{{ $supervisor->id }}"
                                                                {{ old('supervisor_id') == $supervisor->id ? 'selected' : '' }}>
                                                                {{ $supervisor->first_name }} {{ $supervisor->last_name }}  {{ $supervisor->email }}
                                                            </option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @error('supervisor_id')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="availability_status">{{ __('driver.availability_status') }}</label>
                                                    <select name="availability_status" class="form-select select2" required>
                                                        <option value="available">{{ __('driver.available') }}</option>
                                                        <option value="busy">{{ __('driver.busy') }}</option>
                                                        <option value="offline">{{ __('driver.offline') }}</option>
                                                    </select>
                                                    @error('availability_status')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="status">{{ __('driver.status') }}</label>
                                                    <select name="status" class="form-select select2" required>
                                                        <option value="active">{{ __('driver.status_active') }}</option>
                                                        <option value="inactive">{{ __('driver.status_inactive') }}</option>
                                                        <option value="suspended">{{ __('driver.status_suspended') }}</option>
                                                        <option value="terminated">{{ __('driver.status_terminated') }}</option>
                                                    </select>
                                                    @error('availability_status')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="reason">{{ __('driver.reason') }}</label>
                                                    <textarea name="reason" id="tinymceExample" rows="10" class="form-control">{!! old('reason') !!}</textarea>
                                                    @error('reason')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- step5: Confirm Details -->
                                {{-- <div class="tab-pane" id="progress-confirm-detail">
                                    <div>



                                        <!-- Submit Button -->
                                        <div class="text-end pt-3">
                                            @ability('admin', 'create_driver')
                                                <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                                    <i class="ri-save-3-line me-2"></i>
                                                    <i class="bi bi-save me-2"></i>
                                                    {{ __('driver.save_driver_data') }}
                                                </button>
                                            @endability

                                            <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-danger ms-2">
                                                <i class="ri-arrow-go-back-line me-1"></i>
                                                {{ __('panel.cancel') }}
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- step5: Confirm Details -->
<div class="tab-pane" id="progress-confirm-detail">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-check-circle text-success me-2"></i>{{ __('driver.review_driver_info') }}</h5>
                </div>
                <div class="card-body">

                    <!-- Personal Information -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 text-primary">
                            <i class="mdi mdi-account-tie me-1"></i> {{ __('driver.driver_info') }}
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_first_name') }} <i class="flag-icon flag-icon-sa"></i> :</strong> <span id="review_first_name_ar">{{ old('first_name.ar') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_middle_name') }} <i class="flag-icon flag-icon-sa"></i>:</strong> <span id="review_middle_name_ar">{{ old('middle_name.ar') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_last_name') }} <i class="flag-icon flag-icon-sa"></i> :</strong> <span id="review_last_name_ar">{{ old('last_name.ar') }}</span></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_first_name') }} <i class="flag-icon flag-icon-us"></i> :</strong> <span id="review_first_name_en">{{ old('first_name.en') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_middle_name') }} <i class="flag-icon flag-icon-us"></i>:</strong> <span id="review_middle_name_en">{{ old('middle_name.en') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.driver_last_name') }} <i class="flag-icon flag-icon-us"></i> :</strong> <span id="review_last_name_en">{{ old('last_name.en') }}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.phone') }}:</strong> <span id="review_phone">{{ old('phone') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.email') }}:</strong> <span id="review_email">{{ old('email') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 text-primary">
                            <i class="mdi mdi-map-marker me-1"></i> {{ __('general.address_details') }}
                        </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>{{ __('driver.country') }}:</strong> <span id="review_country">{{ old('country') }}</span></p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>{{ __('driver.region') }}:</strong> <span id="review_region">{{ old('region') }}</span></p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>{{ __('driver.city') }}:</strong> <span id="review_city">{{ old('city') }}</span></p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>{{ __('driver.district') }}:</strong> <span id="review_district">{{ old('district') }}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.latitude') }}:</strong> <span id="review_latitude">{{ old('latitude') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.longitude') }}:</strong> <span id="review_longitude">{{ old('longitude') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 text-primary">
                            <i class="mdi mdi-car me-1"></i> {{ __('driver.vehicle_info') }}
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_type') }}:</strong> <span id="review_vehicle_type">{{ old('vehicle_type') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_model') }}:</strong> <span id="review_vehicle_model">{{ old('vehicle_model') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_number') }}:</strong> <span id="review_vehicle_number">{{ old('vehicle_number') }}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_color') }}:</strong> <span id="review_vehicle_color">{{ old('vehicle_color') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_capacity_weight') }}:</strong> <span id="review_vehicle_capacity_weight">{{ old('vehicle_capacity_weight') }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_capacity_volume') }}:</strong> <span id="review_vehicle_capacity_volume">{{ old('vehicle_capacity_volume') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- License and Documents -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 text-primary">
                            <i class="mdi mdi-file-document me-1"></i> {{ __('driver.license_and_documentation') }}
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.license_number') }}:</strong> <span id="review_license_number">{{ old('license_number') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.license_expiry_date') }}:</strong> <span id="review_license_expiry_date">{{ old('license_expiry_date') }}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.license_image') }}:</strong>
                                    <span id="review_license_image">
                                        @if(old('license_image'))
                                            {{ __('general.file_uploaded') }}
                                        @else
                                            {{ __('general.no_file') }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>{{ __('driver.vehicle_image') }}:</strong>
                                    <span id="review_vehicle_image">
                                        @if(old('vehicle_image'))
                                            {{ __('general.file_uploaded') }}
                                        @else
                                            {{ __('general.no_file') }}
                                        @endif
                                    </span>
                                </p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.driver_image') }}:</strong>
                                    <span id="review_driver_image">
                                        @if(old('driver_image'))
                                            {{ __('general.file_uploaded') }}
                                        @else
                                            {{ __('general.no_file') }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.id_card_image') }}:</strong>
                                    <span id="review_id_card_image">
                                        @if(old('id_card_image'))
                                            {{ __('general.file_uploaded') }}
                                        @else
                                            {{ __('general.no_file') }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 text-primary">
                            <i class="mdi mdi-briefcase me-1"></i> {{ __('driver.hire_and_supervision') }}
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.username') }}:</strong> <span id="review_username">{{ old('username') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.password') }}:</strong>
                                    <span id="review_password">
                                        @if(old('password'))
                                            ••••••••
                                        @else
                                            {{ __('general.not_set') }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.hired_date') }}:</strong> <span id="review_hired_date">{{ old('hired_date') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.supervisor_id') }}:</strong> <span id="review_supervisor_id">
                                    @if(old('supervisor_id') && $supervisors->contains('id', old('supervisor_id')))
                                        {{ $supervisors->find(old('supervisor_id'))->first_name }} {{ $supervisors->find(old('supervisor_id'))->last_name }}
                                    @else
                                        {{ __('general.not_set') }}
                                    @endif
                                </span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.availability_status') }}:</strong> <span id="review_availability_status">{{ old('availability_status') }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('driver.status') }}:</strong> <span id="review_status">{{ old('status') }}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><strong>{{ __('driver.reason') }}:</strong></p>
                                <div id="review_reason" class="border p-2 rounded bg-light">
                                    {!! nl2br(old('reason')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="text-end pt-3">
        @ability('admin', 'create_driver')
            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                <i class="ri-save-3-line me-2"></i>
                <i class="bi bi-save me-2"></i>
                {{ __('driver.save_driver_data') }}
            </button>
        @endability

        <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-danger ms-2">
            <i class="ri-arrow-go-back-line me-1"></i>
            {{ __('panel.cancel') }}
        </a>
    </div>
</div>


                            </div>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="previous"><a href="javascript: void(0);">{{ __('general.previous') }}</a></li>
                                <li class="next"><a href="javascript: void(0);">{{ __('general.next') }}</a></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- Call select2 plugin --}}

    <script>
        $(function() {
            $("#driver_image").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });

            $("#vehicle_image").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });

            $("#license_image").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });

            $("#id_card_image").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });
        });
    </script>

    <!-- تضمين مكتبة Leaflet CSS و JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // دالة لتحديث الحقول من خط الطول والعرض
        function updateFieldsFromLatLng(lat, lng){
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    if(data.address){
                        document.getElementById('country').value = data.address.country || '';
                        document.getElementById('region').value = data.address.state || '';
                        document.getElementById('city').value = data.address.city || data.address.town || data.address.village || '';
                        document.getElementById('district').value = data.address.suburb || '';
                        document.getElementById('postal_code').value = data.address.postcode || '';
                    }
                });
        }

        // إحداثيات البداية: إذا موجودة من الـ old أو من التاجر، وإلا وسط الرياض
        var initialLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
        var initialLng = parseFloat(document.getElementById('longitude').value) || 46.6753;

        // إنشاء الخريطة
        var map = L.map('map').setView([initialLat, initialLng], 13);

        // إضافة طبقة OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // إنشاء العلامة القابلة للسحب
        var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

        // تحديث الحقول عند تحريك العلامة
        marker.on('dragend', function(e) {
            var latlng = marker.getLatLng();
            document.getElementById('latitude').value = latlng.lat.toFixed(7);
            document.getElementById('longitude').value = latlng.lng.toFixed(7);
            updateFieldsFromLatLng(latlng.lat, latlng.lng);
        });

        // تحديث العلامة عند النقر على الخريطة
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(7);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(7);
            updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
        });

        // تعبئة الحقول لأول مرة عند التحميل إذا كانت الإحداثيات موجودة
        if(initialLat && initialLng){
            updateFieldsFromLatLng(initialLat, initialLng);
        }

    });
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // دالة لتحديث معاينة البيانات
        function updateReview() {
            // معلومات السائق
            document.getElementById('review_first_name_ar').textContent = document.querySelector('[name="first_name[ar]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_middle_name_ar').textContent = document.querySelector('[name="middle_name[ar]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_last_name_ar').textContent = document.querySelector('[name="last_name[ar]"]').value || '{{ __("general.not_set") }}';

            document.getElementById('review_first_name_en').textContent = document.querySelector('[name="first_name[en]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_middle_name_en').textContent = document.querySelector('[name="middle_name[en]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_last_name_en').textContent = document.querySelector('[name="last_name[en]"]').value || '{{ __("general.not_set") }}';

            document.getElementById('review_phone').textContent = document.querySelector('[name="phone"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_email').textContent = document.querySelector('[name="email"]').value || '{{ __("general.not_set") }}';

            // العنوان
            document.getElementById('review_country').textContent = document.querySelector('[name="country"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_region').textContent = document.querySelector('[name="region"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_city').textContent = document.querySelector('[name="city"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_district').textContent = document.querySelector('[name="district"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_latitude').textContent = document.querySelector('[name="latitude"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_longitude').textContent = document.querySelector('[name="longitude"]').value || '{{ __("general.not_set") }}';

            // المركبة
            document.getElementById('review_vehicle_type').textContent = document.querySelector('[name="vehicle_type"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_model').textContent = document.querySelector('[name="vehicle_model"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_number').textContent = document.querySelector('[name="vehicle_number"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_color').textContent = document.querySelector('[name="vehicle_color"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_capacity_weight').textContent = document.querySelector('[name="vehicle_capacity_weight"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_capacity_volume').textContent = document.querySelector('[name="vehicle_capacity_volume"]').value || '{{ __("general.not_set") }}';

            // الرخصة والمستندات
            document.getElementById('review_license_number').textContent = document.querySelector('[name="license_number"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_license_expiry_date').textContent = document.querySelector('[name="license_expiry_date"]').value || '{{ __("general.not_set") }}';

            // التوظيف
            document.getElementById('review_username').textContent = document.querySelector('[name="username"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_hired_date').textContent = document.querySelector('[name="hired_date"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_availability_status').textContent = document.querySelector('[name="availability_status"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_status').textContent = document.querySelector('[name="status"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_reason').innerHTML = document.querySelector('[name="reason"]').value ? nl2br(document.querySelector('[name="reason"]').value) : '{{ __("general.not_set") }}';
        }

        // تحديث المعاينة عند الانتقال إلى الخطوة الخامسة
        document.querySelector('a[href="#progress-confirm-detail"]').addEventListener('click', function() {
            updateReview();
        });
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // دالة لتحديث معاينة البيانات
        function updateReview() {
            // معلومات السائق - جلب القيم الحالية من الحقول
            document.getElementById('review_first_name_ar').textContent = document.querySelector('[name="first_name[ar]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_middle_name_ar').textContent = document.querySelector('[name="middle_name[ar]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_last_name_ar').textContent = document.querySelector('[name="last_name[ar]"]').value || '{{ __("general.not_set") }}';

            document.getElementById('review_first_name_en').textContent = document.querySelector('[name="first_name[en]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_middle_name_en').textContent = document.querySelector('[name="middle_name[en]"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_last_name_en').textContent = document.querySelector('[name="last_name[en]"]').value || '{{ __("general.not_set") }}';

            document.getElementById('review_phone').textContent = document.querySelector('[name="phone"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_email').textContent = document.querySelector('[name="email"]').value || '{{ __("general.not_set") }}';

            // العنوان
            document.getElementById('review_country').textContent = document.querySelector('[name="country"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_region').textContent = document.querySelector('[name="region"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_city').textContent = document.querySelector('[name="city"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_district').textContent = document.querySelector('[name="district"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_latitude').textContent = document.querySelector('[name="latitude"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_longitude').textContent = document.querySelector('[name="longitude"]').value || '{{ __("general.not_set") }}';

            // المركبة
            document.getElementById('review_vehicle_type').textContent = document.querySelector('[name="vehicle_type"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_model').textContent = document.querySelector('[name="vehicle_model"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_number').textContent = document.querySelector('[name="vehicle_number"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_color').textContent = document.querySelector('[name="vehicle_color"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_capacity_weight').textContent = document.querySelector('[name="vehicle_capacity_weight"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_vehicle_capacity_volume').textContent = document.querySelector('[name="vehicle_capacity_volume"]').value || '{{ __("general.not_set") }}';

            // الرخصة والمستندات
            document.getElementById('review_license_number').textContent = document.querySelector('[name="license_number"]').value || '{{ __("general.not_set") }}';
            document.getElementById('review_license_expiry_date').textContent = document.querySelector('[name="license_expiry_date"]').value || '{{ __("general.not_set") }}';

            // معالجة خاصة لحقول SELECT للحصول على النص المعروض وليس القيمة
            var vehicleTypeSelect = document.querySelector('[name="vehicle_type"]');
            document.getElementById('review_vehicle_type').textContent = vehicleTypeSelect.options[vehicleTypeSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var vehicleModelSelect = document.querySelector('[name="vehicle_model"]');
            document.getElementById('review_vehicle_model').textContent = vehicleModelSelect.options[vehicleModelSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var vehicleColorSelect = document.querySelector('[name="vehicle_color"]');
            document.getElementById('review_vehicle_color').textContent = vehicleColorSelect.options[vehicleColorSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var capacityWeightSelect = document.querySelector('[name="vehicle_capacity_weight"]');
            document.getElementById('review_vehicle_capacity_weight').textContent = capacityWeightSelect.options[capacityWeightSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var capacityVolumeSelect = document.querySelector('[name="vehicle_capacity_volume"]');
            document.getElementById('review_vehicle_capacity_volume').textContent = capacityVolumeSelect.options[capacityVolumeSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            // التوظيف
            document.getElementById('review_username').textContent = document.querySelector('[name="username"]').value || '{{ __("general.not_set") }}';

            // كلمة المرور - إظهار النجوم إذا كانت هناك قيمة
            var passwordField = document.querySelector('[name="password"]');
            document.getElementById('review_password').textContent = passwordField.value ? '••••••••' : '{{ __("general.not_set") }}';

            document.getElementById('review_hired_date').textContent = document.querySelector('[name="hired_date"]').value || '{{ __("general.not_set") }}';

            // المشرف - الحصول على النص المعروض
            var supervisorSelect = document.querySelector('[name="supervisor_id"]');
            document.getElementById('review_supervisor_id').textContent = supervisorSelect.options[supervisorSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var availabilitySelect = document.querySelector('[name="availability_status"]');
            document.getElementById('review_availability_status').textContent = availabilitySelect.options[availabilitySelect.selectedIndex].text || '{{ __("general.not_set") }}';

            var statusSelect = document.querySelector('[name="status"]');
            document.getElementById('review_status').textContent = statusSelect.options[statusSelect.selectedIndex].text || '{{ __("general.not_set") }}';

            document.getElementById('review_reason').innerHTML = document.querySelector('[name="reason"]').value ? nl2br(document.querySelector('[name="reason"]').value) : '{{ __("general.not_set") }}';

            // الملفات - التحقق إذا تم اختيار ملف
            var licenseImage = document.querySelector('[name="license_image"]');
            document.getElementById('review_license_image').textContent = licenseImage.files.length > 0 ? '{{ __("general.file_uploaded") }}' : '{{ __("general.no_file") }}';

            var idCardImage = document.querySelector('[name="id_card_image"]');
            document.getElementById('review_id_card_image').textContent = idCardImage.files.length > 0 ? '{{ __("general.file_uploaded") }}' : '{{ __("general.no_file") }}';

            var driverImage = document.querySelector('[name="driver_image"]');
            document.getElementById('review_driver_image').textContent = driverImage.files.length > 0 ? '{{ __("general.file_uploaded") }}' : '{{ __("general.no_file") }}';

            var vehicleImage = document.querySelector('[name="vehicle_image"]');
            document.getElementById('review_vehicle_image').textContent = vehicleImage.files.length > 0 ? '{{ __("general.file_uploaded") }}' : '{{ __("general.no_file") }}';
        }

        // تحديث المعاينة عند الانتقال إلى الخطوة الخامسة
        document.querySelector('a[href="#progress-confirm-detail"]').addEventListener('click', function() {
            updateReview();
        });
    });
</script>
@endsection


