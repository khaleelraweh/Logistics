@extends('layouts.driver')

@section('content')

       <!-- Page Header -->
        <div class="row ">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ __('return_request.manage_return_requests') }}</h4>

                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('driver.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

    <!-- return_requests table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"><i class="dripicons-return"></i> {{ __('return_request.return_request_data') }}</h4>
                            <p class="card-title-desc">
                                {{ __('return_request.return_request_description') }}
                            </p>
                        </div>


                    </div>

                    <!-- Filters Section -->
                        @include('driver.return_requests.filter.filter')
                    <!-- End Filters Section -->

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('return_request.package') }}</th>
                                <th>{{ __('return_request.status') }}</th>
                                <th>{{ __('return_request.requested_at') }}</th>
                                <th>{{ __('return_request.received_at') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($return_requests as $return_request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    @php
                                        $packageParts = array_filter([
                                            $return_request->package->tracking_number,
                                            $return_request->package->sender_region,
                                            $return_request->package->sender_city,
                                            $return_request->package->sender_district,
                                        ]);
                                        $fullPackageInfo = implode(' - ', $packageParts);

                                        $senderParts = array_filter([
                                            $return_request->package->sender_full_name,
                                            $return_request->package->sender_country,
                                            $return_request->package->sender_region,
                                            $return_request->package->sender_city,
                                            $return_request->package->sender_district,
                                        ]);
                                        $fullSenderInfo = implode(' - ', $senderParts);

                                        $receiverParts = array_filter([
                                            $return_request->package->receiver_full_name,
                                            $return_request->package->receiver_country,
                                            $return_request->package->receiver_region,
                                            $return_request->package->receiver_city,
                                            $return_request->package->receiver_district,
                                        ]);
                                        $fullReceiverInfo = implode(' - ', $receiverParts);
                                    @endphp

                                    <td data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="
                                            <div>
                                                <strong>{{ __('return_request.package') }}</strong><br>
                                                {{ $fullPackageInfo }}
                                            </div>
                                            <hr>
                                            <div>
                                                <strong>{{ __('return_request.sender') }}</strong><br>
                                                {{ $fullSenderInfo }}
                                            </div>
                                            <hr>
                                            <div>
                                                <strong>{{ __('return_request.receiver') }}</strong><br>
                                                {{ $fullReceiverInfo }}
                                            </div>
                                        ">
                                        <a href="#">
                                            {{ $return_request->package->tracking_number ?? '-' }}
                                            <br>
                                            <small>{{ $return_request->package->receiver_first_name ?? '' }} {{ $return_request->package->receiver_last_name ?? '' }}</small>
                                        </a>
                                    </td>



                                    @php
                                        $statusColors = [
                                            'requested' => 'success',
                                            'assigned_to_driver' => 'info',
                                            'picked_up' => 'warning',
                                            'in_transit' => 'warning',
                                            'received' => 'primary',
                                            'partially_received' => 'info',
                                            'rejected' => 'danger',
                                            'cancelled' => 'danger',
                                        ];

                                        $status = $return_request->status;
                                        $color = $statusColors[$status] ?? 'secondary';
                                    @endphp

                                    <td>
                                        <span class="badge bg-{{ $color }}">
                                            {{ $return_request->statusLabel() }}
                                        </span>
                                    </td>

                                    <td>{{ $return_request->requested_at ? $return_request->requested_at->diffForHumans() : '-' }}</td>
                                    <td>{{ $return_request->received_at ? $return_request->received_at->diffForHumans() : '-' }}</td>
                                    <td>{{ $return_request->created_at->diffForHumans() }}</td>
                                     <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @ability('driver', 'show_return_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('driver.return_requests.show', $return_request->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('driver', 'update_return_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('driver.return_requests.edit', $return_request->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
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
        </div>
    </div>
@endsection

@section('script')
<script>
    // تفعيل التولتيب مع دعم HTML
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl, { html: true })
        })
    });
</script>
@endsection
