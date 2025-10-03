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
use App\Http\Controllers\FrontendDashboard\SiteSettingsController;
use App\Http\Controllers\FrontendDashboard\StatisticsController;
use App\Http\Controllers\FrontendDashboard\SystemFeaturesMenuControlle;
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

    // خصائص النظام
    Route::post('system_features_menus/update-system-features-menu-status', [SystemFeaturesMenuControlle::class, 'updateSystemFeaturesMenuStatus'])->name('system_features_menus.update_system_features_menu_status');
    Route::resource('system_features_menus', SystemFeaturesMenuControlle::class);

    // وحدات النظام
    Route::post('system_modules_menus/update-system-modules-menu-status', [SystemModulesMenuControlle::class, 'updateSystemModulesMenuStatus'])->name('system_modules_menus.update_system_modules_menu_status');
    Route::resource('system_modules_menus', SystemModulesMenuControlle::class);

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


    // ==============   Site Setting  Tab   ==============  //
        Route::get('site_setting/site_infos', [SiteSettingsController::class, 'show_main_informations'])->name('settings.site_main_infos.show');
        Route::post('site_setting/update_site_info/{id?}', [SiteSettingsController::class, 'update_main_informations'])->name('settings.site_main_infos.update');
        Route::post('site_setting/site_infos/remove-image', [SiteSettingsController::class, 'remove_image'])->name('site_infos.remove_image');
        //to remove album
        Route::post('site_setting/site_infos/remove-site_settings_albums', [SiteSettingsController::class, 'remove_site_settings_albums'])->name('site_infos.remove_site_settings_albums');
        //for logos
        Route::post('site_setting/site_infos/remove-site-logo-large-light', [SiteSettingsController::class, 'remove_site_logo_large_light'])->name('site_infos.remove_site_logo_large_light');
        Route::post('site_setting/site_infos/remove_site_logo_small_light', [SiteSettingsController::class, 'remove_site_logo_small_light'])->name('site_infos.remove_site_logo_small_light');
        //---------------
        Route::post('site_setting/site_infos/remove_site_logo_large_dark', [SiteSettingsController::class, 'remove_site_logo_large_dark'])->name('site_infos.remove_site_logo_large_dark');
        Route::post('site_setting/site_infos/remove_site_logo_small_dark', [SiteSettingsController::class, 'remove_site_logo_small_dark'])->name('site_infos.remove_site_logo_small_dark');

        Route::get('site_setting/site_contacts', [SiteSettingsController::class, 'show_contact_informations'])->name('settings.site_contacts.show');
        Route::post('site_setting/update_site_contact/{id?}', [SiteSettingsController::class, 'update_contact_informations'])->name('settings.site_contacts.update');

        Route::get('site_setting/site_socials', [SiteSettingsController::class, 'show_socail_informations'])->name('settings.site_socials.show');
        Route::post('site_setting/update_site_social/{id?}', [SiteSettingsController::class, 'update_social_informations'])->name('settings.site_socials.update');

        Route::get('site_setting/site_metas', [SiteSettingsController::class, 'show_meta_informations'])->name('settings.site_meta.show');
        Route::post('site_setting/update_site_meta/{id?}', [SiteSettingsController::class, 'update_meta_informations'])->name('settings.site_meta.update');



});
