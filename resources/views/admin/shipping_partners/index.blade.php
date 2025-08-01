@extends('layouts.admin')

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('shipping_partner.manage_shipping_partners') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('shipping_partner.view_shipping_partners') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('shipping_partner.manage_shipping_partners') }}</li>
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

                                <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('shipping_partner.shipping_partner_data') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('shipping_partner.shipping_partner_description') }}
                                </p>
                            </div>

                            <div class="button-items">
                                   <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.shipping_partners.create') }}">
                                        {{ __('shipping_partner.add_new_shipping_partner') }} <i class="ri-shipping_partner-hunt-line  align-middle ms-2"></i>
                                   </a>
                            </div>

                        </div>



                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('shipping_partner.name') }}</th>
                                <th>{{ __('shipping_partner.description') }}</th>
                                <th>{{ __('shipping_partner.contact_email') }}</th>
                                <th>{{ __('shipping_partner.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($shipping_partners as $shipping_partner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($shipping_partner->name ?? '', 8) }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($shipping_partner->description ?? '', 25) !!}</td>
                                    <td>{{ $shipping_partner->contact_email }}</td>

                                    <td>
                                        @if ($shipping_partner->status == 1)
                                            <a href="javascript:void(0);" class="updateShippingPartnerStatus"
                                                id="shipping-partner-{{ $shipping_partner->id }}" shipping_partner_id="{{ $shipping_partner->id }}">
                                                <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                    status="Active" style="font-size: 1.6em"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="updateShippingPartnerStatus" id="shipping-partner-{{ $shipping_partner->id }}"
                                                shipping_partner_id="{{ $shipping_partner->id }}">
                                                <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                    status="Inactive" style="font-size: 1.6em"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $shipping_partner->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @ability('admin', 'show_shipping_partners')
                                                        <a class="dropdown-item" href="{{ route('admin.shipping_partners.show' , $shipping_partner->id) }}">{{ __('general.show') }}</a>
                                                    @endability

                                                    @ability('admin', 'update_shipping_partners')
                                                        <a class="dropdown-item" href="{{ route('admin.shipping_partners.edit' , $shipping_partner->id) }}">{{ __('general.edit') }}</a>
                                                    @endability

                                                    @ability('admin', 'delete_shipping_partners')
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                                                onclick="confirmDelete('delete-shipping_partner-{{ $shipping_partner->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                        >
                                                        {{ __('general.delete') }}
                                                        </a>
                                                        <form action="{{ route('admin.shipping_partners.destroy', $shipping_partner->id) }}"
                                                              method="post" class="d-none"
                                                              id="delete-shipping_partner-{{ $shipping_partner->id }}">
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


