@extends('layouts.app')

@section('content')
    @include('frontend.home.main-slider')

    @include('frontend.home.partners')

    @include('frontend.home.quick_access')

    @include('frontend.home.system-features-section')

    @include('frontend.home.system-modules-section')





    {{-- @include('frontend.home.news-events') --}}

    {{-- @include('frontend.home.academic-programs') --}}

    @include('frontend.home.statistics')

    {{-- @include('frontend.home.playlists') --}}

    {{-- @include('frontend.home.albums') --}}



    {{-- d-none --}}
    @include('frontend.home.common_questions')

    {{-- d-none --}}
    @include('frontend.home.testimonial')
@endsection
