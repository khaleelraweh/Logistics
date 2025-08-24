@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('package.manage_packages') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('package.packages') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('package.manage_packages') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="card-head d-flex justify-content-between">
                    <div class="head">
                        <h4 class="card-title"> <i class="fas fa-box"></i> {{ __('package.package_data') }}</h4>
                        <p class="card-title-desc">{{ __('package.package_description') }}</p>
                    </div>

                    <div class="button-items">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.packages.create') }}">
                            {{ __('package.add_new_package') }}
                            <i class="mdi mdi-18px mdi-package-variant-closed"></i>
                        </a>
                    </div>
                </div>

                <!-- Filters Section -->
                @include('admin.packages.filter.filter')
                <!-- End Filters Section -->

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('package.tracking_number') }}</th>
                            <th>{{ __('package.sender_name') }}</th>
                            <th>{{ __('package.receiver_name') }}</th>
                            <th>{{ __('package.status') }}</th>
                            <th>{{ __('package.total_fee') }}</th>
                            <th>{{ __('package.paid_amount') }}</th>
                            <th>{{ __('package.remaining_amount') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.the_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $package->tracking_number }}</td>
                                <td>{{ $package->sender_full_name ?? '-' }}</td>
                                <td>{{ $package->receiver_full_name ?? '-' }}</td>
                                <td>
                                    {{-- <span class="badge bg-{{ $package->status === 'pending' ? 'warning' : ($package->status === 'assigned' ? 'info' : 'success') }}">
                                        {{ __('package.status_'.$package->status) }}
                                    </span> --}}
                                    <span class="badge bg-{{ $package->statusColor() }}">
                                        {{ $package->statusLabel() }}
                                    </span>
                                </td>
                                <td>{{ number_format($package->total_fee, 2) }}</td>
                                <td>{{ number_format($package->paid_amount, 2) }}</td>
                                <td>{{ number_format($package->remainingAmount(), 2) }}</td>
                                <td>{{ $package->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            @ability('admin', 'show_packages')
                                                <a class="dropdown-item" href="{{ route('admin.packages.show' , $package->id) }}">{{ __('general.show') }}</a>
                                            @endability

                                            @ability('admin', 'update_packages')
                                                <a class="dropdown-item" href="{{ route('admin.packages.edit' , $package->id) }}">{{ __('general.edit') }}</a>
                                            @endability

                                            {{-- زر إسناد الطرد لسائق --}}
                                            @ability('admin', 'create_deliveries')
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignDeliveryModal{{ $package->id }}">
                                                    {{ __('delivery.assign_to_driver') }}
                                                </a>
                                            @endability

                                            @ability('admin', 'delete_packages')
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="confirmDelete('delete-package-{{ $package->id }}',
                                                        '{{ __('panel.confirm_delete_message') }}',
                                                        '{{ __('panel.yes_delete') }}',
                                                        '{{ __('panel.cancel') }}')"
                                                >
                                                    {{ __('general.delete') }}
                                                </a>
                                                <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                                        method="post" class="d-none"
                                                        id="delete-package-{{ $package->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endability
                                        </div>
                                    </div>

                                    <!-- مودال إسناد التوصيل -->
                                    <div class="modal fade" id="assignDeliveryModal{{ $package->id }}" tabindex="-1" aria-labelledby="assignDeliveryLabel{{ $package->id }}" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <form action="{{ route('admin.deliveries.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignDeliveryLabel{{ $package->id }}">{{ __('delivery.assign_to_driver') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('general.close') }}"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="driver_id_{{ $package->id }}" class="form-label">{{ __('driver.name') }}</label>
                                                        <select name="driver_id" id="driver_id_{{ $package->id }}" class="form-select" required>
                                                            <option value="" selected disabled>{{ __('delivery.select_driver') }}</option>
                                                            @foreach(\App\Models\Driver::all() as $driver)
                                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="assigned_at_{{ $package->id }}" class="form-label">{{ __('delivery.assigned_at') }}</label>
                                                        <input type="date" name="assigned_at" id="assigned_at_{{ $package->id }}" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="note_{{ $package->id }}" class="form-label">{{ __('delivery.note') }}</label>
                                                        <textarea name="note" id="note_{{ $package->id }}" class="form-control" rows="2"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.cancel') }}</button>
                                                    <button type="submit" class="btn btn-primary">{{ __('delivery.assign') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
