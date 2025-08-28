@extends('layouts.admin')

@section('content')


<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('return_request.edit_return_request') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('return_request.edit_return_request') }}</li>
                    </ol>
                </nav>
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
