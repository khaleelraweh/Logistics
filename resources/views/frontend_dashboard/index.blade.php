@extends('layouts.frontend-dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header Stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                إجمالي السلايدرات الرئيسية</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mainSlidersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                إجمالي الصفحات</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pagesCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                آراء العملاء</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $testimonialsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                الشركاء</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $partnersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Main Content -->
    <div class="row">
        <!-- Content Status Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">حالة المحتوى</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="contentStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">إجراءات سريعة</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('frontend_dashboard.main_sliders.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus me-2"></i>إضافة سلايدر جديد
                        </a>
                        <a href="{{ route('frontend_dashboard.pages.create') }}" class="btn btn-success btn-block">
                            <i class="fas fa-file-alt me-2"></i>إنشاء صفحة جديدة
                        </a>
                        <a href="{{ route('frontend_dashboard.testimonials.create') }}" class="btn btn-info btn-block">
                            <i class="fas fa-comment me-2"></i>إضافة رأي عميل
                        </a>
                        <a href="{{ route('frontend_dashboard.partners.create') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-handshake me-2"></i>إضافة شريك جديد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">أحدث السلايدرات</h6>
                </div>
                <div class="card-body">
                    @foreach($recentSliders as $slider)
                    <div class="mb-3 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="font-weight-bold">{{ $slider->title ?? 'بدون عنوان' }}</h6>
                            <span class="badge badge-{{ $slider->status ? 'success' : 'warning' }}">
                                {{ $slider->status ? 'نشط' : 'غير نشط' }}
                            </span>
                        </div>
                        <small class="text-muted">
                            {{ $slider->created_at->diffForHumans() }}
                        </small>
                    </div>
                    @endforeach
                    @if($recentSliders->isEmpty())
                    <p class="text-muted text-center">لا توجد سلايدرات مضافة</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">أحدث آراء العملاء</h6>
                </div>
                <div class="card-body">
                    @foreach($recentTestimonials as $testimonial)
                    <div class="mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center mb-2">
                            @if($testimonial->image)
                            <img src="{{ asset('assets/testimonials/' . $testimonial->image) }}"
                                 class="rounded-circle me-3" width="40" height="40" alt="{{ $testimonial->name ?? '' }}">
                            @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                                 style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            @endif
                            <div>
                                <h6 class="mb-0">{{ $testimonial->name ?? 'بدون اسم' }}</h6>
                                <small class="text-muted">{{ $testimonial->title ?? '' }}</small>
                            </div>
                        </div>
                        <p class="mb-0 text-muted small">
                            {{ Str::limit($testimonial->content ?? '', 100) }}
                        </p>
                    </div>
                    @endforeach
                    @if($recentTestimonials->isEmpty())
                    <p class="text-muted text-center">لا توجد آراء عملاء</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">حالة النظام</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-list fa-2x text-primary mb-2"></i>
                                <h5>{{ $mainMenusCount }}</h5>
                                <small class="text-muted">القوائم الرئيسية</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-link fa-2x text-success mb-2"></i>
                                <h5>{{ $importantLinksCount }}</h5>
                                <small class="text-muted">روابط مهمة</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-cogs fa-2x text-info mb-2"></i>
                                <h5>{{ $systemFeaturesCount }}</h5>
                                <small class="text-muted">ميزات النظام</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-cubes fa-2x text-warning mb-2"></i>
                                <h5>{{ $systemModulesCount }}</h5>
                                <small class="text-muted">وحدات النظام</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-question-circle fa-2x text-danger mb-2"></i>
                                <h5>{{ $commonQuestionsCount }}</h5>
                                <small class="text-muted">أسئلة شائعة</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-chart-bar fa-2x text-secondary mb-2"></i>
                                <h5>{{ $statisticsCount }}</h5>
                                <small class="text-muted">إحصائيات</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Content Status Chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('contentStatusChart').getContext('2d');
        const contentStatusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['السلايدرات', 'الصفحات', 'آراء العملاء', 'الشركاء', 'القوائم', 'الأسئلة'],
                datasets: [{
                    label: 'المحتوى النشط',
                    data: [
                        {{ $activeMainSliders }},
                        {{ $activePages }},
                        {{ $activeTestimonials }},
                        {{ $activePartners }},
                        {{ $activeMainMenus }},
                        {{ $activeCommonQuestions }}
                    ],
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'المحتوى النشط حسب النوع'
                    }
                }
            }
        });
    });
</script>
@endpush
