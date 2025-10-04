<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // public function index()
    // {
    //     // جلب السلايدرات الرئيسية النشطة
    //     $mainSliders = Slider::where('section', 1)
    //         ->where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     // جلب الشركاء النشطين
    //     $partners = Partner::where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     // جلب مميزات النظام النشطة
    //     $systemFeatures = Menu::where('section', 2)
    //         ->where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     // جلب وحدات النظام النشطة
    //     $systemModules = Menu::where('section', 3)
    //         ->where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     // جلب آراء العملاء النشطة
    //     $testimonials = Testimonial::where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     // جلب الأسئلة الشائعة النشطة
    //     $commonQuestions = CommonQuestion::where('status', 1)
    //         ->orderBy('published_on', 'desc')
    //         ->get();

    //     return view('frontend.index', compact(
    //         'mainSliders',
    //         'partners',
    //         'systemFeatures',
    //         'systemModules',
    //         'testimonials',
    //         'commonQuestions'
    //     ));
    // }

        public function index()
        {
            $main_sliders = Slider::with('firstMedia')->latest()->orderBy('published_on', 'desc')->Active()->take(8)->get();
            $partners = Partner::where('status', true)->orderBy('published_on', 'desc')->take(20)->get();
            $statistics = Statistic::Active()->orderBy('created_at', 'ASC')->take(10)->get();
            $common_questions = CommonQuestion::active()->orderBy('created_at', 'desc')->take(6)->get();
            $testimonials = Testimonial::active()->orderBy('published_on', 'desc')->take(10)->get();

            $system_features = Menu::where('section', 2)->where('status', true)->orderBy('id')->get();


            // $statistics = Statistic::Active()->orderBy('created_at', 'ASC')->get();
            return view('frontend.index', compact('main_sliders', 'statistics' , 'common_questions' , 'testimonials', 'partners' ,'system_features'));
        }
}
