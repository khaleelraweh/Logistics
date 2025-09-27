@extends('layouts.merchant')

@section('style')
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --info: #4895ef;
        --warning: #f72585;
        --danger: #e63946;
        --light: #f8f9fa;
        --dark: #212529;
    }

    .stat-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        background: white;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .stat-card.success::before { background: linear-gradient(90deg, var(--success), #38b6ff); }
    .stat-card.info::before { background: linear-gradient(90deg, var(--info), #3a86ff); }
    .stat-card.warning::before { background: linear-gradient(90deg, var(--warning), #ff006e); }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: linear-gradient(135deg, currentColor, transparent);
        opacity: 0.9;
    }

    .financial-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }

    .financial-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    }

    .progress-container {
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        overflow: hidden;
    }

    .chart-container {
        position: relative;
        height: 280px;
        margin: 10px 0;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 15px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 20px;
        background: linear-gradient(180deg, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    .table-hover tbody tr {
        transition: all 0.3s ease;
    }

    .table-hover tbody tr:hover {
        background: rgba(67, 97, 238, 0.05);
        transform: scale(1.01);
    }

    .metric-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        border-left: 4px solid var(--primary);
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 10px 0;
    }

    .trend-indicator {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .trend-up { background: rgba(76, 201, 240, 0.2); color: #4cc9f0; }
    .trend-down { background: rgba(230, 57, 70, 0.2); color: #e63946; }

    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }

        .metric-value {
            font-size: 1.5rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }
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
{{-- <div class="row">
    <!-- إجمالي الطرود -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.total_packages') }}</h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['packages_total'] }}</h2>
                        <div class="mt-2">
                            <span class="trend-indicator trend-up">
                                <i class="mdi mdi-trending-up me-1"></i>
                                هذا الشهر: {{ $financialReports['current_month']['packages'] }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="stat-icon text-primary">
                            <i class="mdi mdi-package-variant"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الطرود المسلمة -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.delivered_packages') }}</h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['packages_delivered'] }}</h2>
                        <div class="mt-2">
                            <span class="trend-indicator trend-up">
                                هذا الشهر: {{ $financialReports['current_month']['delivered'] }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="stat-icon text-success">
                            <i class="mdi mdi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي الإيرادات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.total_revenue') }}</h6>
                        <h2 class="mb-0 fw-bold">{{ number_format($financialReports['total_revenue'], 2) }} <small class="fs-6">ر.س</small></h2>
                        <div class="mt-2">
                            <span class="trend-indicator trend-up">
                                هذا الشهر: {{ number_format($financialReports['current_month']['revenue'], 2) }} ر.س
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="stat-icon text-info">
                            <i class="mdi mdi-currency-usd"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المستودعات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.warehouses_total') }}</h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['warehouses_total'] }}</h2>
                        <div class="mt-2">
                            <span class="text-warning fw-semibold">متاح للتخزين</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="stat-icon text-warning">
                            <i class="mdi mdi-warehouse"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <!-- إجمالي الطرود -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted fw-semibold mb-0">{{ __('dashboard.total_packages') }}</h6>
                    <div class="stat-icon text-primary">
                        <i class="mdi mdi-package-variant"></i>
                    </div>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-center">
                    <h2 class="mb-2 fw-bold text-primary">{{ $stats['packages_total'] }}</h2>
                    <div class="mt-auto">
                        <span class="trend-indicator trend-up">
                            <i class="mdi mdi-trending-up me-1"></i>
                            هذا الشهر: {{ $financialReports['current_month']['packages'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الطرود المسلمة -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card success h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted fw-semibold mb-0">{{ __('dashboard.delivered_packages') }}</h6>
                    <div class="stat-icon text-success">
                        <i class="mdi mdi-check-circle"></i>
                    </div>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-center">
                    <h2 class="mb-2 fw-bold text-success">{{ $stats['packages_delivered'] }}</h2>
                    <div class="mt-auto">
                        <span class="trend-indicator trend-up">
                            هذا الشهر: {{ $financialReports['current_month']['delivered'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي الإيرادات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card info h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted fw-semibold mb-0">{{ __('dashboard.total_revenue') }}</h6>
                    <div class="stat-icon text-info">
                        <i class="mdi mdi-currency-usd"></i>
                    </div>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-center">
                    <h2 class="mb-2 fw-bold text-info">
                        {{ number_format($financialReports['total_revenue'], 2) }}
                        <small class="fs-6">ر.س</small>
                    </h2>
                    <div class="mt-auto">
                        <span class="trend-indicator trend-up">
                            هذا الشهر: {{ number_format($financialReports['current_month']['revenue'], 2) }} ر.س
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المستودعات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card warning h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="text-muted fw-semibold mb-0">{{ __('dashboard.warehouses_total') }}</h6>
                    <div class="stat-icon text-warning">
                        <i class="mdi mdi-warehouse"></i>
                    </div>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-center">
                    <h2 class="mb-2 fw-bold text-warning">{{ $stats['warehouses_total'] }}</h2>
                    <div class="mt-auto">
                        <span class="text-warning fw-semibold">متاح للتخزين</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- توزيع الطرود حسب الحالة -->
<div class="row mt-2">
    <div class="col-12">
        <h5 class="section-title">توزيع الطرود حسب الحالة</h5>
    </div>

    @foreach(\App\Models\Package::statuses() as $key => $label)
    <div class="col-xl-2 col-md-3 col-sm-4 col-6 mb-3">
        <div class="metric-card">
            <div class="text-center">
                <small class="text-muted d-block mb-1">{{ $label }}</small>
                <div class="metric-value text-primary">{{ $packageStats[$key] ?? 0 }}</div>
                @php
                    $percentage = $stats['packages_total'] > 0 ? (($packageStats[$key] ?? 0) / $stats['packages_total']) * 100 : 0;
                @endphp
                <div class="progress mt-2" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
                </div>
                <small class="text-muted">{{ number_format($percentage, 1) }}%</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- التقارير المالية -->
<div class="row mt-4">
    <div class="col-12">
        <h5 class="section-title">التقارير المالية</h5>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card financial-card">
            <div class="card-body position-relative">
                <h5 class="text-white mb-4">الوضع المالي</h5>
                <div class="d-flex justify-content-between text-white mb-3 align-items-center">
                    <span>المقبوض:</span>
                    <span class="fw-bold">{{ number_format($financialReports['total_paid'], 2) }} ر.س</span>
                </div>
                <div class="d-flex justify-content-between text-white mb-3 align-items-center">
                    <span>المستحق:</span>
                    <span class="fw-bold">{{ number_format($financialReports['total_due'], 2) }} ر.س</span>
                </div>
                <div class="d-flex justify-content-between text-white mb-4 align-items-center">
                    <span>COD:</span>
                    <span class="fw-bold">{{ number_format($financialReports['total_cod'], 2) }} ر.س</span>
                </div>
                <div class="progress-container">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: {{ $financialReports['total_revenue'] > 0 ? ($financialReports['total_paid'] / $financialReports['total_revenue']) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <small class="text-white-50 mt-2 d-block">نسبة التحصيل: {{ $financialReports['total_revenue'] > 0 ? number_format(($financialReports['total_paid'] / $financialReports['total_revenue']) * 100, 1) : 0 }}%</small>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">طرود قيد التسليم</h5>
                <div class="text-center py-3">
                    <h1 class="text-primary fw-bold display-6">{{ $financialReports['in_transit_packages'] }}</h1>
                    <p class="text-muted">طرود في الطريق</p>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">قيمة الطرود:</span>
                        <span class="fw-semibold">{{ number_format($financialReports['in_transit_value'], 2) }} ر.س</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">COD متوقع:</span>
                        <span class="fw-semibold">{{ number_format($financialReports['in_transit_cod'], 2) }} ر.س</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">التحصيل مع الناقل</h5>
                <div class="text-center py-3">
                    <h1 class="text-success fw-bold display-6">{{ number_format($financialReports['collected_by_carrier'], 2) }}</h1>
                    <p class="text-muted">ريال محصل</p>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">المستحق التحصيل:</span>
                        <span class="fw-semibold text-danger">{{ number_format($financialReports['pending_collection'], 2) }} ر.س</span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        @php
                            $collectionPercentage = ($financialReports['collected_by_carrier'] + $financialReports['pending_collection']) > 0
                                ? ($financialReports['collected_by_carrier'] / ($financialReports['collected_by_carrier'] + $financialReports['pending_collection'])) * 100
                                : 0;
                        @endphp
                        <div class="progress-bar bg-success" style="width: {{ $collectionPercentage }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- المخططات -->
<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="section-title mb-4">{{ __('dashboard.packages_by_status') }}</h5>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="section-title mb-4">طرود حسب طريقة الدفع</h5>
                <div class="chart-container">
                    <canvas id="paymentMethodChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- الطرود الأخيرة -->
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="section-title mb-4">أحدث الطرود</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
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
                                <td>
                                    <span class="fw-semibold text-primary">{{ $package->tracking_number }}</span>
                                </td>
                                <td>{{ $package->receiver_full_name }}</td>
                                <td>
                                    <span class="status-badge bg-{{ $package->statusColor() }}">
                                        {{ $package->statusLabel() }}
                                    </span>
                                </td>
                                <td>{{ $package->payment_method_translated }}</td>
                                <td class="fw-semibold">{{ number_format($package->total_fee, 2) }} ر.س</td>
                                <td>
                                    <span class="text-muted">{{ $package->created_at->format('Y-m-d') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="mdi mdi-package-variant-closed mdi-48px text-muted"></i>
                                    <p class="mt-2 text-muted">لا توجد طرود حديثة</p>
                                </td>
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
                    "#4361ee", "#4cc9f0", "#4895ef", "#f72585",
                    "#e63946", "#3a0ca3", "#7209b7", "#f15bb5",
                    "#2ec4b6", "#ff9f1c", "#6a4c93"
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                    }
                }
            }
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
                backgroundColor: 'rgba(67, 97, 238, 0.8)',
                borderColor: '#4361ee',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endsection
