@extends('layouts.admin')

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('product.manage_products') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('product.view_products') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('product.manage_products') }}</li>
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

                                <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('product.product_data') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('product.product_description') }}
                                </p>
                            </div>

                            <div class="button-items">
                                   <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.products.create') }}">
                                        {{ __('product.add_new_product') }} <i class="ri-product-hunt-line  align-middle ms-2"></i>
                                   </a>
                            </div>

                        </div>



                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('product.name') }}</th>
                                <th>{{ __('product.description') }}</th>
                                <th>{{ __('product.sku_code') }}</th>
                                <th>{{ __('merchant.name') }}</th>
                                <th>{{ __('product.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($product->name ?? '', 8) }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($product->description ?? '', 25) !!}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>
                                        {{ $product->merchant->name ?? '' }}
                                        <button type="button" class="d-block btn btn-info btn-rounded waves-effect waves-light" style="font-size: 0.8em;padding:0.3em"><small> {{ $product->merchant->email }} </small></button>
                                    </td>
                                    <td>
                                        @if ($product->status == 1)
                                            <a href="javascript:void(0);" class="updateProductStatus "
                                                id="product-{{ $product->id }}" product_id="{{ $product->id }}">
                                                <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                    status="Active" style="font-size: 1.6em"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="updateProductStatus" id="product-{{ $product->id }}"
                                                product_id="{{ $product->id }}">
                                                <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                    status="Inactive" style="font-size: 1.6em"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @ability('admin', 'show_products')
                                                        <a class="dropdown-item" href="{{ route('admin.products.show' , $product->id) }}">{{ __('general.show') }}</a>
                                                    @endability

                                                    @ability('admin', 'update_products')
                                                        <a class="dropdown-item" href="{{ route('admin.products.edit' , $product->id) }}">{{ __('general.edit') }}</a>
                                                    @endability

                                                    @ability('admin', 'delete_products')
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                                                onclick="confirmDelete('delete-product-{{ $product->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                        >
                                                        {{ __('general.delete') }}
                                                        </a>
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                              method="post" class="d-none"
                                                              id="delete-product-{{ $product->id }}">
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


