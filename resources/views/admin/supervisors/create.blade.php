@extends('layouts.admin')
@section('title', __('supervisor.supervisors'))

@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
@endsection

@section('content')

 <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('supervisor.add_supervisor') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.supervisors.index') }}">{{ __('supervisor.manage_supervisors') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('supervisor.add_supervisor') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<div class="card shadow mb-4">

    {{-- menu part --}}


    {{-- body part --}}
    <div class="card-body">
        <form action="{{route('admin.supervisors.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="first_name">{{ __('supervisor.first_name') }}</label>
                        <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" class="form-control" placeholder="{{ __('supervisor.first_name') }}">
                        @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="last_name">{{ __('supervisor.last_name') }}</label>
                        <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="{{ __('supervisor.last_name') }}">
                        @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="username">{{ __('supervisor.username') }}</label>
                        <input type="text" id="username" name="username" value="{{old('username')}}" class="form-control" placeholder="{{ __('supervisor.username') }}">
                        @error('username') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="email">{{ __('supervisor.email') }}</label>
                        <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="{{ __('supervisor.email') }}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row pt-3">
                <div class="col-3">
                    <div class="form-group">
                        <label for="mobile">{{ __('supervisor.mobile') }}</label>
                        <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="{{ __('supervisor.mobile') }}">
                        @error('mobile') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="password">{{ __('supervisor.password') }}</label>
                        <input type="text" id="password" name="password" value="{{old('password')}}" class="form-control" placeholder="{{ __('supervisor.password') }}">
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="col-3">
                    <label for="status">{{ __('supervisor.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : null}}>{{ __('supervisor.active') }}</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : null}}>{{ __('supervisor.inactive') }}</option>
                    </select>
                    @error('status')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="col-3"></div>
            </div>

            {{-- permissions --}}
            <div class="row pt-4">
                <div class="col-12">
                    <label for="permissions">{{ __('supervisor.permissions') }}</label>
                    <select name="permissions[]" class="form-control select2" multiple="multiple">
                        @forelse ($permissions as $permission)
                            <option value="{{$permission->id}}"  {{ in_array($permission->id,old('permissions',[])) ? 'selected' : null }}>{{$permission->display_name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>

            {{-- user image --}}
            <div class="row pt-4">
                <div class="col-12">
                    <label for="user_image">{{ __('supervisor.user_image') }}</label>
                    <br>
                    <div class="file-loading">
                        <input type="file" name="user_image" id="supervisor-image"  class="file-input-overview ">
                        <span class="form-text text-muted">{{ __('supervisor.image_hint') }}</span>
                        @error('user_image')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                <button type="submit" name="submit" class="btn btn-primary">{{ __('supervisor.add') }}</button>
            </div>

        </form>
    </div>

</div>

@endsection

@section('script')
    <script src="{{asset('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        function matchStart(params, data) {
            if ($.trim(params.term) === '') return data;
            if (typeof data.children === 'undefined') return null;

            var filteredChildren = [];
            $.each(data.children, function (idx, child) {
                if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                    filteredChildren.push(child);
                }
            });

            if (filteredChildren.length) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.children = filteredChildren;
                return modifiedData;
            }
            return null;
        }

        $(".select2").select2({
            tags:true,
            colseOnSelect:false,
            minimumResultsForSearch: Infinity,
            matcher: matchStart
        });

        $(function(){
            $("#supervisor-image").fileinput({
                theme:"fa5",
                maxFileCount: 1 ,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial:false,
                 rtl: @json(app()->getLocale() == 'ar'),
                language: @json(app()->getLocale() == 'ar' ? 'ar' : 'en')
            })
        });
    </script>
@endsection
