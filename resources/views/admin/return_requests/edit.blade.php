@extends('layouts.admin')

@section('style')

<style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: none;
        }
        .card-header {
            background-color: #4a6fdc;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .info-value {
            color: #333;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        .map-container {
            height: 200px;
            border-radius: 8px;
            /* overflow: hidden; */
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        .section-title {
            border-bottom: 2px solid #4a6fdc;
            padding-bottom: 10px;
            margin: 25px 0 15px;
            color: #4a6fdc;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .package-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .product-table {
            font-size: 0.9rem;
        }
        .product-table th {
            background-color: #f1f4f9;
        }
        .sender-info, .receiver-info {
        }
        .coordinates {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>

@endsection

@section('content')




<!-- return_request Form -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-truck-return_request-outline me-1"></i> {{ __('return_request.return_request_info') }}
                </h4>

                @livewire('admin.return-request.edit-return-request-component', ['id' => $return_request->id])

            </div>
        </div>
    </div>
</div>

@endsection
