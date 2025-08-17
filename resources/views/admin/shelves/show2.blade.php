@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-black py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ $shelf->code }}</h4>
                    <span class="badge bg-{{ $shelf->status ? 'success' : 'danger' }}">
                        {{ $shelf->status ? __('general.active') : __('general.inactive') }}
                    </span>
                </div>
                <h6 class="card-subtitle mt-2 text-black-50">
                    {{ __('warehouse.name') }}: {{ $shelf->warehouse->name ?? __('general.not_specified') }}
                </h6>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-muted mb-1"><i class="fas fa-info-circle me-2"></i> {{ __('general.description') }}</h6>
                    <p class="fs-5">{!! $shelf->description ?? __('general.not_specified') !!}</p>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded text-center">
                            <i class="fas fa-ruler-combined fa-2x text-primary mb-2"></i>
                            <h6 class="text-muted mb-1">{{ __('general.size') }}</h6>
                            <p class="fw-semibold">{{ $shelf->size() }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded text-center">
                            <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                            <h6 class="text-muted mb-1">{{ __('general.price') }}</h6>
                            <p class="fw-semibold">{{ $shelf->price }} {{ __('general.currency') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted mb-1"><i class="far fa-calendar-alt me-2"></i> {{ __('general.created_at') }}</h6>
                            <p class="fw-semibold">{{ $shelf->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted mb-1"><i class="fas fa-user-edit me-2"></i> {{ __('general.last_updated_by') }}</h6>
                            <p class="fw-semibold">{{ $shelf->updated_by ?? __('general.system') }}</p>
                        </div>
                    </div>
                </div>

                {{-- إذا كان عندك علاقة stock items ممكن تضيف جدول صغير --}}
                @if($shelf->stockItems->count() > 0)
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-box-open me-2"></i> {{ __('stock-item.items') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('stock-item.name') }}</th>
                                    <th>{{ __('stock-item.quantity') }}</th>
                                    <th>{{ __('general.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shelf->stockItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                                {{ $item->status ? __('general.active') : __('general.inactive') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('admin.shelves.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
                <div>
                    @ability('admin', 'update_shelves')
                        <a href="{{ route('admin.shelves.edit', $shelf->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                        </a>
                    @endability
                    @ability('admin', 'delete_shelves')
                        <a href="javascript:void(0)" class="btn btn-danger"
                           onclick="confirmDelete('delete-shelf-{{ $shelf->id }}',
                                                 '{{ __('panel.confirm_delete_message') }}',
                                                 '{{ __('panel.yes_delete') }}',
                                                 '{{ __('panel.cancel') }}')">
                            <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                        </a>
                        <form action="{{ route('admin.shelves.destroy', $shelf->id) }}"
                              method="post" class="d-none" id="delete-shelf-{{ $shelf->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endability
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
