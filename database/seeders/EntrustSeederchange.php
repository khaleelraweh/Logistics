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

        $managePricingRules = Permission::create(['name' => 'manage_pricing_rules', 'display_name' => ['ar'  =>  'إدارة الفواتير',  'en'    =>  'Manage Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $managePricingRules->parent_show = $managePricingRules->id;
        $managePricingRules->save();
        $showPricingRules    =  Permission::create(['name' => 'show_pricing_rules',  'display_name' =>   ['ar'   =>  'الفواتير',   'en'        =>  'Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPricingRules  =  Permission::create(['name' => 'create_pricing_rules', 'display_name'  =>   ['ar'   =>  'إضافة فاتورة',   'en'       =>  'Add New Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPricingRules =  Permission::create(['name' => 'display_pricing_rules', 'display_name'  =>   ['ar'   =>  'استعراض  فاتورة',   'en'      =>  'Display Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePricingRules  =  Permission::create(['name' => 'update_pricing_rules', 'display_name'  =>   ['ar'   =>  'تعديل فاتورة',   'en'        =>  'Update Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePricingRules  =  Permission::create(['name' => 'delete_pricing_rules', 'display_name'  =>   ['ar'   =>  'حذف فاتورة',   'en'          =>  'Delete Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

    }
}
