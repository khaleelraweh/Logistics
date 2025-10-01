@extends('layouts.merchant')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('merchant.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h4>Basic Info</h4>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', auth()->user()->mobile) }}">
            </div>

            <div class="form-group">
                <label>New Password (optional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="user_image" class="form-control">
                @if(auth()->user()->user_image)
                    <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}" class="mt-2" width="100" />
                @endif
            </div>

            <hr>
            <h4>Social Links</h4>
            @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                <div class="form-group">
                    <label>{{ ucfirst($social) }}</label>
                    <input type="text" name="{{ $social }}" class="form-control" value="{{ old($social, auth()->user()->$social) }}">
                </div>
            @endforeach

            <hr>
            <h4>Description (Translatable)</h4>
            <div class="form-group">
                <label>Arabic</label>
                <textarea name="description[ar]" class="form-control">{{ old('description.ar', auth()->user()->getTranslation('description', 'ar')) }}</textarea>
            </div>
            <div class="form-group">
                <label>English</label>
                <textarea name="description[en]" class="form-control">{{ old('description.en', auth()->user()->getTranslation('description', 'en')) }}</textarea>
            </div>

            <h4>Motivation (Translatable)</h4>
            <div class="form-group">
                <label>Arabic</label>
                <textarea name="motavation[ar]" class="form-control">{{ old('motavation.ar', auth()->user()->getTranslation('motavation', 'ar')) }}</textarea>
            </div>
            <div class="form-group">
                <label>English</label>
                <textarea name="motavation[en]" class="form-control">{{ old('motavation.en', auth()->user()->getTranslation('motavation', 'en')) }}</textarea>
            </div>

            <button class="btn btn-success mt-3">Save Changes</button>
        </form>
    </div>
</div>
@endsection
