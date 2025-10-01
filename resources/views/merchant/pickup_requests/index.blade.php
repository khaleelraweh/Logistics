@extends('layouts.merchant')

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
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('merchant.pickup_requests.create') }}">
                                {{ __('pickup_request.add_new_pickup_request') }} <i class="fas fa-plus-circle align-middle ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Filters Section -->
                        @include('merchant.pickup_requests.filter.filter')
                    <!-- End Filters Section -->

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('merchant.name') }}</th>
                                <th>{{ __('pickup_request.pickup_address') }}</th>
                                <th>{{ __('pickup_request.scheduled_at') }}</th>
                                <th>{{ __('pickup_request.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.actions') }}</th>
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

                                        $shortMerchant = implode(' - ', array_slice($merchantParts, 0, 2)); // أول قيمتين فقط
                                        $fullMerchant = implode(' - ', $merchantParts); // كامل النص
                                    @endphp

                                    <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $fullMerchant }}">
                                        <a href="#">
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
                                            optional($request->driver)->driver_full_name,
                                            optional($request->driver)->phone,
                                            optional($request->driver)->email,
                                        ]);

                                        $shortDriver = implode(' - ', array_slice($locationParts, 0, 2)); // أول قيمتين فقط
                                        $fullDriver = implode(' - ', $driverParts); // كامل النص
                                    @endphp
                                    <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('general.by') }} {{ __('driver.driver') }} {{ $fullDriver }}">
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
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @ability('merchant', 'display_pickup_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('merchant.pickup_requests.show', $request->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('merchant', 'update_pickup_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('merchant.pickup_requests.edit', $request->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('merchant', 'delete_pickup_requests')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                    onclick="confirmDelete('delete-pickup-request-{{ $request->id }}',
                                                                            '{{ __('panel.confirm_delete_message') }}',
                                                                            '{{ __('panel.yes_delete') }}',
                                                                            '{{ __('panel.cancel') }}')">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form id="delete-pickup-request-{{ $request->id }}"
                                                        action="{{ route('merchant.pickup_requests.destroy', $request->id) }}"
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
