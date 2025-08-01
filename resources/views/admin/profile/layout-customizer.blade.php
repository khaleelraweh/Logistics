@extends('layouts.admin')

@section('content')
    @livewire('admin.profile.layout-customizer-component')
@endsection

{{-- @section('script')
    <style>
        html:not(.loaded) {
            visibility: hidden;
            opacity: 0;
        }
    </style>
    <script>
        document.documentElement.classList.add('loaded');
    </script>
 @endsection --}}
