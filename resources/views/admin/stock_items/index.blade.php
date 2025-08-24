@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('stock-item.manage_stock_items') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('stock-item.view_stock_items') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('stock-item.manage_stock_items') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.stock_items.create') }}">
                                {{ __('stock-item.add_new_stock_item') }}
                                <i class="mdi mdi-stocking align-middle ms-2"></i>
                            </a>
                        </div>
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
                            <th>{{ __('general.the_actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($stock_items as $stock_item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- المنتج --}}
                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ $stock_item->product->name ?? '' }}">
                                    {{ \Illuminate\Support\Str::words($stock_item->product->name ?? '', 2, '') }}
                                </td>

                                {{-- التاجر --}}
                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ $stock_item->merchant->name ?? '' }}">
                                    {{ \Illuminate\Support\Str::words($stock_item->merchant->name ?? '', 3, '') }}
                                </td>

                                {{-- الكود + المستودع --}}
                                <td>
                                    {{ $stock_item->rentalShelf->shelf->code ?? '' }}
                                    <button type="button"
                                            class="d-block btn btn-info btn-rounded waves-effect waves-light mt-1">
                                        <small>{{ $stock_item->rentalShelf->shelf->warehouse->name ?? '' }}</small>
                                    </button>
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
