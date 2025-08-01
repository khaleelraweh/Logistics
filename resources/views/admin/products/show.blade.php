@extends('layouts.admin')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-weight-bold text-primary">{{ __('product.manage_products') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('product.view_product') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('product.manage_products') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 text-black">{{ $product->name }}</h4>
                        <span class="badge bg-light text-dark">{{ $product->status() }}</span>
                    </div>
                    <h6 class="card-subtitle mt-2 text-black-50">{{ $product->merchant->name }}</h6>
                </div>

                <div class="card-body p-0">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        @if($product->photos->count() > 1)
                            <div class="carousel-indicators">
                                @foreach($product->photos as $index => $photo)
                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}"
                                            class="{{ $index == 0 ? 'active' : '' }} bg-primary"
                                            aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index+1 }}"></button>
                                @endforeach
                            </div>
                        @endif

                        <div class="carousel-inner">
                            @forelse($product->photos as $key => $photo)
                                @php
                                    $photoPath = file_exists(public_path('assets/products/' . $photo->file_name))
                                        ? asset('assets/products/' . $photo->file_name)
                                        : asset('images/not_found/item_image_not_found.webp');
                                @endphp
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100 img-fluid rounded-0" style="height: 400px; object-fit: cover;"
                                         src="{{ $photoPath }}" alt="Product photo">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-fluid rounded-0" style="height: 400px; object-fit: cover;"
                                         src="{{ asset('images/not_found/item_image_not_found.webp') }}" alt="No photo">
                                </div>
                            @endforelse
                        </div>

                        @if($product->photos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-success fs-6">{{ $product->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share-alt"></i> مشاركة
                                </button>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-heart"></i> حفظ
                                </button>
                            </div>
                        </div>

                        <div class="product-description mb-4">
                            <h5 class="text-primary mb-3">وصف المنتج</h5>
                            <div class="border p-3 rounded bg-light">
                                {!! $product->description !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">التقييم</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="rating-stars">
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </div>
                                            <span class="ms-2">(4.0)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">المتجر</h6>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Store">
                                            <span>{{ $product->merchant->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                    <div>
                        @ability('admin', 'update_products')
                            <a href="{{ route('admin.products.edit' , $product->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                            </a>
                        @endability
                        @ability('admin', 'delete_products')
                            <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete('delete-product-{{ $product->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')">
                                <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
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
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .carousel-control-prev, .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
    }

    .product-description img {
        max-width: 100%;
        height: auto;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
@endpush
