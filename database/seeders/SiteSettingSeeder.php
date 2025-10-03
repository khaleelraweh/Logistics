<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // site infos
        SiteSetting::create(['key' => 'site_name', 'value' => ['ar' => 'أوراكس لوجستيك', 'en' => 'Orax Logistics'], 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_short_name', 'value' => ['ar' => 'أوراكس', 'en' => 'Orax'], 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_address', 'value' => ['ar' => 'اليمن', 'en' => 'Yemen'], 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_description', 'value' => ['ar' => 'خدمات الشحن والتخزين والتوصيل الموثوقة', 'en' => 'Reliable shipping, storage, and delivery services'], 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_link', 'value' => 'https://www.oraxlogistics.com', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_workTime', 'value' => ['ar' => 'طوال أيام الأسبوع', 'en' => 'Every day of the week'], 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);

        SiteSetting::create(['key' => 'site_img', 'value' => '1.jpg', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_logo_large_light', 'value' => 'logo_light.png', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_logo_small_light', 'value' => 'logo_small_light.png', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_logo_large_dark', 'value' => 'logo_dark.png', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_logo_small_dark', 'value' => 'logo_small_dark.png', 'status' => true, 'section' => 1, 'published_on' => $faker->dateTime()]);

        // site contacts
        SiteSetting::create(['key' => 'site_phone', 'value' => '772036131', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_mobile', 'value' => '436285', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_fax', 'value' => 'fx', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_po_box', 'value' => '985', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_email1', 'value' => 'info@oraxlogistics.com', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_email2', 'value' => 'support@oraxlogistics.com', 'status' => true, 'section' => 2, 'published_on' => $faker->dateTime()]);

        // site socials
        SiteSetting::create(['key' => 'site_facebook', 'value' => 'https://facebook.com/oraxlogistics', 'status' => true, 'section' => 3, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_twitter', 'value' => 'https://twitter.com/oraxlogistics', 'status' => true, 'section' => 3, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_youtube', 'value' => 'https://youtube.com/oraxlogistics', 'status' => true, 'section' => 3, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_instagram', 'value' => 'https://instagram.com/oraxlogistics', 'status' => true, 'section' => 3, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_linkedin', 'value' => 'https://linkedin.com/company/oraxlogistics', 'status' => true, 'section' => 3, 'published_on' => $faker->dateTime()]);

        // site seo
        SiteSetting::create(['key' => 'site_name_meta', 'value' => ['ar' => 'أوراكس لوجستيك', 'en' => 'Orax Logistics'], 'status' => true, 'section' => 4, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_description_meta', 'value' => ['ar' => 'شركة رائدة في خدمات الشحن والتخزين والتوصيل', 'en' => 'Leading company in shipping, storage, and delivery services'], 'status' => true, 'section' => 4, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_link_meta', 'value' => 'https://www.oraxlogistics.com', 'status' => true, 'section' => 4, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_keywords_meta', 'value' => ['ar' => 'شحن, تخزين, توصيل, لوجستيات', 'en' => 'shipping, storage, delivery, logistics'], 'status' => true, 'section' => 4, 'published_on' => $faker->dateTime()]);

        // site counters (مثال)
        SiteSetting::create(['key' => 'site_main_sliders', 'value' => 10, 'status' => true, 'section' => 6, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_advertisor_sliders', 'value' => 10, 'status' => true, 'section' => 6, 'published_on' => $faker->dateTime()]);
        SiteSetting::create(['key' => 'site_posts', 'value' => 10, 'status' => true, 'section' => 6, 'published_on' => $faker->dateTime()]);
    }
}
