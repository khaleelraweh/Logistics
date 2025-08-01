<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\App;

/**
 * LayoutCustomizer Component
 *
 * This component allows users to customize their layout preferences such as layout type,
 * topbar style, sidebar style, sidebar size, layout size, preloader visibility, RTL mode,
 * and light/dark mode.
 */
class LayoutCustomizerComponent extends Component
{
    public $layout = 'vertical';
    public $topbar = 'dark';
    public $sidebar = 'dark';
    public $sidebar_size = 'default';
    public $layout_size = 'fluid';
    public $preloader = false;
    public $rtl = false;
    public $mode = 'light';

    public $locale = 'ar';

    protected $listeners = [
        'updateLayoutMode' => 'setLayoutMode',
        'updateRtlMode' => 'setRtlMode',
        'externalLanguageChanged' => 'updateLocaleExternally'
    ];



    public function updateLocaleExternally($locale)
{
    $this->locale = $locale;
    $this->rtl = $locale === 'ar';

    App::setLocale($locale);
    session(['locale' => $locale]);

    if ($this->rtl) {
        session(['lang-rtl' => true]);
    } else {
        session()->forget('lang-rtl');
    }

    auth()->user()->update([
        'layout_preferences' => array_merge(
            auth()->user()->layout_preferences ?? [],
            [
                'locale' => $locale,
                'rtl' => $this->rtl,
            ]
        )
    ]);

    $this->updated('locale'); // triggers save & emit
}


    public function setLayoutMode($mode)
    {
        $this->mode = $mode;
        $this->updated('mode'); // Optional: Triggers save + emit
    }

    public function setRtlMode($rtl)
    {
        $this->rtl = $rtl;
        $this->updated('rtl'); // Optional: Triggers save + emit
    }


    public function mount()
    {

        $this->locale = auth()->user()->layout_preferences['locale'] ?? config('app.locale');
        $this->rtl = $this->locale === 'ar' ? 'true' : '';
        App::setLocale($this->locale);

        // $prefs = auth()->user()->layout_preferences ?? [];

        $prefs = is_array(auth()->user()->layout_preferences)
        ? auth()->user()->layout_preferences
        : json_decode(auth()->user()->layout_preferences, true) ?? [];


        $defaults = [
            'layout' => 'vertical',
            'topbar' => 'dark',
            'sidebar' => 'dark',
            'sidebar_size' => 'default',
            'layout_size' => 'fluid',
            'preloader' => false,
            'rtl' => false,
            'mode' => 'light',
            'locale' => session('locale', config('locales.fallback_locale')),

        ];

        $this->fill(array_merge($defaults, $prefs));
    }

    public function updated($property)
    {

         // Automatically set RTL based on selected locale
        if ($property === 'locale') {
            if ($this->locale === 'ar') {
                $this->rtl = true;
                session(['lang-rtl' => true]);
            } else {
                $this->rtl = false;
                session()->forget('lang-rtl');
            }

            session(['locale' => $this->locale]);
            app()->setLocale($this->locale);
        }

        // Save preferences to the database
        auth()->user()->update([
            'layout_preferences' => [
                'layout'        => $this->layout,
                'topbar'        => $this->topbar,
                'sidebar'       => $this->sidebar,
                'sidebar_size'  => $this->sidebar_size,
                'layout_size'   => $this->layout_size,
                'preloader'     => $this->preloader,
                'rtl'           => $this->rtl,
                'mode'          => $this->mode,
                'locale'        => $this->locale, // add this line to support language preference
            ]
        ]);

        // Set session + application locale
        session(['locale' => $this->locale]);
        app()->setLocale($this->locale);

        // Emit updated layout settings to browser (optional)
        $this->dispatchBrowserEvent('layout-updated', [
            'layout'        => $this->layout,
            'topbar'        => $this->topbar,
            'sidebar'       => $this->sidebar,
            'sidebar_size'  => $this->sidebar_size,
            'layout_size'   => $this->layout_size,
            'preloader'     => $this->preloader,
            'rtl'           => $this->rtl,
            'mode'          => $this->mode,
            'locale'        => $this->locale,
        ]);

        $this->emitTo('admin.profile.language-switcher-component', 'updateLocale', $this->locale);


        // If the user changed the language, reload the page
        // if ($property === 'locale') {
        //     $this->dispatchBrowserEvent('reload-page');
        // }
    }



    public function render()
    {
        return view('livewire.admin.profile.layout-customizer-component');
    }
}

