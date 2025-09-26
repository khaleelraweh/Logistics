<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelstatistics;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Dictionary :
     *              01- Roles
     *              02- Users
     *              03- AttachRoles To  Users
     *              04- Create random customer and  AttachRole to customerRole
     *
     *
     * @return void
     */
    public function run()
    {

        //PricingRules // pricing_rules

        $managePricingRules = Permission::create(['name' => 'manage_pricing_rules', 'display_name' => ['ar'  =>  'إدارة قواعد التسعير',  'en'    =>  'Manage Pricing Rules'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $managePricingRules->parent_show = $managePricingRules->id;
        $managePricingRules->save();
        $showPricingRules    =  Permission::create(['name' => 'show_pricing_rules',  'display_name' =>   ['ar'   =>  'قواعد التسعير',   'en'        =>  'Pricing Rules'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPricingRules  =  Permission::create(['name' => 'create_pricing_rules', 'display_name'  =>   ['ar'   =>  'إضافة قاعدة تسعير',   'en'       =>  'Add New Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPricingRules =  Permission::create(['name' => 'display_pricing_rules', 'display_name'  =>   ['ar'   =>  'استعراض  قاعدة تسعير',   'en'      =>  'Display Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePricingRules  =  Permission::create(['name' => 'update_pricing_rules', 'display_name'  =>   ['ar'   =>  'تعديل قاعدة تسعير',   'en'        =>  'Update Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePricingRules  =  Permission::create(['name' => 'delete_pricing_rules', 'display_name'  =>   ['ar'   =>  'حذف قاعدة تسعير',   'en'          =>  'Delete Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

    }
}
