@extends('layouts.merchant')

@section('style')
<style>
    .stat-card {
        border-left: 4px solid;
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
    }
    .financial-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .progress-sm {
        height: 5px;
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
</style>
@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('dashboard.dashboard') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('dashboard.logestics') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- البطاقات الإحصائية الرئيسية -->
<div class="row">
    <!-- إجمالي الطرود -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-left-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="text-muted fw-normal">{{ __('dashboard.total_packages') }}</h5>
                        <h2 class="mb-0">{{ $stats['packages_total'] }}</h2>
                        <small class="text-success">
                            <i class="mdi mdi-trending-up"></i>
                            هذا الشهر: {{ $financialReports['current_month']['packages'] }}
                        </small>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-sm rounded-circle bg-primary bg-soft d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-package-variant text-primary font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الطرود المسلمة -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-left-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="text-muted fw-normal">{{ __('dashboard.delivered_packages') }}</h5>
                        <h2 class="mb-0">{{ $stats['packages_delivered'] }}</h2>
                        <small class="text-success">
                            هذا الشهر: {{ $financialReports['current_month']['delivered'] }}
                        </small>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-sm rounded-circle bg-success bg-soft d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-check-circle text-success font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي الإيرادات -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-left-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="text-muted fw-normal">{{ __('dashboard.total_revenue') }}</h5>
                        <h2 class="mb-0">{{ number_format($financialReports['total_revenue'], 2) }} ر.س</h2>
                        <small class="text-info">
                            هذا الشهر: {{ number_format($financialReports['current_month']['revenue'], 2) }} ر.س
                        </small>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-sm rounded-circle bg-info bg-soft d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-currency-usd text-info font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المستودعات -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-left-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="text-muted fw-normal">{{ __('dashboard.warehouses_total') }}</h5>
                        <h2 class="mb-0">{{ $stats['warehouses_total'] }}</h2>
                        <small class="text-warning">متاح للتخزين</small>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-sm rounded-circle bg-warning bg-soft d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-warehouse text-warning font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cards for each status -->
<div class="row mt-4">
    @foreach(\App\Models\Package::statuses() as $key => $label)
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>{{ $label }}</h6>
                    <h3>{{ $packageStats[$key] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- التقارير المالية -->
<div class="row mt-4">
    <div class="col-lg-4">
        <div class="card financial-card">
            <div class="card-body">
                <h5 class="text-white">الوضع المالي</h5>
                <div class="d-flex justify-content-between text-white mb-2">
                    <span>المقبوض:</span>
                    <span>{{ number_format($financialReports['total_paid'], 2) }} ر.س</span>
                </div>
                <div class="d-flex justify-content-between text-white mb-2">
                    <span>المستحق:</span>
                    <span>{{ number_format($financialReports['total_due'], 2) }} ر.س</span>
                </div>
                <div class="d-flex justify-content-between text-white mb-2">
                    <span>COD:</span>
                    <span>{{ number_format($financialReports['total_cod'], 2) }} ر.س</span>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-success" style="width: {{ $financialReports['total_revenue'] > 0 ? ($financialReports['total_paid'] / $financialReports['total_revenue']) * 100 : 0 }}%"></div>
                </div>
                <small class="text-white-50">نسبة التحصيل: {{ $financialReports['total_revenue'] > 0 ? number_format(($financialReports['total_paid'] / $financialReports['total_revenue']) * 100, 1) : 0 }}%</small>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5>طرود قيد التسليم</h5>
                <h3 class="text-primary">{{ $financialReports['in_transit_packages'] }}</h3>
                <div class="mt-3">
                    <small class="text-muted">قيمة الطرود: {{ number_format($financialReports['in_transit_value'], 2) }} ر.س</small><br>
                    <small class="text-muted">COD متوقع: {{ number_format($financialReports['in_transit_cod'], 2) }} ر.س</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5>التحصيل مع الناقل</h5>
                <h3 class="text-success">{{ number_format($financialReports['collected_by_carrier'], 2) }} ر.س</h3>
                <div class="mt-3">
                    <small class="text-muted">المستحق التحصيل: {{ number_format($financialReports['pending_collection'], 2) }} ر.س</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chart-container {
    position: relative;
    height: 250px !important;
}

</style>
<!-- توزيع الطرود حسب الحالة -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>{{ __('dashboard.packages_by_status') }}</h5>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>طرود حسب طريقة الدفع</h5>
                <div class="chart-container">
                    <canvas id="paymentMethodChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- الطرود الأخيرة -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5>أحدث الطرود</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم التتبع</th>
                                <th>المستلم</th>
                                <th>الحالة</th>
                                <th>طريقة الدفع</th>
                                <th>القيمة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPackages as $package)
                            <tr>
                                <td>{{ $package->tracking_number }}</td>
                                <td>{{ $package->receiver_full_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $package->statusColor() }}">
                                        {{ $package->statusLabel() }}
                                    </span>
                                </td>
                                <td>{{ $package->payment_method_translated }}</td>
                                <td>{{ number_format($package->total_fee, 2) }} ر.س</td>
                                <td>{{ $package->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">لا توجد طرود حديثة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // مخطط توزيع الحالات
    const statusCtx = document.getElementById("statusChart").getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_values(\App\Models\Package::statuses())) !!},
            datasets: [{
                data: {!! json_encode(array_map(fn($status) => $packageStats[$status] ?? 0, array_keys(\App\Models\Package::statuses()))) !!},
                backgroundColor: [
                    "#ffc107", "#28a745", "#dc3545", "#6c757d",
                    "#17a2b8", "#007bff", "#6610f2", "#e83e8c",
                    "#20c997", "#fd7e14", "#6f42c1"
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // مخطط طرق الدفع
    const paymentCtx = document.getElementById("paymentMethodChart").getContext('2d');
    const paymentData = {!! json_encode($financialReports['payment_methods']) !!};

    new Chart(paymentCtx, {
        type: 'bar',
        data: {
            labels: paymentData.map(item => {
                const methods = {
                    'prepaid': 'مسبق الدفع',
                    'cash_on_delivery': 'الدفع عند الاستلام',
                    'exchange': 'تبديل',
                    'bring': 'إحضار'
                };
                return methods[item.payment_method] || item.payment_method;
            }),
            datasets: [{
                label: 'عدد الطرود',
                data: paymentData.map(item => item.count),
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
