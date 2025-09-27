<?php

namespace App\Http\Livewire\FrontendDashboard\Profile;

use Livewire\Component;

class LanguageSwitcherComponent extends Component
{
    public $locale;
    public $availableLocales = [];

    protected $listeners = ['updateLocale' => 'setLocale'];

    public function mount()
    {
        $this->locale = session('locale', config('app.locale'));
        $this->filterAvailableLocales();
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->filterAvailableLocales();
    }

    public function switchLanguage($locale)
    {
        $this->locale = $locale;
        $this->filterAvailableLocales();

        session(['locale' => $locale]);
        app()->setLocale($locale);

        $rtl = $locale === 'ar';

        if ($rtl) {
            session(['lang-rtl' => true]);
        } else {
            session()->forget('lang-rtl');
        }

        if (auth()->check()) {
            // ✅ Ensure layout_preferences is an array
            $existingPrefs = auth()->user()->layout_preferences;

            if (!is_array($existingPrefs)) {
                $existingPrefs = json_decode($existingPrefs, true) ?? [];
            }

            // ✅ Merge and update
            auth()->user()->update([
                'layout_preferences' => array_merge(
                    $existingPrefs,
                    [
                        'locale' => $locale,
                        'rtl' => $rtl,
                    ]
                )
            ]);
        }

        // Inform the layout customizer component to sync
        $this->emitTo('merchant.profile.layout-customizer', 'externalLanguageChanged', $locale);

        // Reload the page to apply RTL and locale changes
        $this->dispatchBrowserEvent('reload-page');
    }

    protected function filterAvailableLocales()
    {
        $this->availableLocales = collect(config('locales.languages'))
            ->reject(fn($lang, $key) => $key === $this->locale)
            ->all();
    }

    public function render()
    {
        return view('livewire.frontend-dashboard.profile.language-switcher-component');
    }
}
