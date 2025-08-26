@extends('layouts.admin')

@section('content')



<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('driver.manage_drivers') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">{{ __('driver.drivers') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- drivers list -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="card-head d-flex justify-content-between">
                    <div class="head">
                        <h4 class="card-title"><i class="fas fa-eye"></i> {{ __('driver.driver_data') }}</h4>
                        <p class="card-title-desc">{{ __('driver.driver_description') }}</p>
                    </div>
                    <div class="button-items">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.drivers.create') }}">
                            {{ __('driver.add_new_driver') }} <i class="ri-user-add-line align-middle ms-2"></i>
                        </a>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('driver.name') }}</th>
                            <th>{{ __('driver.phone') }}</th>
                            <th>{{ __('driver.location') }}</th>
                            <th>{{ __('driver.availability_status') }}</th>
                            <th>{{ __('driver.manager') }}</th>
                            <th>{{ __('general.status') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.the_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drivers as $driver)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ Str::limit($driver->driver_full_name ?? '', 20) }}</td>

                                <td>{{ $driver->phone ?? '-' }}</td>


                                @php
                                    $locationParts = array_filter([
                                        $driver->country,
                                        $driver->region,
                                        $driver->city,
                                        $driver->district,
                                        $driver->latitude,
                                        $driver->longitude

                                    ]); // إزالة القيم الفارغة

                                    $shortLocation = implode(' - ', array_slice($locationParts, 0, 2)); // أول قيمتين فقط
                                    $fullLocation = implode(' - ', $locationParts); // كامل النص
                                @endphp

                                <td title="{{ $fullLocation }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                    {{ $shortLocation }}
                                </td>

                                <td>
                                    @php
                                        $avail = $driver->availability_status;
                                        $availColors = [
                                            'available' => 'success',
                                            'busy' => 'warning',
                                            'offline' => 'secondary',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $availColors[$avail] ?? 'secondary' }}">
                                        {{ __('driver.'.$avail) }}
                                    </span>
                                </td>

                                <td>{{ $driver->supervisor_id ?? '-' }}</td>

                                <td>
                                    @php
                                        $status = $driver->status;
                                        $statusColors = [
                                            'active' => 'success',
                                            'inactive' => 'secondary',
                                            'suspended' => 'warning',
                                            'terminated' => 'danger',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $statusColors[$status] ?? 'secondary' }}">
                                        {{ __('driver.status_'.$status) }}
                                    </span>
                                </td>

                                <td>{{ $driver->created_at ? $driver->created_at->diffForHumans() : '-' }}</td>

                                <td>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @ability('admin', 'show_drivers')
                                                <a class="dropdown-item" href="{{ route('admin.drivers.show', $driver->id) }}">{{ __('general.show') }}</a>
                                            @endability

                                            @ability('admin', 'update_drivers')
                                                <a class="dropdown-item" href="{{ route('admin.drivers.edit', $driver->id) }}">{{ __('general.edit') }}</a>
                                            @endability

                                            @ability('admin', 'delete_drivers')
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="confirmDelete('delete-driver-{{ $driver->id }}',
                                                        '{{ __('panel.confirm_delete_message') }}',
                                                        '{{ __('panel.yes_delete') }}',
                                                        '{{ __('panel.cancel') }}')">
                                                    {{ __('general.delete') }}
                                                </a>
                                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="post" class="d-none" id="delete-driver-{{ $driver->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endability
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
