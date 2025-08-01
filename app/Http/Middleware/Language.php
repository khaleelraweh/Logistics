<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next)
    {
        $locale = null;

        // ✅ Priority 1: Use authenticated user preference if available
        if (auth()->check() && isset(auth()->user()->layout_preferences['locale'])) {
            $locale = auth()->user()->layout_preferences['locale'];
        }

        // ✅ Priority 2: Use session if user not authenticated
        elseif (Session::has('locale') && array_key_exists(Session::get('locale'), config('locales.languages'))) {
            $locale = Session::get('locale');
        }

        // ✅ Priority 3: Detect from browser
        else {
            $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
            foreach ($userLanguages as $userLanguage) {
                if (array_key_exists($userLanguage, config('locales.languages'))) {
                    $locale = $userLanguage;
                    break;
                }
            }
        }

        // ✅ Fallback if no match
        $locale = $locale ?? config('app.locale');

        // 🔁 Apply locale settings
        App::setLocale($locale);
        Lang::setLocale($locale);
        setlocale(LC_TIME, config('locales.languages')[$locale]['unicode']);
        Carbon::setLocale(config('locales.languages')[$locale]['lang']);
        session(['locale' => $locale]);

        // RTL support
        if (config('locales.languages')[$locale]['rtl_support'] === 'rtl') {
            session(['lang-rtl' => true]);
        } else {
            session()->forget('lang-rtl');
        }

        return $next($request);
    }

}
