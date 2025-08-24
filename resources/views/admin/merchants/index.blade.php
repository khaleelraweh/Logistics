@extends('layouts.admin')

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('merchant.manage_merchants') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('merchant.view_merchants') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('merchant.manage_merchants') }}</li>
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

                                <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('merchant.merchant_data') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('merchant.merchant_description') }}
                                </p>
                            </div>

                            <div class="button-items">
                                   <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.merchants.create') }}">
                                        {{ __('merchant.add_new_merchant') }} <i class=" ri-user-add-line align-middle ms-2"></i>
                                   </a>
                            </div>

                        </div>

                        <!-- Filters Section -->
                            @include('admin.merchants.filter.filter')
                        <!-- End Filters Section -->



                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('general.name') }}</th>
                                <th>{{ __('merchant.contact_person') }}</th>
                                <th>{{ __('general.phone') }}</th>
                                <th>{{ __('general.address') }}</th>
                                <th>{{ __('general.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th width="12%">{{ __('general.actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($merchants as $merchant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $merchant->name }}">{{ Str::words($merchant->name, 2, '') }}</td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $merchant->contact_person }}">{{ Str::words($merchant->contact_person, 2, '') }}</td>
                                    <td>{{ $merchant->phone }}</td>
                                    @php
                                        $locationParts = array_filter([
                                            $merchant->country,
                                            $merchant->region,
                                            $merchant->city,
                                            $merchant->district,
                                            $merchant->postal_code,
                                        ]); // إزالة القيم الفارغة

                                        $shortLocation = implode(' - ', array_slice($locationParts, 0, 2)); // أول قيمتين فقط
                                        $fullLocation = implode(' - ', $locationParts); // كامل النص
                                    @endphp

                                    <td title="{{ $fullLocation }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                        {{ $shortLocation }}
                                    </td>

                                    <td>
                                        @if ($merchant->status == 1)
                                            <a href="javascript:void(0);" class="updateMerchantStatus "
                                                id="merchant-{{ $merchant->id }}" merchant_id="{{ $merchant->id }}">
                                                <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                    status="Active" style="font-size: 1.6em"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="updateMerchantStatus" id="merchant-{{ $merchant->id }}"
                                                merchant_id="{{ $merchant->id }}">
                                                <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                    status="Inactive" style="font-size: 1.6em"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $merchant->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @ability('admin', 'show_merchants')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.merchants.show', $merchant->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'update_merchants')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.merchants.edit', $merchant->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'delete_merchants')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"

                                                    onclick="confirmDelete('delete-merchant-{{ $merchant->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                            >
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form id="delete-merchant-{{ $merchant->id }}"
                                                        action="{{ route('admin.merchants.destroy', $merchant->id) }}"
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
            </div> <!-- end col -->
        </div> <!-- end row -->

@endsection


