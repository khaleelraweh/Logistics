<?php

namespace App\Http\Controllers\FrontendDashboard;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendDashboardController extends Controller
{

    public function login()
    {
        return view('frontend_dashboard.frontend-dashboard-login');
    }

    public function register()
    {
        return view('frontend_dashboard.frontend-dashboard-register');
    }

    public function lock_screen()
    {
        session(['locked' => true]);
        return view('frontend_dashboard.frontend-dashboard-lock-screen');
    }


    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('frontend_dashboard.login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('Incorrect password.')]);
        }

        session()->forget('locked');

        // return redirect()->route('admin.index');
        return redirect('/frontend_dashboard/index');
    }


    public function recover_password()
    {
        return view('frontend_dashboard.frontend-dashboard-recoverpw');
    }


    // public function index()
    // {
    //     return view('frontend_dashboard.index');

    // }


    public function index()
    {
        // Counts for stats cards
        $mainSlidersCount = Slider::where('section', 1)->count();
        $pagesCount = Page::count();
        $testimonialsCount = Testimonial::count();
        $partnersCount = Partner::count();

        // Counts for system status
        $mainMenusCount = Menu::where('section', 1)->count();
        $importantLinksCount = Menu::where('section', 4)->count();
        $systemFeaturesCount = Menu::where('section', 2)->count();
        $systemModulesCount = Menu::where('section', 3)->count();
        $commonQuestionsCount = CommonQuestion::count();
        $statisticsCount = Statistic::count();

        // Active content counts for chart
        $activeMainSliders = Slider::where('section', 1)->where('status', 1)->count();
        $activePages = Page::where('status', 1)->count();
        $activeTestimonials = Testimonial::where('status', 1)->count();
        $activePartners = Partner::where('status', 1)->count();
        $activeMainMenus = Menu::where('section', 1)->where('status', 1)->count();
        $activeCommonQuestions = CommonQuestion::where('status', 1)->count();

        // Recent activity
        $recentSliders = Slider::with('firstMedia')
            ->where('section', 1)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentTestimonials = Testimonial::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('frontend_dashboard.index', compact(
            'mainSlidersCount',
            'pagesCount',
            'testimonialsCount',
            'partnersCount',
            'mainMenusCount',
            'importantLinksCount',
            'systemFeaturesCount',
            'systemModulesCount',
            'commonQuestionsCount',
            'statisticsCount',
            'activeMainSliders',
            'activePages',
            'activeTestimonials',
            'activePartners',
            'activeMainMenus',
            'activeCommonQuestions',
            'recentSliders',
            'recentTestimonials'
        ));
    }






}


