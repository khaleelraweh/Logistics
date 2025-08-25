@extends('layouts.admin')

@section('content')

    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('product.manage_products') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('product.products') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('product.product_data') }}</h4>
                            <p class="card-title-desc">{{ __('product.product_description') }}</p>
                        </div>

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.products.create') }}">
                                {{ __('product.add_new_product') }} <i class="ri-product-hunt-line align-middle ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Filters Section -->
                        @include('admin.products.filter.filter')
                    <!-- End Filters Section -->

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
                            <th width="12%">{{ __('general.actions') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $product->name }}">
                                    {{ Str::words($product->name ?? '', 2, '') }}
                                </td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $product->description }}">
                                    {!! Str::limit($product->description ?? '', 25) !!}
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $product->merchant->name ?? '' }}">
                                    {{ Str::words($product->merchant->name ?? '', 2, '') }}
                                    @if($product->merchant)
                                        <button type="button" class="d-block btn btn-info btn-rounded waves-effect waves-light mt-1" style="font-size: 0.8em;padding:0.3em">
                                            <small>{{ $product->merchant->email }}</small>
                                        </button>
                                    @endif
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
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_products')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.products.show', $product->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'update_products')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'delete_products')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="confirmDelete('delete-product-{{ $product->id }}',
                                                                           '{{ __('panel.confirm_delete_message') }}',
                                                                           '{{ __('panel.yes_delete') }}',
                                                                           '{{ __('panel.cancel') }}')">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-product-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-none">
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
