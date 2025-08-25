@extends('layouts.admin')

@section('content')


    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('stock-item.manage_stock_items') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stock_items.index') }}">{{ __('stock-item.stock_items') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('stock-item.stock_item_data') }}</h4>
                            <p class="card-title-desc">
                                {{ __('stock-item.stock_item_description') }}
                            </p>
                        </div>

                        @ability('admin', 'create_stock_items')
                            <div class="button-items">
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.stock_items.create') }}">
                                    {{ __('stock-item.add_new_stock_item') }}
                                    <i class="mdi mdi-stocking align-middle ms-2"></i>
                                </a>
                            </div>
                        @endability
                    </div>

                    <!-- Filters Section -->
                    @include('admin.stock_items.filter.filter')
                    <!-- End Filters Section -->

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('product.name') }}</th>
                            <th>{{ __('merchant.name') }}</th>
                            <th>{{ __('stock-item.shelf-code') }}</th>
                            <th>{{ __('stock-item.quantity') }}</th>
                            <th>{{ __('stock-item.status') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($stock_items as $stock_item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- المنتج --}}
                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ $stock_item->product->name ?? '' }}">
                                    <a href="{{ route('admin.products.show', $stock_item->product->id ?? 0) }}">
                                        {{ \Illuminate\Support\Str::words($stock_item->product->name ?? '', 2, '') }}
                                    </a>
                                </td>

                                {{-- التاجر --}}
                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ $stock_item->merchant->name ?? '' }}">
                                    <a href="{{ route('admin.merchants.show', $stock_item->merchant->id) }}">
                                        {{ \Illuminate\Support\Str::words($stock_item->merchant->name ?? '', 3, '') }}
                                    </a>
                                </td>

                                <td>
                                    {{-- رابط الرف --}}
                                    <a href="{{ route('admin.shelves.show', $stock_item->rentalShelf->shelf->id ?? '') }}">
                                        {{ $stock_item->rentalShelf->shelf->code ?? '' }}
                                    </a>

                                    {{-- رابط المستودع --}}
                                    <a href="{{ route('admin.warehouses.show', $stock_item->rentalShelf->shelf->warehouse->id ?? '') }}"
                                    class="d-block btn btn-info btn-rounded waves-effect waves-light mt-1" style="width: fit-content; font-size: 0.75em;padd
                                    ing: 2px 6px; font-weight: 500;">
                                        <small style="font-size: 0.7em">{{ $stock_item->rentalShelf->shelf->warehouse->name ?? '' }}</small>
                                    </a>
                                </td>


                                {{-- الكمية --}}
                                <td>{{ $stock_item->quantity }}</td>

                                {{-- الحالة --}}
                                <td>
                                    @if ($stock_item->status == 1)
                                        <a href="javascript:void(0);" class="updateStockItemStatus"
                                           id="stock-item-{{ $stock_item->id }}" stock_item_id="{{ $stock_item->id }}">
                                            <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                               status="Active" style="font-size: 1.6em"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="updateStockItemStatus"
                                           id="stock-item-{{ $stock_item->id }}" stock_item_id="{{ $stock_item->id }}">
                                            <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                               status="Inactive" style="font-size: 1.6em"></i>
                                        </a>
                                    @endif
                                </td>

                                {{-- تاريخ الإنشاء --}}
                                <td>{{ $stock_item->created_at->diffForHumans() }}</td>

                                {{-- العمليات --}}
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_stock_items')
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.stock_items.show', $stock_item->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                            @endability

                                            @ability('admin', 'update_stock_items')
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.stock_items.edit', $stock_item->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                            @endability

                                            @ability('admin', 'delete_stock_items')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                       onclick="confirmDelete('delete-stock-item-{{ $stock_item->id }}',
                                                           '{{ __('panel.confirm_delete_message') }}',
                                                           '{{ __('panel.yes_delete') }}',
                                                           '{{ __('panel.cancel') }}')">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form action="{{ route('admin.stock_items.destroy', $stock_item->id) }}"
                                                          method="post" class="d-none"
                                                          id="delete-stock-item-{{ $stock_item->id }}">
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
