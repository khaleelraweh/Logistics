@extends('layouts.driver')

@section('content')
<div class="container">
    <h4 class="mb-4">{{ __('لوحة تحكم السائق') }}</h4>

    <!-- إحصائيات التوصيلات -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-3 text-primary">📦 {{ __('إحصائيات التوصيلات') }}</h5>
        </div>

        <!-- بطاقة الطرود المسندة -->
        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">🔄 {{ __('مسندة') }}</h6>
                    <p class="display-6 text-warning">{{ $stats['deliveries']['assigned_to_driver'] }}</p>
                    <small class="text-muted">{{ __('في انتظار الاستلام') }}</small>
                </div>
            </a>
        </div>

        <!-- بطاقة قيد التوصيل -->
        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'in_transit']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">🚚 {{ __('قيد التوصيل') }}</h6>
                    <p class="display-6 text-info">{{ $stats['deliveries']['in_transit'] }}</p>
                    <small class="text-muted">{{ __('جاري التوصيل') }}</small>
                </div>
            </a>
        </div>

        <!-- بطاقة الطرود المسلّمة -->
        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'delivered']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">✅ {{ __('مسلّمة') }}</h6>
                    <p class="display-6 text-success">{{ $stats['deliveries']['delivered'] }}</p>
                    <small class="text-muted">{{ __('تم التسليم') }}</small>
                </div>
            </a>
        </div>

        <!-- بطاقة الملغاة -->
        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.deliveries.index', ['status' => 'cancelled']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">❌ {{ __('ملغاة') }}</h6>
                    <p class="display-6 text-danger">{{ $stats['deliveries']['cancelled'] }}</p>
                    <small class="text-muted">{{ __('تم الإلغاء') }}</small>
                </div>
            </a>
        </div>
    </div>

    <!-- إحصائيات طلبات الاستلام -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-3 text-success">📥 {{ __('إحصائيات طلبات الاستلام') }}</h5>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.pickup_requests.index', ['status' => 'pending']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">⏳ {{ __('معلقة') }}</h6>
                    <p class="display-6 text-warning">{{ $stats['pickups']['pending'] }}</p>
                    <small class="text-muted">{{ __('في انتظار القبول') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.pickup_requests.index', ['status' => 'accepted']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">✅ {{ __('مقبولة') }}</h6>
                    <p class="display-6 text-primary">{{ $stats['pickups']['accepted'] }}</p>
                    <small class="text-muted">{{ __('جاهزة للاستلام') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.pickup_requests.index', ['status' => 'completed']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">🏁 {{ __('مكتملة') }}</h6>
                    <p class="display-6 text-success">{{ $stats['pickups']['completed'] }}</p>
                    <small class="text-muted">{{ __('تم الاستلام') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.pickup_requests.index', ['status' => 'cancelled']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">❌ {{ __('ملغاة') }}</h6>
                    <p class="display-6 text-danger">{{ $stats['pickups']['cancelled'] }}</p>
                    <small class="text-muted">{{ __('تم الإلغاء') }}</small>
                </div>
            </a>
        </div>
    </div>

    <!-- إحصائيات طلبات الإرجاع -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-3 text-warning">📤 {{ __('إحصائيات طلبات الإرجاع') }}</h5>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.return_requests.index', ['status' => 'assigned_to_driver']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">🔄 {{ __('مسندة') }}</h6>
                    <p class="display-6 text-warning">{{ $stats['returns']['assigned_to_driver'] }}</p>
                    <small class="text-muted">{{ __('في انتظار الاستلام') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.return_requests.index', ['status' => 'picked_up']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">📦 {{ __('تم الاستلام') }}</h6>
                    <p class="display-6 text-info">{{ $stats['returns']['picked_up'] }}</p>
                    <small class="text-muted">{{ __('جاري الإرجاع') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.return_requests.index', ['status' => 'in_transit']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">🚚 {{ __('قيد الإرجاع') }}</h6>
                    <p class="display-6 text-primary">{{ $stats['returns']['in_transit'] }}</p>
                    <small class="text-muted">{{ __('في الطريق') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('driver.return_requests.index', ['status' => 'received']) }}" class="card text-center shadow-sm text-decoration-none text-dark h-100">
                <div class="card-body">
                    <h6 class="card-title">✅ {{ __('مستلمة') }}</h6>
                    <p class="display-6 text-success">{{ $stats['returns']['received'] }}</p>
                    <small class="text-muted">{{ __('تم الإرجاع') }}</small>
                </div>
            </a>
        </div>
    </div>

    <!-- روابط سريعة -->
    <div class="row mt-5">
        <div class="col-12">
            <h5 class="mb-3">{{ __('روابط سريعة') }}</h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('driver.deliveries.index') }}" class="btn btn-primary">
                    <i class="fas fa-shipping-fast"></i> {{ __('جميع التوصيلات') }}
                </a>
                <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-success">
                    <i class="fas fa-box-open"></i> {{ __('طلبات الاستلام') }}
                </a>
                <a href="{{ route('driver.return_requests.index') }}" class="btn btn-warning">
                    <i class="fas fa-undo-alt"></i> {{ __('طلبات الإرجاع') }}
                </a>
                <a href="{{ route('driver.profile') }}" class="btn btn-secondary">
                    <i class="fas fa-user"></i> {{ __('الملف الشخصي') }}
                </a>
                <a href="#" class="btn btn-info">
                    <i class="fas fa-map-marker-alt"></i> {{ __('عرض الخريطة') }}
                </a>
                {{-- <a href="{{ route('driver.today-tasks') }}" class="btn btn-dark"> --}}
                <a href="#" class="btn btn-dark">
                    <i class="fas fa-tasks"></i> {{ __('مهام اليوم') }}
                </a>
            </div>
        </div>
    </div>

    <!-- مهام اليوم -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">📋 {{ __('مهام اليوم') }} - {{ now()->format('Y-m-d') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h6 class="text-primary">{{ $stats['today_tasks']['deliveries'] }}</h6>
                            <small>توصيلات اليوم</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-success">{{ $stats['today_tasks']['pickups'] }}</h6>
                            <small>طلبات استلام</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-warning">{{ $stats['today_tasks']['returns'] }}</h6>
                            <small>طلبات إرجاع</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
