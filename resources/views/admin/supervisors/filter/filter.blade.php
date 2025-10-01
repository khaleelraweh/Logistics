<div class="card-body">
    <form action="{{ route('admin.supervisors.index') }}" method="get">
        <div class="row g-2">

            {{-- Keyword Search --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <input type="text" name="keyword"
                       value="{{ old('keyword', request()->input('keyword')) }}"
                       class="form-control"
                       placeholder="{{ __('supervisor.search_here') }}">
            </div>

            {{-- Status Filter --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <select name="status" class="form-control">
                    <option value="">---</option>
                    <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                        {{ __('supervisor.active') }}
                    </option>
                    <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                        {{ __('supervisor.inactive') }}
                    </option>
                </select>
            </div>

            {{-- Sort By --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <select name="sort_by" class="form-control">
                    <option value="">---</option>
                    <option value="id" {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>
                        {{ __('supervisor.id') }}
                    </option>
                    <option value="first_name" {{ old('sort_by', request()->input('sort_by')) == 'first_name' ? 'selected' : '' }}>
                        {{ __('supervisor.first_name') }}
                    </option>
                    <option value="last_name" {{ old('sort_by', request()->input('sort_by')) == 'last_name' ? 'selected' : '' }}>
                        {{ __('supervisor.last_name') }}
                    </option>
                    <option value="created_at" {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>
                        {{ __('supervisor.created_at') }}
                    </option>
                </select>
            </div>

            {{-- Order By --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <select name="order_by" class="form-control">
                    <option value="">---</option>
                    <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                        {{ __('supervisor.ascending') }}
                    </option>
                    <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                        {{ __('supervisor.descending') }}
                    </option>
                </select>
            </div>

            {{-- Limit By --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <select name="limit_by" class="form-control">
                    <option value="">---</option>
                    <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                    <option value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                    <option value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                </select>
            </div>


            {{-- Search Button --}}
            <div class="col-12 col-md-6 col-lg-2 mb-3">
                <button type="submit" name="submit" class="btn btn-primary w-100">
                    {{ __('supervisor.search') }}
                </button>
            </div>

        </div>
    </form>
</div>
