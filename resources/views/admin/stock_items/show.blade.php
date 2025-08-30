@extends('layouts.admin')
@section('style')
    <style>
        :root {
            --primary: #4361ee;
            --primary-gradient: linear-gradient(120deg, #4361ee 0%, #3a0ca3 100%);
            --success: #4cc9f0;
            --danger: #e63946;
            --light-bg: #f8f9fa;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: var(--primary-gradient);
            border-bottom: none;
            padding: 1.5rem;
        }

        .detail-card {
            border-left: 4px solid var(--primary);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
        }

        .section-title {
            position: relative;
            padding-right: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
            font-weight: 600;
        }

        .section-title i {
            margin-left: 0.5rem;
        }

        .section-title::before {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .btn-action {
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-back {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }

        .btn-back:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        /* تأثيرات تفاعلية */
        .hover-lift {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* وسائط متجاوبة */
        @media (max-width: 768px) {
            .btn-action {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-12">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="mb-0"><i class="fas fa-box-open me-2"></i>{{ __('stock-item.item_details') }} #{{ $stockItem->id }}</h4>
                            <span class="status-badge badge bg-{{ $stockItem->status ? 'success' : 'danger' }}">
                                {{ $stockItem->status ? __('general.active') : __('general.inactive') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- معلومات التاجر والمنتج -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded detail-card hover-lift">
                                    <div class="info-label">{{ __('merchant.name') }}</div>
                                    <div class="info-value">{{ $stockItem->merchant->name ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded detail-card hover-lift">
                                    <div class="info-label">{{ __('product.name') }}</div>
                                    <div class="info-value">{{ $stockItem->product->name ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات الكمية والتاريخ -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded detail-card hover-lift">
                                    <div class="info-label">{{ __('stock-item.quantity') }}</div>
                                    <div class="info-value">{{ $stockItem->quantity }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded detail-card hover-lift">
                                    <div class="info-label">{{ __('general.published_on') }}</div>
                                    <div class="info-value">{{ $stockItem->published_on?->format('Y-m-d') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات الرف إذا وجدت -->
                        @if($stockItem->rentalShelf)
                            <div class="mt-4 pt-4 border-top">
                                <h5 class="section-title">
                                    <i class="fas fa-warehouse"></i> {{ __('rental.shelf_info') }}
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 bg-light rounded detail-card hover-lift">
                                            <div class="info-label">{{ __('shelf.code') }}</div>
                                            <div class="info-value">{{ $stockItem->rentalShelf->shelf->code ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 bg-light rounded detail-card hover-lift">
                                            <div class="info-label">{{ __('warehouse.name') }}</div>
                                            <div class="info-value">{{ $stockItem->rentalShelf->shelf->warehouse->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 bg-light rounded detail-card hover-lift">
                                            <div class="info-label">{{ __('rental.custom_start') }}</div>
                                            <div class="info-value">
                                                {{ $stockItem->rentalShelf?->custom_start
                                                    ? \Carbon\Carbon::parse($stockItem->rentalShelf->custom_start)->format('Y-m-d')
                                                    : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 bg-light rounded detail-card hover-lift">
                                            <div class="info-label">{{ __('rental.custom_end') }}</div>
                                            <div class="info-value">
                                                {{ $stockItem->rentalShelf?->custom_end
                                                    ? \Carbon\Carbon::parse($stockItem->rentalShelf->custom_end)->format('Y-m-d')
                                                    : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <a href="{{ route('admin.stock_items.index') }}" class="btn btn-action btn-back">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                            </a>
                            <div class="d-flex gap-2 mt-2 mt-md-0">
                                @ability('admin', 'update_stock_items')
                                    <a href="{{ route('admin.stock_items.edit', $stockItem->id) }}" class="btn btn-action btn-primary">
                                        <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                                    </a>
                                @endability
                                {{-- @ability('admin', 'delete_stock_items')
                                    <a href="javascript:void(0)" class="btn btn-action btn-danger"
                                       onclick="confirmDelete('delete-stockItem-{{ $stockItem->id }}',
                                                             '{{ __('panel.confirm_delete_message') }}',
                                                             '{{ __('panel.yes_delete') }}',
                                                             '{{ __('panel.cancel') }}')">
                                        <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                                    </a>
                                    <form action="{{ route('admin.stock_items.destroy', $stockItem->id) }}"
                                          method="post" class="d-none" id="delete-stockItem-{{ $stockItem->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endability --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- نافذة تأكيد الحذف -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('panel.confirm_delete_message') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('panel.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">{{ __('panel.yes_delete') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(formId, message, yesText, cancelText) {
            // تحديث نصوص النافذة
            document.querySelector('#confirmDeleteModal .modal-body p').textContent = message;
            document.querySelector('#confirmDeleteModal .modal-footer .btn-danger').textContent = yesText;
            document.querySelector('#confirmDeleteModal .modal-footer .btn-secondary').textContent = cancelText;

            // إضافة معالج الحدث للزر تأكيد الحذف
            document.getElementById('confirmDeleteButton').onclick = function() {
                document.getElementById(formId).submit();
            };

            // عرض النموذج
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        }
    </script>
@endsection



