@extends('layouts.admin')

@section('content')

<!-- Page Title -->
<div class="row mb-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('return_request.edit_return_request') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('return_request.edit_return_request') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
