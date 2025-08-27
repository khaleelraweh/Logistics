@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('pickup_request.manage_pickup_requests') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('pickup_request.view_pickup_requests') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('pickup_request.manage_pickup_requests') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"><i class="fas fa-truck-loading"></i> {{ __('pickup_request.pickup_requests_data') }}</h4>
                            <p class="card-title-desc">
                                {{ __('pickup_request.pickup_requests_description') }}
                            </p>
                        </div>

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.pickup_requests.create') }}">
                                {{ __('pickup_request.add_new_pickup_request') }} <i class="fas fa-plus-circle align-middle ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('merchant.name') }}</th>
                                <th>{{ __('pickup_request.pickup_address') }}</th>
                                <th>{{ __('pickup_request.scheduled_at') }}</th>
                                <th>{{ __('pickup_request.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pickupRequests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                     @php
                                        $merchantParts = array_filter([
                                            $request->merchant->name,
                                            $request->merchant->contact_person,
                                            $request->merchant->phone,
                                            $request->merchant->country,
                                            $request->merchant->city,
                                        ]); // إزالة القيم الفارغة

                                        $fullMerchant = implode(' - ', $merchantParts); // كامل النص
                                    @endphp

                                    <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $fullMerchant }}">
                                        <a href="{{ route('admin.merchants.show', $request->merchant->id) }}">
                                            {{ Str::words($request->merchant->name, 2, '') }}
                                            <br>
                                            <small class="text-muted">{{ $request->merchant->email ?? '' }}</small>

                                        </a>
                                    </td>


                                    @php
                                        $locationParts = array_filter([
                                            $request->country,
                                            $request->region,
                                            $request->city,
                                            $request->district,
                                            $request->postal_code,
                                        ]); // إزالة القيم الفارغة

                                        $shortLocation = implode(' - ', array_slice($locationParts, 0, 2)); // أول قيمتين فقط
                                        $fullLocation = implode(' - ', $locationParts); // كامل النص
                                    @endphp

                                    <td title="{{ $fullLocation }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                        {{ $shortLocation }}
                                    </td>

                                    <td>{{ $request->scheduled_at ? $request->scheduled_at->format('Y-m-d') : '-' }}</td>
                                    @php
                                        $driverParts = array_filter([
                                            $request->driver->full_name,
                                            $request->driver->phone,
                                            $request->driver->email,

                                        ]); // إزالة القيم الفارغة

                                        $shortDriver = implode(' - ', array_slice($locationParts, 0, 2)); // أول قيمتين فقط
                                        $fullDriver = implode(' - ', $driverParts); // كامل النص
                                    @endphp
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'badge bg-warning',
                                                'accepted' => 'badge bg-info',
                                                'completed' => 'badge bg-success',
                                            ];
                                        @endphp
                                        <span class="{{ $statusClass[$request->status] ?? 'badge bg-secondary' }}">
                                            {{ __('pickup_request.status_' . $request->status) }}
                                        </span>
                                        <br>
                                         @if ($request->status == 'completed')
                                            <span class="badge bg-light text-dark ms-1">
                                                {{ $request->completed_at->diffForHumans() }}
                                            </span>
                                        @else
                                            @if ($request->status == 'accepted')
                                                <span class="badge bg-light text-dark ms-1">
                                                    {{ $request->accepted_at->diffForHumans() }}
                                                </span>
                                            @else

                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $request->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @ability('admin', 'display_pickup_requests')
                                                    <a class="dropdown-item" href="{{ route('admin.pickup_requests.show', $request->id) }}">{{ __('general.show') }}</a>
                                                @endability

                                                @ability('admin', 'update_pickup_requests')
                                                    <a class="dropdown-item" href="{{ route('admin.pickup_requests.edit', $request->id) }}">{{ __('general.edit') }}</a>
                                                @endability

                                                @ability('admin', 'delete_pickup_requests')
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                       onclick="confirmDelete('delete-pickup-request-{{ $request->id }}',
                                                       '{{ __('panel.confirm_delete_message') }}',
                                                       '{{ __('panel.yes_delete') }}',
                                                       '{{ __('panel.cancel') }}')"
                                                    >
                                                    {{ __('general.delete') }}
                                                    </a>
                                                    <form action="{{ route('admin.pickup_requests.destroy', $request->id) }}"
                                                          method="post" class="d-none"
                                                          id="delete-pickup-request-{{ $request->id }}">
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
                                    <td colspan="7" class="text-center">{{ __('panel.no_found_item') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
