@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('invoice.manage_invoices') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('invoice.view_invoices') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('invoice.manage_invoices') }}</li>
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
                        <h4 class="card-title"><i class="fas fa-file-invoice-dollar"></i> {{ __('invoice.invoice_data') }}</h4>
                        <p class="card-title-desc">{{ __('invoice.invoice_description') }}</p>
                    </div>
                    <div class="button-items">
                        {{-- <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.invoices.create') }}">
                            {{ __('invoice.add_new_invoice') }}
                            <i class="mdi mdi-clipboard-text-outline"></i>
                        </a> --}}
                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('invoice.invoice_number') }}</th>
                            <th>{{ __('invoice.merchant') }}</th>
                            <th>{{ __('invoice.payable_type') }}</th>
                            <th>{{ __('invoice.total_amount') }}</th>
                            <th>{{ __('invoice.paid_amount') }}</th>
                            <th>{{ __('invoice.status') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.the_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->merchant->name ?? '-' }}</td>
                                <td>{{ class_basename($invoice->payable) ?? '-' }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} {{ $invoice->currency }}</td>
                                <td>{{ number_format($invoice->paid_amount, 2) }} {{ $invoice->currency }}</td>
                                <td>
                                    @if($invoice->status == 'paid')
                                        <span class="badge bg-success">مدفوع</span>
                                    @elseif($invoice->status == 'partial')
                                        <span class="badge bg-warning">جزئياً</span>
                                    @else
                                        <span class="badge bg-danger">غير مدفوع</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ __('general.operations') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            @ability('admin', 'show_invoices')
                                                <a class="dropdown-item" href="{{ route('admin.invoices.show', $invoice->id) }}">{{ __('general.show') }}</a>
                                            @endability

                                            @ability('admin', 'update_invoices')
                                                <a class="dropdown-item" href="{{ route('admin.invoices.edit', $invoice->id) }}">{{ __('general.edit') }}</a>
                                            @endability

                                            @ability('admin', 'delete_invoices')
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                   onclick="confirmDelete('delete-invoice-{{ $invoice->id }}',
                                                       '{{ __('panel.confirm_delete_message') }}',
                                                       '{{ __('panel.yes_delete') }}',
                                                       '{{ __('panel.cancel') }}')">
                                                    {{ __('general.delete') }}
                                                </a>
                                                <form id="delete-invoice-{{ $invoice->id }}" method="POST" action="{{ route('admin.invoices.destroy', $invoice->id) }}" class="d-none">
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
                                <td colspan="9" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
