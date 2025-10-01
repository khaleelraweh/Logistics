@extends('layouts.admin')
@section('title', __('supervisor.supervisors'))

@section('style')
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
@endsection

@section('content')

<div class="card shadow mb-4">

    {{-- menu part --}}
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('supervisor.edit_supervisor') }} {{$supervisor->full_name}}</h6>
        <div class="ml-auto">
            <a href="{{route('admin.supervisors.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">{{ __('supervisor.supervisors') }}</span>
            </a>
        </div>
    </div>

    {{-- body part --}}
    <div class="card-body">
        <form action="{{route('admin.supervisors.update',$supervisor->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="first_name">{{ __('supervisor.first_name') }}</label>
                        <input type="text" id="first_name" name="first_name" value="{{old('first_name',$supervisor->first_name)}}" class="form-control" placeholder="{{ __('supervisor.first_name') }}">
                        @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="last_name">{{ __('supervisor.last_name') }}</label>
                        <input type="text" id="last_name" name="last_name" value="{{old('last_name',$supervisor->last_name)}}" class="form-control" placeholder="{{ __('supervisor.last_name') }}">
                        @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="username">{{ __('supervisor.username') }}</label>
                        <input type="text" id="username" name="username" value="{{old('username',$supervisor->username)}}" class="form-control" placeholder="{{ __('supervisor.username') }}">
                        @error('username') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="email">{{ __('supervisor.email') }}</label>
                        <input type="text" id="email" name="email" value="{{old('email',$supervisor->email)}}" class="form-control" placeholder="{{ __('supervisor.email') }}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row pt-3">
                <div class="col-3">
                    <div class="form-group">
                        <label for="mobile">{{ __('supervisor.mobile') }}</label>
                        <input type="text" id="mobile" name="mobile" value="{{old('mobile',$supervisor->mobile)}}" class="form-control" placeholder="{{ __('supervisor.mobile') }}">
                        @error('mobile') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="password">{{ __('supervisor.password') }}</label>
                        <input type="text" id="password" name="password" value="" class="form-control" placeholder="{{ __('supervisor.password') }}">
                        <small class="form-text text-muted">{{ __('supervisor.password_hint') }}</small>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="col-3">
                    <label for="status">{{ __('supervisor.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="1" {{ old('status',$supervisor->status) == '1' ? 'selected' : null}}>{{ __('supervisor.active') }}</option>
                        <option value="0" {{ old('status',$supervisor->status) == '0' ? 'selected' : null}}>{{ __('supervisor.inactive') }}</option>
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
                            <option value="{{$permission->id}}"  {{ in_array($permission->id,old('permissions',$supervisorPermissions)) ? 'selected' : null }}>{{$permission->display_name}}</option>
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
                <button type="submit" name="submit" class="btn btn-primary">{{ __('supervisor.update') }}</button>
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
            language: @json(app()->getLocale() == 'ar' ? 'ar' : 'en') ,
            initialPreview: [
                @if($supervisor->user_image !='')
                "{{ asset('assets/users/' . $supervisor->user_image)}}",
                @endif
            ],
            initialPreviewAsData:true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                @if($supervisor->user_image !='')
                {
                    caption: "{{$supervisor->user_image }}",
                    size: '1111' ,
                    width: "120px" ,
                    url: "{{route('admin.supervisors.remove_image' , ['supervisor_id'=>$supervisor->id , '_token'=> csrf_token()]) }}",
                    key:{{ $supervisor->id}}
                }
                @endif
            ]
        });
    });
</script>
@endsection
