
<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? '-rtl' : ''; ?>
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? 'dark' : '') : 'dark'; ?>


<!-- modernizr js -->
<script src="{{ asset('frontend/js/modernizr-2.8.3.min.js') }}"></script>
<!-- jquery latest version -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<!-- Bootstrap v4.4.1 js -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Menu js -->
<script src="{{ asset('frontend/js/rsmenu-main.js') }}"></script>
<!-- op nav js -->
<script src="{{ asset('frontend/js/jquery.nav.js') }}"></script>
<!-- owl.carousel js -->
<script src="{{ asset('frontend/js/ar/owl.carousel.min.js') }}"></script>
<!-- Slick js -->
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<!-- isotope.pkgd.min js -->
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<!-- imagesloaded.pkgd.min js -->
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<!-- Skill bar js -->
<script src="{{ asset('frontend/js/skill.bars.jquery.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<!-- counter top js -->
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<!-- video js -->
<script src="{{ asset('frontend/js/jquery.mb.YTPlayer.min.js') }}"></script>
<!-- magnific popup js -->
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<!-- plugins js -->
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<!-- contact form js -->
<script src="{{ asset('frontend/js/contact.form.js') }}"></script>
<!-- main js -->
{{-- <script src="{{ asset('frontend/js/main.js') }}"></script> --}}
<script src="{{ asset('frontend/js/main' . $rtl . '.js') }}"></script>

{{-- tilt image  --}}
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.0/dist/vanilla-tilt.min.js"></script>

<script>
    VanillaTilt.init(document.querySelectorAll('.img-part.js-tilt'), {
        max: 25, // أقصى زاوية للدوران
        speed: 400, // سرعة التأثير
        glare: true, // تمكين تأثير اللمعان
        "max-glare": 0.5 // أقصى تأثير لللمعان
    });
</script>


@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
@yield('script')
