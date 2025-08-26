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
                           <i class="mdi mdi-account-tie me-2"></i> {{ __('driver.add_new_driver') }}
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
                            <th>{{ __('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drivers as $driver)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $driver->driver_full_name }}">{{ Str::words($driver->driver_full_name, 2, '') }}</td>
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


                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ $driver->supervisor ? $driver->supervisor->full_name : __('messages.no_supervisor') }}">
                                    {{ $driver->supervisor ? Str::words($driver->supervisor->full_name, 2, '') : __('driver.no_supervisor') }}
                                </td>

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
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_drivers')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.drivers.show', $driver->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'update_drivers')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.drivers.edit', $driver->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'delete_drivers')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                onclick="confirmDelete('delete-driver-{{ $driver->id }}',
                                                                        '{{ __('panel.confirm_delete_message') }}',
                                                                        '{{ __('panel.yes_delete') }}',
                                                                        '{{ __('panel.cancel') }}')">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-driver-{{ $driver->id }}"
                                                    action="{{ route('admin.drivers.destroy', $driver->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                            @endability
                                        </ul>
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
