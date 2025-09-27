 <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">{{ __('profile.settings') }}</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">{{ __('profile.choose_layout') }}</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <label for="light-mode-switch" style="cursor: pointer;">
                            <img src="{{asset('admin/assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="layout-1">
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">{{ __('general.light_mode') }}</label>
                    </div>

                    <div class="mb-2">
                        <label for="dark-mode-switch" style="cursor: pointer;">
                            <img src="{{asset('admin/assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="layout-2">
                        </label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="{{asset('admin/assets/css/bootstrap-dark.min.css')}}" data-appStyle="{{asset('admin/assets/css/app-dark.min.css')}}">
                        <label class="form-check-label" for="dark-mode-switch">{{ __('general.dark_mode') }}</label>
                    </div>

                    <div class="mb-2">
                        <label for="rtl-mode-switch" style="cursor: pointer;">
                            <img src="{{asset('admin/assets/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="layout-3">
                        </label>
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="{{asset('admin/assets/css/app-rtl.min.css')}}">
                        <label class="form-check-label" for="rtl-mode-switch">{{ __('general.rtl_mode') }}</label>
                    </div>


                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Light Mode
                document.getElementById('light-mode-switch').addEventListener('change', function () {
                    if (this.checked) {
                        Livewire.emit('updateLayoutMode', 'light');
                    }
                });

                // Dark Mode
                document.getElementById('dark-mode-switch').addEventListener('change', function () {
                    if (this.checked) {
                        Livewire.emit('updateLayoutMode', 'dark');
                    }
                });

                // RTL Mode
                document.getElementById('rtl-mode-switch').addEventListener('change', function () {
                    Livewire.emit('updateRtlMode', this.checked);
                });
            });
        </script>

