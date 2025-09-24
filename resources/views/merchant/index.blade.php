@extends('layouts.merchant')

@section('style')
<style>
    #packagesChart {
        max-height: 300px;
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

<!-- Totals -->
<div class="row">
    <div class="col-xl-6 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>{{ __('dashboard.total_packages') }}</h5>
                <h2>{{ $stats['packages_total'] }}</h2>
                <small>📦 {{ $stats['packages_pending'] }} {{ __('dashboard.packages_pending') }} | ✅ {{ $stats['packages_delivered'] }} {{ __('dashboard.packages_delivered') }}</small>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>{{ __('dashboard.warehouses_total') }}</h5>
                <h2>{{ $stats['warehouses_total'] }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>{{ __('dashboard.packages_distribution') }}</h5>
                <canvas id="packagesChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Packages Chart
        new Chart(document.getElementById("packagesChart"), {
            type: 'doughnut',
            data: {
                labels: ["{{ __('dashboard.packages_pending') }}", "{{ __('dashboard.packages_delivered') }}"],
                datasets: [{
                    data: [{{ $stats['packages_pending'] }}, {{ $stats['packages_delivered'] }}],
                    backgroundColor: ["#ffc107", "#28a745"]
                }]
            }
        });
    });
</script>
@endsection
