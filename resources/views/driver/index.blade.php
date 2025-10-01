@extends('layouts.driver')

@section('content')
<div class="container-fluid py-4">
    <!-- رأس الصفحة -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2 text-gray-800">🚗 {{ __('لوحة تحكم السائق') }}</h1>
                    <p class="text-muted">{{ __('مرحباً بعودتك') }}, {{ Auth::user()->name ?? 'سائق' }}</p>
                </div>
                <div class="text-end">
                    <div class="badge bg-primary p-2">
                        <i class="fas fa-clock me-2"></i>
                        {{ now()->format('h:i A - Y/m/d') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- بطاقات الإحصائيات الرئيسية -->
    <div class="row mb-4">
        <!-- المهام النشطة -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('المهام النشطة') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['deliveries']['in_transit'] + $stats['pickups']['accepted'] + $stats['returns']['in_transit'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الطلبات الجديدة -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ __('طلبات جديدة') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['deliveries']['assigned_to_driver'] + $stats['pickups']['pending'] + $stats['returns']['assigned_to_driver'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bell fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- مكتملة اليوم -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ __('مكتملة اليوم') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['today_tasks']['deliveries'] + $stats['today_tasks']['pickups'] + $stats['today_tasks']['returns'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- معدل الإنجاز -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ __('معدل الإنجاز') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $total = array_sum($stats['today_tasks']);
                                    $completed = $stats['deliveries']['delivered'] + $stats['pickups']['completed'] + $stats['returns']['received'];
                                    $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
                                @endphp
                                {{ $rate }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام الرئيسية -->
    <div class="row">
        <!-- قسم التوصيلات -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-shipping-fast me-2"></i>
                        {{ __('التوصيلات') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                    <h4 class="text-warning">{{ $stats['deliveries']['assigned_to_driver'] }}</h4>
                                    <small class="text-muted">{{ __('مسندة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.deliveries.index', ['status' => 'in_transit']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-info mb-2">
                                        <i class="fas fa-truck fa-2x"></i>
                                    </div>
                                    <h4 class="text-info">{{ $stats['deliveries']['in_transit'] }}</h4>
                                    <small class="text-muted">{{ __('قيد التوصيل') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.deliveries.index', ['status' => 'delivered']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-success mb-2">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <h4 class="text-success">{{ $stats['deliveries']['delivered'] }}</h4>
                                    <small class="text-muted">{{ __('مسلّمة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.deliveries.index', ['status' => 'cancelled']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-danger mb-2">
                                        <i class="fas fa-times-circle fa-2x"></i>
                                    </div>
                                    <h4 class="text-danger">{{ $stats['deliveries']['cancelled'] }}</h4>
                                    <small class="text-muted">{{ __('ملغاة') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('driver.deliveries.index') }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-list me-1"></i>
                        {{ __('عرض الكل') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- قسم طلبات الاستلام -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-success text-white py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-box-open me-2"></i>
                        {{ __('طلبات الاستلام') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.pickup_requests.index', ['status' => 'pending']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-hourglass-half fa-2x"></i>
                                    </div>
                                    <h4 class="text-warning">{{ $stats['pickups']['pending'] }}</h4>
                                    <small class="text-muted">{{ __('معلقة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.pickup_requests.index', ['status' => 'accepted']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </div>
                                    <h4 class="text-primary">{{ $stats['pickups']['accepted'] }}</h4>
                                    <small class="text-muted">{{ __('مقبولة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.pickup_requests.index', ['status' => 'completed']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-success mb-2">
                                        <i class="fas fa-flag-checkered fa-2x"></i>
                                    </div>
                                    <h4 class="text-success">{{ $stats['pickups']['completed'] }}</h4>
                                    <small class="text-muted">{{ __('مكتملة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.pickup_requests.index', ['status' => 'cancelled']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-danger mb-2">
                                        <i class="fas fa-ban fa-2x"></i>
                                    </div>
                                    <h4 class="text-danger">{{ $stats['pickups']['cancelled'] }}</h4>
                                    <small class="text-muted">{{ __('ملغاة') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-success btn-sm w-100">
                        <i class="fas fa-list me-1"></i>
                        {{ __('عرض الكل') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- قسم طلبات الإرجاع -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-warning text-dark py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-undo-alt me-2"></i>
                        {{ __('طلبات الإرجاع') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.return_requests.index', ['status' => 'assigned_to_driver']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-sync fa-2x"></i>
                                    </div>
                                    <h4 class="text-warning">{{ $stats['returns']['assigned_to_driver'] }}</h4>
                                    <small class="text-muted">{{ __('مسندة') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.return_requests.index', ['status' => 'picked_up']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-info mb-2">
                                        <i class="fas fa-box fa-2x"></i>
                                    </div>
                                    <h4 class="text-info">{{ $stats['returns']['picked_up'] }}</h4>
                                    <small class="text-muted">{{ __('تم الاستلام') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.return_requests.index', ['status' => 'in_transit']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-truck-loading fa-2x"></i>
                                    </div>
                                    <h4 class="text-primary">{{ $stats['returns']['in_transit'] }}</h4>
                                    <small class="text-muted">{{ __('قيد الإرجاع') }}</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('driver.return_requests.index', ['status' => 'received']) }}" class="text-decoration-none">
                                <div class="stat-card p-3 rounded hover-scale">
                                    <div class="text-success mb-2">
                                        <i class="fas fa-check-double fa-2x"></i>
                                    </div>
                                    <h4 class="text-success">{{ $stats['returns']['received'] }}</h4>
                                    <small class="text-muted">{{ __('مستلمة') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('driver.return_requests.index') }}" class="btn btn-warning btn-sm w-100">
                        <i class="fas fa-list me-1"></i>
                        {{ __('عرض الكل') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- قسم مهام اليوم والروابط السريعة -->
    <div class="row mt-4">
        <!-- مهام اليوم -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-info text-white py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-calendar-day me-2"></i>
                        {{ __('مهام اليوم') }} - {{ now()->translatedFormat('l, j F Y') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="p-3">
                                <div class="text-primary mb-2">
                                    <i class="fas fa-shipping-fast fa-2x"></i>
                                </div>
                                <h3 class="text-primary">{{ $stats['today_tasks']['deliveries'] }}</h3>
                                <small class="text-muted">{{ __('توصيلات') }}</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <div class="text-success mb-2">
                                    <i class="fas fa-box-open fa-2x"></i>
                                </div>
                                <h3 class="text-success">{{ $stats['today_tasks']['pickups'] }}</h3>
                                <small class="text-muted">{{ __('طلبات استلام') }}</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3">
                                <div class="text-warning mb-2">
                                    <i class="fas fa-undo-alt fa-2x"></i>
                                </div>
                                <h3 class="text-warning">{{ $stats['today_tasks']['returns'] }}</h3>
                                <small class="text-muted">{{ __('طلبات إرجاع') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 10px;">
                        @php
                            $totalTasks = array_sum($stats['today_tasks']);
                            $deliveryPercent = $totalTasks > 0 ? ($stats['today_tasks']['deliveries'] / $totalTasks) * 100 : 0;
                            $pickupPercent = $totalTasks > 0 ? ($stats['today_tasks']['pickups'] / $totalTasks) * 100 : 0;
                            $returnPercent = $totalTasks > 0 ? ($stats['today_tasks']['returns'] / $totalTasks) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $deliveryPercent }}%"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pickupPercent }}%"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $returnPercent }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الروابط السريعة -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-dark text-white py-3">
                    <h6 class="m-0 font-weight-bold text-white" >
                        <i class="fas fa-rocket me-2"></i>
                        {{ __('روابط سريعة') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('driver.deliveries.index') }}" class="btn btn-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 quick-link">
                                <i class="fas fa-shipping-fast fa-2x mb-2"></i>
                                <span>{{ __('التوصيلات') }}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 quick-link">
                                <i class="fas fa-box-open fa-2x mb-2"></i>
                                <span>{{ __('طلبات الاستلام') }}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('driver.return_requests.index') }}" class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 quick-link">
                                <i class="fas fa-undo-alt fa-2x mb-2"></i>
                                <span>{{ __('طلبات الإرجاع') }}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('driver.profile') }}" class="btn btn-secondary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 quick-link">
                                <i class="fas fa-user-cog fa-2x mb-2"></i>
                                <span>{{ __('الملف الشخصي') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-scale {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.hover-scale:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-color: #e3f2fd;
}

.quick-link {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.quick-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.stat-card {
    transition: all 0.3s ease;
    border: 1px solid #f8f9fa;
}

.stat-card:hover {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.border-left-primary { border-left: 4px solid #4e73df !important; }
.border-left-success { border-left: 4px solid #1cc88a !important; }
.border-left-info { border-left: 4px solid #36b9cc !important; }
.border-left-warning { border-left: 4px solid #f6c23e !important; }

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    border-radius: 15px;
    color: white;
    margin-bottom: 2rem;
}

.page-header h1 {
    margin-bottom: 0.5rem;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    border-bottom: none;
    font-weight: 600;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}
</style>
@endsection
