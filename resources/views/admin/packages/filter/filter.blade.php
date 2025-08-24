<div class="card-body">
    <form action="{{route('admin.packages.index')}}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{old('keyword',request()->input('keyword'))}}" class="form-control" placeholder="search here">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                       <select name="status"  class="form-select">
                            <option value="">{{ __('package.all_statuses') }}</option>
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                </div>
            </div>
            {{-- <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="id" {{old('sort_by',request()->input('sort_by')) == 'id' ? 'selected' : ''}}>ID</option>
                        <option value="name" {{old('sort_by',request()->input('sort_by')) == 'name' ? 'selected' : ''}}>Name</option>
                        <option value="created_at" {{old('sort_by',request()->input('sort_by')) == 'created_at' ? 'selected' : ''}}>Created at</option>
                    </select>
                </div>
            </div> --}}

            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>

                        {{-- أساسية --}}
                        <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="tracking_number" {{ request('sort_by') == 'tracking_number' ? 'selected' : '' }}>
                            {{ __('package.tracking_number') }}
                        </option>
                        <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>
                            {{ __('package.status') }}
                        </option>
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                            {{ __('package.created_at') }}
                        </option>
                        <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>
                            {{ __('package.updated_at') }}
                        </option>

                        {{-- بيانات المرسل --}}
                        <option value="sender_first_name" {{ request('sort_by') == 'sender_first_name' ? 'selected' : '' }}>
                            {{ __('package.sender_first_name') }}
                        </option>
                        <option value="sender_phone" {{ request('sort_by') == 'sender_phone' ? 'selected' : '' }}>
                            {{ __('package.sender_phone') }}
                        </option>
                        <option value="sender_city" {{ request('sort_by') == 'sender_city' ? 'selected' : '' }}>
                            {{ __('package.sender_city') }}
                        </option>

                        {{-- بيانات المستلم --}}
                        <option value="receiver_first_name" {{ request('sort_by') == 'receiver_first_name' ? 'selected' : '' }}>
                            {{ __('package.receiver_first_name') }}
                        </option>
                        <option value="receiver_phone" {{ request('sort_by') == 'receiver_phone' ? 'selected' : '' }}>
                            {{ __('package.receiver_phone') }}
                        </option>
                        <option value="receiver_city" {{ request('sort_by') == 'receiver_city' ? 'selected' : '' }}>
                            {{ __('package.receiver_city') }}
                        </option>

                        {{-- بيانات الطرد --}}
                        <option value="weight" {{ request('sort_by') == 'weight' ? 'selected' : '' }}>
                            {{ __('package.weight') }}
                        </option>
                        <option value="quantity" {{ request('sort_by') == 'quantity' ? 'selected' : '' }}>
                            {{ __('package.quantity') }}
                        </option>
                        <option value="delivery_fee" {{ request('sort_by') == 'delivery_fee' ? 'selected' : '' }}>
                            {{ __('package.delivery_fee') }}
                        </option>
                        <option value="cod_amount" {{ request('sort_by') == 'cod_amount' ? 'selected' : '' }}>
                            {{ __('package.cod_amount') }}
                        </option>
                        <option value="total_fee" {{ request('sort_by') == 'total_fee' ? 'selected' : '' }}>
                            {{ __('package.total_fee') }}
                        </option>

                        {{-- بيانات أخرى --}}
                        <option value="delivery_date" {{ request('sort_by') == 'delivery_date' ? 'selected' : '' }}>
                            {{ __('package.delivery_date') }}
                        </option>
                        <option value="package_type" {{ request('sort_by') == 'package_type' ? 'selected' : '' }}>
                            {{ __('package.package_type') }}
                        </option>
                        <option value="package_size" {{ request('sort_by') == 'package_size' ? 'selected' : '' }}>
                            {{ __('package.package_size') }}
                        </option>
                        <option value="delivery_method" {{ request('sort_by') == 'delivery_method' ? 'selected' : '' }}>
                            {{ __('package.delivery_method') }}
                        </option>
                    </select>
                </div>
            </div>


            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" {{old('order_by',request()->input('order_by')) == 'asc' ? 'selected' : ''}}>Ascending</option>
                        <option value="desc" {{old('order_by',request()->input('order_by')) == 'desc' ? 'selected' : ''}}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{old('limit_by',request()->input('limit_by')) == '10' ? 'selected' : ''}}>10</option>
                        <option value="20" {{old('limit_by',request()->input('limit_by')) == '20' ? 'selected' : ''}}>20</option>
                        <option value="50" {{old('limit_by',request()->input('limit_by')) == '50' ? 'selected' : ''}}>50</option>
                        <option value="100" {{old('limit_by',request()->input('limit_by')) == '100' ? 'selected' : ''}}>100</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
