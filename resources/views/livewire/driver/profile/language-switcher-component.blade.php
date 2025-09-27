<div class="dropdown d-none d-sm-inline-block">
    <button type="button" class="btn header-item waves-effect"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="flag-icon flag-icon-{{ config('locales.languages')[$locale]['flag'] ?? 'us' }}"
           title="{{ $locale }}" style="font-size: 20px;"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        @foreach($availableLocales as $key => $lang)
            <a href="javascript:void(0);" class="dropdown-item notify-item"
               wire:click="switchLanguage('{{ $key }}')">
                <i class="flag-icon flag-icon-{{ $lang['flag'] }}"
                   style="font-size: 20px;" title="{{ $lang['name_native'] }}"></i>
                <span class="align-middle">{{ $lang['name_native'] }}</span>
            </a>
        @endforeach
    </div>
</div>

<script>
    window.addEventListener('reload-page', () => {
        location.reload();
    });
</script>
