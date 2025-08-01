<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutInstatute;
use App\Models\Album;
use App\Models\Event;
use App\Models\Page;
use App\Models\Playlist;
use App\Models\Post;
use App\Models\PresidentSpeech;
use App\Models\Slider;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }



}
