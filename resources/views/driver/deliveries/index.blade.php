@extends('layouts.driver')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.manage_deliveries') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- deliveries table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="card-head d-flex justify-content-between">
                    <div class="head">
                        <h4 class="card-title"><i class="fas fa-shipping-fast"></i> {{ __('delivery.delivery_data') }}</h4>
                        <p class="card-title-desc">
                            {{ __('delivery.delivery_description') }}
                        </p>
                    </div>
                </div>

                <!-- Filters Section -->
                    @include('driver.deliveries.filter.filter')
                <!-- End Filters Section -->

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('delivery.package') }}</th>
                            <th>{{ __('delivery.recipient') }}</th>
                            <th>{{ __('delivery.address') }}</th>
                            <th>{{ __('delivery.cod_amount') }}</th>
                            <th>{{ __('delivery.status') }}</th>
                            <th>{{ __('delivery.assigned_at') }}</th>
                            <th>{{ __('delivery.delivered_at') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deliveries as $delivery)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Package --}}
                                <td>
                                    @if($delivery->package)
                                        <a href="#">
                                            {{ $delivery->package->tracking_number ?? '-' }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- Recipient --}}
                                <td>
                                    {{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}
                                    <br>
                                    <small>{{ $delivery->package->receiver_phone ?? '' }}</small>
                                </td>

                                {{-- Address --}}
<td>
    @php
        $addressParts = array_filter([
            $delivery->package->receiver_country,
            $delivery->package->receiver_region,
            $delivery->package->receiver_city,
            $delivery->package->receiver_district,
            $delivery->package->receiver_postal_code,
        ]);
        $fullAddress = implode(' - ', $addressParts);
        $mapsLink = $delivery->package->receiver_latitude && $delivery->package->receiver_longitude
                    ? "https://www.google.com/maps?q={$delivery->package->receiver_latitude},{$delivery->package->receiver_longitude}"
                    : "https://www.google.com/maps/search/" . urlencode($fullAddress);
    @endphp

    {{ $fullAddress ?: '-' }}
    @if($fullAddress)
        <br>
        <a href="{{ $mapsLink }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
            <i class="fas fa-map-marker-alt"></i> {{ __('delivery.view_on_map') }}
        </a>
    @endif
</td>


                                {{-- COD Amount --}}
                                <td>
                                    @if($delivery->package && $delivery->package->cod_amount > 0)
                                        {{ number_format($delivery->package->cod_amount, 2) }}
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    @php
                                        $color = match($delivery->status) {
                                            'delivered'          => 'success',
                                            'on_route'           => 'warning',
                                            'assigned_to_driver' => 'info',
                                            'pending'            => 'secondary',
                                            'in_transit'         => 'primary',
                                            'cancelled'          => 'dark',
                                            'returned'           => 'danger',
                                            default              => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        {{ __('delivery.status_' . $delivery->status) }}
                                    </span>
                                </td>

                                <td>{{ $delivery->assigned_at ? $delivery->assigned_at->diffForHumans() : '-' }}</td>
                                <td>{{ $delivery->delivered_at ? $delivery->delivered_at->diffForHumans() : '-' }}</td>
                                <td>{{ $delivery->created_at->diffForHumans() }}</td>

                                {{-- Actions --}}
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i> {{ __('general.operations') }}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('driver', 'show_deliveries')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('driver.deliveries.show', $delivery->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('driver', 'update_deliveries')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('driver.deliveries.edit', $delivery->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            {{-- حذف معطل للسائق --}}
                                        </ul>
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
