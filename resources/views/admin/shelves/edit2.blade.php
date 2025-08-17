@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('shelf.manage_shelves') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('shelf.edit_shelf') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('shelf.manage_shelves') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('shelf.shelf_info') }}</h4>

                            <form action="{{ route('admin.shelves.update', $shelf->id) }}" method="POST" >
                                @csrf
                                @method('PATCH')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="code">{{ __('shelf.code') }}</label>
                                    <div class="col-sm-10">
                                        <input name="code" class="form-control" id="code" type="text" value="{{ old('code' , $shelf->code) }}">
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="warehouse_id">{{ __('warehouse.name') }}</label>
                                    <div class="col-sm-10">
                                        <select name="warehouse_id" class="form-control select2">
                                            <option>{{ __('shelf.select_warehouse') }}</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id' , $shelf->warehouse_id) == $warehouse->id ? 'selected' : null }}>{{ $warehouse->name }} - {{ $warehouse->code }}</option>
                                            @endforeach
                                        </select>

                                        @error('warehouse_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="description">{{ __('shelf.description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="tinymceExample" rows="10" class="form-control">{!! old('description' , $shelf->description) !!}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="size">{{ __('shelf.size') }}</label>
                                    <div class="col-sm-10">
                                         <select name="size" class="form-control select2">
                                            <option>{{ __('shelf.select_size') }}</option>
                                            <option value="small" {{ old('size' , $shelf->size) == 'small' ? 'selected' : null }}>
                                                {{ __('general.small') }}
                                            </option>
                                            <option value="medium" {{ old('size' , $shelf->size) == 'medium' ? 'selected' : null }}>
                                                {{ __('general.medium') }}
                                            </option>
                                            <option value="large" {{ old('size' , $shelf->size) == 'large' ? 'selected' : null }}>
                                                {{ __('general.large') }}
                                            </option>
                                        </select>
                                        @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="price">{{ __('shelf.price') }}</label>
                                    <div class="col-sm-10">
                                        <input name="price" class="form-control" id="price" type="text" value="{{ old('price' , $shelf->price) }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-switch" >
                                            <input type="checkbox" class="form-check-input" name="status"  id="customSwitch1"  {{ old('status', $shelf->status) == '1' ? 'checked' : '' }} >
                                            <label class="form-check-label" for="customSwitch1">{{ __('shelf.choose_shelf_status') }}</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                @ability('admin', 'update_shelves')
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">{{ __('shelf.update_shelf_data') }}</button>
                                    </div>
                                @endability

                            </form>

                        </div>
                    </div>
                </div>
            </div>

@endsection


@section('script')
    {{-- Call select2 plugin --}}

    <script>
        $(function() {
            $("#shelf_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });
        });
    </script>
@endsection
