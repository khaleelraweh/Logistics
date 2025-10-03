<?php

use App\Http\Controllers\FrontendDashboard\FrontendDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\FrontendDashboard\AdvertisorSliderController;
use App\Http\Controllers\FrontendDashboard\CommonQuestionController;
use App\Http\Controllers\FrontendDashboard\ImportantLinkMenuController;
use App\Http\Controllers\FrontendDashboard\MainMenuController;
use App\Http\Controllers\FrontendDashboard\MainSliderController;
use App\Http\Controllers\FrontendDashboard\PageCategoriesController;
use App\Http\Controllers\FrontendDashboard\PagesController;
use App\Http\Controllers\FrontendDashboard\PartnerController;
use App\Http\Controllers\FrontendDashboard\StatisticsController;
use App\Http\Controllers\FrontendDashboard\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'frontend_dashboard', 'as' => 'frontend_dashboard.', 'middleware' => ['roles', 'role:frontend_dashboard']], function () {

    // Dashboard
    Route::get('/', [FrontendDashboardController::class, 'index'])->name('index2');
    Route::get('/index', [FrontendDashboardController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [FrontendDashboardController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [FrontendDashboardController::class, 'unlock'])->name('unlock');

    // Layout & Profile
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('frontend/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');

    //Resources

    Route::post('main_menus/update-main-menu-status', [MainMenuController::class, 'updateMainMenuStatus'])->name('main_menus.update_main_menu_status');
    Route::resource('main_menus', MainMenuController::class);

    Route::post('important_link_menus/update-important-link-menu-status', [ImportantLinkMenuController::class, 'updateImportantLinkMenuStatus'])->name('important_link_menus.update_important_link_menu_status');
    Route::resource('important_link_menus', ImportantLinkMenuController::class);

    // ==============   Sliders Tab   ==============  //
    Route::post('main_sliders/remove-image', [MainSliderController::class, 'remove_image'])->name('main_sliders.remove_image');
    Route::post('main_sliders/update-main-slider-status', [MainSliderController::class, 'updateMainSliderStatus'])->name('main_sliders.update_main_slider_status');
    Route::resource('main_sliders', MainSliderController::class);

    Route::post('advertisor_sliders/remove-image', [AdvertisorSliderController::class, 'remove_image'])->name('advertisor_sliders.remove_image');
    Route::post('advertisor_sliders/update-advertisor-slider-status', [AdvertisorSliderController::class, 'updateAdvertisorSliderStatus'])->name('advertisor_sliders.update_advertisor_slider_status');
    Route::resource('advertisor_sliders', AdvertisorSliderController::class);

    // ================== Partners ================//
    Route::post('partners/remove-image', [PartnerController::class, 'remove_image'])->name('partners.remove_image');
    Route::post('partners/update-partner-status', [PartnerController::class, 'updatePartnerStatus'])->name('partners.update_partner_status');
    Route::resource('partners', PartnerController::class);

    // ==============   Page Categories Tab   ==============  //
    Route::post('page-categories/remove-image', [PageCategoriesController::class, 'remove_image'])->name('page_categories.remove_image');
    Route::post('page-categories/update-page-category-status', [PageCategoriesController::class, 'updatePageCategoryStatus'])->name('page_categories.update_page_category_status');
    Route::resource('page_categories', PageCategoriesController::class);



    // ==============   Pages Tab   ==============  //
    Route::post('pages/remove-image', [PagesController::class, 'remove_image'])->name('pages.remove_image');
    Route::post('pages/update-page-status', [PagesController::class, 'updatePageStatus'])->name('pages.update_page_status');
    Route::resource('pages', PagesController::class);


    // ================== testimonials ================//
    Route::post('testimonials/remove-image', [TestimonialController::class, 'remove_image'])->name('testimonials.remove_image');
    Route::post('testimonials/update-testimonial-status', [TestimonialController::class, 'updateTestimonialStatus'])->name('testimonials.update_testimonial_status');
    Route::resource('testimonials', TestimonialController::class);

    //=============== common question =========================//
    Route::post('common_questions/update-common-question-status', [CommonQuestionController::class, 'updateCommonQuestionStatus'])->name('common_questions.update_common_question_status');
    Route::resource('common_questions', CommonQuestionController::class);

    // ==============   Statistics Tab   ==============  //
    Route::post('statistics/remove-statistic-image', [StatisticsController::class, 'remove_statistic_image'])->name('statistics.remove_statistic_image');
    Route::post('statistics/update-statistic-status', [StatisticsController::class, 'updateStatisticStatus'])->name('statistics.update_statistic_status');
    Route::resource('statistics', StatisticsController::class);





});
