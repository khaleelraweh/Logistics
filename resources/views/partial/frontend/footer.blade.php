<footer>
    <div class="container">
        <a href="{{ route('frontend.index') }}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="OraxSoft" />
        </a>

        <p>{{ __('footer.we_are_social') }}</p>

        <div class="socail-icon wow bounceInLeft">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fas fa-home"></i>
            <i class="fab fa-linkedin"></i>
        </div>

        <p class="copyright">
            {!! __('footer.copyright', ['year' => date('Y'), 'name' => 'Logestics']) !!}
        </p>
    </div>
</footer>
