<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // جلب البيانات من قاعدة البيانات
        $mainSliders = Slider::where('section', 1)->where('status', 1)->get();
        $partners = Partner::where('status', 1)->get();
        $systemFeatures = Menu::where('section', 2)->where('status', 1)->get();
        $systemModules = Menu::where('section', 3)->where('status', 1)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $commonQuestions = CommonQuestion::where('status', 1)->get();

        return view('frontend.index', compact(
            'mainSliders',
            'partners',
            'systemFeatures',
            'systemModules',
            'testimonials',
            'commonQuestions'
        ));
    }
}
