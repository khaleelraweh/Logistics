<div>
     <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('profile.layout_preferences') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('profile.preferences') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('profile.layout_preferences') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Layout Mode  -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('profile.layout_theme') }}</h4>
                    <p class="card-title-desc">{{ __('help.layout_customizer_desc') }} </p>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.theme') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="mode" >
                                <option value="light">{{ __('general.light') }}</option>
                                <option value="dark">{{ __('general.dark') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.language') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="locale">
                                @foreach (config('locales.languages') as $key => $lang)
                                    <option value="{{ $key }}">{{ $lang['name_native'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('profile.layout_direction') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="rtl" >
                                <option value="">{{ __('general.ltr') }}</option>
                                <option value="true">{{ __('general.rtl') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.preloader') }}</label>
                        <div class="col-sm-10">
                             <div class="form-check form-switch" style="padding: 0.47rem 1.75rem;" dir="ltr">
                                <input type="checkbox" wire:model="preloader" class="form-check-input" id="showPreloader" checked>
                                <label class="form-check-label" for="showPreloader">{{ __('general.show_preloader') }}</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- Layout preferance  -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('profile.layout_customizer') }}</h4>
                    <p class="card-title-desc"> {{ __('help.layout_customizer_desc') }}</p>
                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.layout_mode') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="layout" >
                                <option value="vertical">{{ __('general.vertical') }}</option>
                                <option value="horizontal">{{ __('general.horizontal') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.topbar') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="topbar" >
                                <option value="dark">{{ __('general.dark') }}</option>
                                <option value="light">{{ __('general.light') }}</option>
                                <option value="colored">{{ __('general.colored') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.sidebar') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="sidebar" >
                                <option value="light">{{ __('general.light') }}</option>
                                <option value="dark">{{ __('general.dark') }}</option>
                                <option value="colored">{{ __('general.colored') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.sidebar_size') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="sidebar_size" >
                                <option value="default">{{ __('general.default') }}</option>
                                <option value="small">{{ __('general.compact') }}</option>
                                <option value="icon">{{ __('general.icon') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 h5 col-form-label">{{ __('general.layout_size') }}</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="layout_size" >
                                <option value="fluid">{{ __('general.fluid') }}</option>
                                <option value="boxed">{{ __('general.boxed') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>



</div>

{{-- <script>
    window.addEventListener('reload-page', () => {
        location.reload();
    });
</script> --}}
