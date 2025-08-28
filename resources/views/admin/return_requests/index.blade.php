@extends('layouts.admin')

@section('content')

       <!-- Page Header -->
        <div class="row ">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ __('return_request.manage_return_requests') }}</h4>

                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
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

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.return_requests.create') }}">
                                {{ __('return_request.add_new_return_request') }} <i class="dripicons-return align-middle ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('return_request.package') }}</th>
                                <th>{{ __('return_request.driver') }}</th>
                                <th>{{ __('return_request.status') }}</th>
                                <th>{{ __('return_request.requested_at') }}</th>
                                <th>{{ __('return_request.received_at') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
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
                                        <a href="{{ route('admin.packages.show', $return_request->package_id) }}">
                                            {{ $return_request->package->tracking_number ?? '-' }}
                                            <br>
                                            <small>{{ $return_request->package->receiver_first_name ?? '' }} {{ $return_request->package->receiver_last_name ?? '' }}</small>
                                        </a>
                                    </td>

                                    <td>
                                        @if ($return_request->driver)
                                            <a href="{{ route('admin.drivers.show',$return_request->driver->id) }}">
                                                {{ $return_request->driver->driver_full_name ?? '-' }}
                                                <br>
                                                <small>{{ $return_request->driver->phone ?? '-' }}</small>
                                            </a>
                                        @endif

                                    </td>
                                    <td>
                                        @switch($return_request->status)
                                            @case('requested')
                                                <span class="badge bg-success">{{ __('return_request.status_requested') }}</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">{{ __('return_request.status_cancelled') }}</span>
                                                @break
                                            @case('in_transit')
                                                <span class="badge bg-warning">{{ __('return_request.status_in_transit') }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">{{ __('return_request.status_rejected') }}</span>
                                                @break
                                            @case('received')
                                                <span class="badge bg-primary">{{ __('return_request.status_received') }}</span>
                                                @break
                                            @case('partially_received')
                                                <span class="badge bg-info">{{ __('return_request.status_partially_received') }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ __('return_request.status_unknown') }}</span>
                                        @endswitch
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
                                                @ability('admin', 'show_return_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.return_requests.show', $return_request->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'update_return_requests')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.return_requests.edit', $return_request->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'delete_return_requests')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"

                                                    onclick="confirmDelete('delete-return_request-{{ $return_request->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                            >
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form id="delete-return_request-{{ $return_request->id }}"
                                                        action="{{ route('admin.return_requests.destroy', $return_request->id) }}"
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
                                    <td colspan="8" class="text-center">{{ __('panel.no_found_item') }}</td>
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
