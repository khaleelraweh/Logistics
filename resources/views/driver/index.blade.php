@extends('layouts.driver')

@section('content')
<div class="container">
    <h4 class="mb-4">{{ __('لوحة تحكم السائق') }}</h4>

    <div class="row">
        <!-- بطاقة الطرود المسندة -->
        <div class="col-md-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}" class="card text-center shadow-sm text-decoration-none text-dark">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">📦 {{ __('الطرود المسندة') }}</h5>
                        <p class="display-6">{{ $stats['assigned_packages'] }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة قيد التوصيل -->
        <div class="col-md-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'in_transit']) }}" class="card text-center shadow-sm text-decoration-none text-dark">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">🚚 {{ __('قيد التوصيل') }}</h5>
                        <p class="display-6">{{ $stats['in_progress'] }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة الطرود المسلّمة -->
        <div class="col-md-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'delivered']) }}" class="card text-center shadow-sm text-decoration-none text-dark">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">✅ {{ __('المسلّمة') }}</h5>
                        <p class="display-6">{{ $stats['delivered'] }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة الملغاة -->
        <div class="col-md-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'cancelled']) }}" class="card text-center shadow-sm text-decoration-none text-dark">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">❌ {{ __('الملغاة') }}</h5>
                        <p class="display-6">{{ $stats['canceled'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- روابط سريعة -->
    <div class="mt-5">
        <h5>{{ __('روابط سريعة') }}</h5>
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('driver.deliveries.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> {{ __('قائمة التوصيلات') }}
            </a>
            <a href="{{ route('driver.profile') }}" class="btn btn-secondary">
                <i class="fas fa-user"></i> {{ __('الملف الشخصي') }}
            </a>
            {{-- <a href="{{ route('driver.map') }}" class="btn btn-success">
                <i class="fas fa-map-marker-alt"></i> {{ __('عرض الخريطة') }}
            </a> --}}
            <a href="#" class="btn btn-success">
                <i class="fas fa-map-marker-alt"></i> {{ __('عرض الخريطة') }}
            </a>
        </div>
    </div>
</div>
@endsection
