@extends('layouts.admin')

@section('content')

    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pricing_rule.manage_pricing_rules') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pricing_rules.index') }}">{{ __('pricing_rule.pricing_rules') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('pricing_rule.pricing_rule_data') }}</h4>
                            <p class="card-title-desc">{{ __('pricing_rule.pricing_rule_description') }}</p>
                        </div>

                        @ability('admin', 'create_pricing_rules')
                            <div class="button-items">
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.pricing_rules.create') }}">
                                    {{ __('pricing_rule.add_new_pricing_rule') }} <i class="fas fa-plus-circle align-middle ms-2"></i>
                                </a>
                            </div>
                        @endability
                    </div>

                    <!-- Filters Section -->
                    <form method="GET" action="{{ route('admin.pricing_rules.index') }}" class="row g-2 mb-3">
                        <div class="col-md-3">
                            <select name="type" class="form-control">
                                <option value="">{{ __('general.all_types') }}</option>
                                <option value="delivery" {{ request('type') == 'delivery' ? 'selected' : '' }}>{{ __('pricing_rule.delivery') }}</option>
                                <option value="storage" {{ request('type') == 'storage' ? 'selected' : '' }}>{{ __('pricing_rule.storage') }}</option>
                                <option value="handling" {{ request('type') == 'handling' ? 'selected' : '' }}>{{ __('pricing_rule.handling') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control">
                                <option value="">{{ __('general.all_status') }}</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info">{{ __('general.filter') }}</button>
                        </div>
                    </form>
                    <!-- End Filters Section -->

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('pricing_rule.name') }}</th>
                            <th>{{ __('pricing_rule.type') }}</th>
                            <th>{{ __('pricing_rule.zone') }}</th>
                            <th>{{ __('pricing_rule.base_price') }}</th>
                            <th>{{ __('pricing_rule.price_per_kg') }}</th>
                            <th>{{ __('general.status') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th width="12%">{{ __('general.actions') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($pricingRules as $rule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::words($rule->name ?? '', 2, '') }}</td>
                                <td>{{ ucfirst($rule->type) }}</td>
                                <td>{{ $rule->zone ?? '-' }}</td>
                                <td>{{ number_format($rule->base_price, 2) }}</td>
                                <td>{{ number_format($rule->price_per_kg, 2) }}</td>
                                <td>
                                    @if ($rule->status)
                                        <span class="badge bg-success">{{ __('general.active') }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ __('general.inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $rule->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_pricing_rules')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.pricing_rules.show', $rule->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'update_pricing_rules')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.pricing_rules.edit', $rule->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'delete_pricing_rules')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="confirmDelete('delete-rule-{{ $rule->id }}',
                                                                           '{{ __('panel.confirm_delete_message') }}',
                                                                           '{{ __('panel.yes_delete') }}',
                                                                           '{{ __('panel.cancel') }}')">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-rule-{{ $rule->id }}" action="{{ route('admin.pricing_rules.destroy', $rule->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                            @endability
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $pricingRules->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
