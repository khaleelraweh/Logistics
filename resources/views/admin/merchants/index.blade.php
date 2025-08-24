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
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($merchants as $merchant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td title="{{ $merchant->name }}">{{ Str::words($merchant->name, 2, '') }}</td>
                                    <td title="{{ $merchant->contact_person }}">{{ Str::words($merchant->contact_person, 2, '') }}</td>
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

                                    <td title="{{ $fullLocation }}">
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
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @ability('admin', 'show_merchants')
                                                        <a class="dropdown-item" href="{{ route('admin.merchants.show' , $merchant->id) }}">{{ __('general.show') }}</a>
                                                    @endability

                                                    @ability('admin', 'update_merchants')
                                                        <a class="dropdown-item" href="{{ route('admin.merchants.edit' , $merchant->id) }}">{{ __('general.edit') }}</a>
                                                    @endability

                                                    @ability('admin', 'delete_merchants')
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                                                onclick="confirmDelete('delete-merchant-{{ $merchant->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                        >
                                                        {{ __('general.delete') }}
                                                        </a>
                                                        <form action="{{ route('admin.merchants.destroy', $merchant->id) }}"
                                                              method="post" class="d-none"
                                                              id="delete-merchant-{{ $merchant->id }}">
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


