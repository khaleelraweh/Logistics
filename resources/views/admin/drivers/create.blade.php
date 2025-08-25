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
                                                <label class="form-label" for="first_name">{{ __('driver.driver_middle_name') }}
                                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                </label>
                                                <input name="first_name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('first_name.' . $key) }}">
                                                @error('first_name.' . $key)<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="first_name">{{ __('driver.driver_last_name') }}
                                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                </label>
                                                <input name="first_name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('first_name.' . $key) }}">
                                                @error('first_name.' . $key)<span class="text-danger">{{ $message }}</span>@enderror
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
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="driver_image">{{ __('driver.driver_image') }}</label>
                                            <input type="file" class="form-control" name="driver_image" value="{{ old('driver_image') }}" id="driver_image">
                                            @error('driver_image')<span class="text-danger">{{ $message }}</span> @enderror
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
                            <div class="tab-pane" id="vehicle-information">
                                <div>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-pancard-input">PAN Card</label>
                                                <input type="text" class="form-control" id="progress-basicpill-pancard-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-vatno-input">VAT/TIN No.</label>
                                                <input type="text" class="form-control" id="progress-basicpill-vatno-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-cstno-input">CST No.</label>
                                                <input type="text" class="form-control" id="progress-basicpill-cstno-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-servicetax-input">Service Tax No.</label>
                                                <input type="text" class="form-control" id="progress-basicpill-servicetax-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-companyuin-input">Company UIN</label>
                                                <input type="text" class="form-control" id="progress-basicpill-companyuin-input">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="progress-basicpill-declaration-input">Declaration</label>
                                                <input type="text" class="form-control" id="progress-basicpill-declaration-input">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <!-- step3: License and Documentation -->
                            <div class="tab-pane" id="license-and-documentation">
                                <div>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-namecard-input">Name on Card</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-namecard-input">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label>Credit Card Type</label>
                                                    <select class="form-select">
                                                        <option selected>Select Card Type</option>
                                                        <option value="AE">American Express</option>
                                                        <option value="VI">Visa</option>
                                                        <option value="MC">MasterCard</option>
                                                        <option value="DI">Discover</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-cardno-input">Credit Card Number</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-cardno-input">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-card-verification-input">Card Verification Number</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-card-verification-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-expiration-input">Expiration Date</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-expiration-input">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- step4: Hire and Supervision -->
                            <div class="tab-pane" id="hire-and-supervision">
                                <div>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-namecard-input">Name on Card</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-namecard-input">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label>Credit Card Type</label>
                                                    <select class="form-select">
                                                        <option selected>Select Card Type</option>
                                                        <option value="AE">American Express</option>
                                                        <option value="VI">Visa</option>
                                                        <option value="MC">MasterCard</option>
                                                        <option value="DI">Discover</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-cardno-input">Credit Card Number</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-cardno-input">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-card-verification-input">Card Verification Number</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-card-verification-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="progress-basicpill-expiration-input">Expiration Date</label>
                                                    <input type="text" class="form-control" id="progress-basicpill-expiration-input">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- step5: Confirm Details -->
                            <div class="tab-pane" id="progress-confirm-detail">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                            </div>
                                            <div>
                                                <h5>Confirm Detail</h5>
                                                <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                            <li class="previous"><a href="javascript: void(0);">{{ __('general.previous') }}</a></li>
                            <li class="next"><a href="javascript: void(0);">{{ __('general.next') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

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
                            <input name="name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('name.' . $key) }}">
                            @error('name.' . $key)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="phone">{{ __('driver.phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                    @error('phone')<span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="email">{{ __('driver.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username">{{ __('driver.username') }}</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">
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
                    <input type="text" name="vehicle_type" id="vehicle_type" class="form-control" value="{{ old('vehicle_type') }}">
                    @error('vehicle_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_number">{{ __('driver.vehicle_number') }}</label>
                    <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="{{ old('vehicle_number') }}">
                    @error('vehicle_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_model">{{ __('driver.vehicle_model') }}</label>
                    <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" value="{{ old('vehicle_model') }}">
                    @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_color">{{ __('driver.vehicle_color') }}</label>
                    <input type="text" name="vehicle_color" id="vehicle_color" class="form-control" value="{{ old('vehicle_color') }}">
                    @error('vehicle_coloe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_capacity_weight">{{ __('driver.vehicle_capacity_weight') }}</label>
                    <input type="number" step="0.01" name="vehicle_capacity_weight" id="vehicle_capacity_weight" class="form-control" value="{{ old('vehicle_capacity_weight') }}">
                    @error('vehicle_capacity_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="vehicle_capacity_volume">{{ __('driver.vehicle_capacity_volume') }}</label>
                    <input type="number" step="0.01" name="vehicle_capacity_volume" id="vehicle_capacity_volume" class="form-control" value="{{ old('vehicle_capacity_volume') }}">
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
                <input type="text" name="license_number" id="license_number" class="form-control" value="{{ old('license_number') }}">
                @error('license_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="license_expiry_date">{{ __('driver.license_expiry_date') }}</label>
                <input type="date" name="license_expiry_date" id="license_expiry_date" class="form-control" value="{{ old('license_expiry_date') }}">
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
                <input type="date" name="hired_date" id="hired_date" class="form-control" value="{{ old('hired_date') }}">
                @error('hired_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="supervisor_id">{{ __('driver.supervisor_id') }}</label>
                <input type="text" name="supervisor_id" id="supervisor_id" class="form-control" value="{{ old('supervisor_id') }}">
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
                <textarea name="reason" id="tinymceExample" rows="10" class="form-control">{!! old('reason') !!}</textarea>
                @error('reason')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    <!-- زر الحفظ -->
    <div class="text-center mb-5">
        <button type="submit" class="btn btn-success px-5">{{ __('driver.save_driver_data') }}</button>
    </div>
</form>

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
@endsection
