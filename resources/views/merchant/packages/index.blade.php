@extends('layouts.merchant')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('package.manage_packages') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('merchant.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('merchant.packages.index') }}">{{ __('package.packages') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

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

                    @ability('merchant', 'create_packages')
                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('merchant.packages.create') }}">
                                <i class="mdi mdi-18px mdi-package-variant-closed me-2"></i>
                                {{ __('package.add_new_package') }}
                            </a>
                        </div>
                    @endability
                </div>



                <!-- Filters Section -->
                @include('merchant.packages.filter.filter')
                <!-- End Filters Section -->

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('package.tracking_number') }}</th>
                            <th>{{ __('package.sender_name') }}</th>
                            <th>{{ __('package.receiver_name') }}</th>
                            <th>{{ __('package.status') }}</th>
                            {{-- <th>{{ __('package.total_fee') }}</th> --}}
                            <th>{{ __('package.fee') }}</th>
                            {{-- <th>{{ __('package.paid_amount') }}</th> --}}
                            <th>{{ __('package.paid') }}</th>
                            {{-- <th>{{ __('package.remaining_amount') }}</th> --}}
                            <th>{{ __('package.remaining') }}</th>
                            {{-- <th>{{ __('general.created_at') }}</th> --}}
                            <th>{{ __('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $package->tracking_number }}</td>
                                <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $package->sender_full_name }}">{{ Str::words($package->sender_full_name, 2, '') }}</td>
                                <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $package->receiver_full_name }}">{{ Str::words($package->receiver_full_name, 2, '') }}</td>
                                <td>
                                    <span class="badge bg-{{ $package->statusColor() }}">
                                        {{ $package->statusLabel() }}
                                    </span>
                                </td>
                                <td>{{ number_format($package->total_fee, 2) }}</td>
                                <td>
                                    {{ number_format($package->paid_amount, 2) }}

                                </td>
                                <td>{{ number_format($package->remainingAmount(), 2) }}</td>
                                {{-- <td>{{ $package->created_at->diffForHumans() }}</td> --}}
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">

                                            @ability('merchant', 'show_packages')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('merchant.packages.show', $package->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                            @endability

                                            @ability('merchant', 'update_packages')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('merchant.packages.edit', $package->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                            @endability

                                            @ability('merchant', 'create_deliveries')
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#assignDeliveryModal{{ $package->id }}">
                                                       <i class="mdi mdi-1 8px mdi-truck-fast-outline me-2"></i> {{ __('delivery.assign_to_driver') }}
                                                    </a>
                                                </li>
                                            @endability
                                            @ability('merchant', 'show_packages')
                                                <li>
                                                     <a class="dropdown-item" href="{{ route('merchant.packages.print', $package->id) }}">
                                                        <i class="fas fa-download me-2"></i> {{ __('package.download_waybill') }}
                                                    </a>

                                                </li>
                                            @endability

                                            @ability('merchant', 'delete_packages')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                       onclick="confirmDelete('delete-package-{{ $package->id }}',
                                                       '{{ __('panel.confirm_delete_message') }}',
                                                       '{{ __('panel.yes_delete') }}',
                                                       '{{ __('panel.cancel') }}')">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form id="delete-package-{{ $package->id }}" action="{{ route('merchant.packages.destroy', $package->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </li>
                                            @endability

                                        </ul>
                                    </div>

                                    <!-- Assign Delivery Modal -->
                                    {{-- <div class="modal fade" id="assignDeliveryModal{{ $package->id }}" tabindex="-1" aria-labelledby="assignDeliveryLabel{{ $package->id }}" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <form action="{{ route('merchant.deliveries.store') }}" method="POST">
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
                                    </div> --}}

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
