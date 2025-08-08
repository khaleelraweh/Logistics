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

        //Payments // payments
        $managePayments = Permission::create(['name' => 'manage_payments', 'display_name' => ['ar'  =>  'إدارة شركات الشحن',  'en'    =>  'Manage Payments'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $managePayments->parent_show = $managePayments->id;
        $managePayments->save();
        $showPayments    =  Permission::create(['name' => 'show_payments',  'display_name' =>   ['ar'   =>  'شركات الشحن',   'en'        =>  'Payments'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPayments  =  Permission::create(['name' => 'create_payments', 'display_name'  =>   ['ar'   =>  'إضافة  شركة شحن',   'en'       =>  'Add New Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPayments =  Permission::create(['name' => 'display_payments', 'display_name'  =>   ['ar'   =>  'استعراض  شركة شحن',   'en'      =>  'Display Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePayments  =  Permission::create(['name' => 'update_payments', 'display_name'  =>   ['ar'   =>  'تعديل  شركة شحن',   'en'        =>  'Update Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePayments  =  Permission::create(['name' => 'delete_payments', 'display_name'  =>   ['ar'   =>  'حذف  شركة شحن',   'en'          =>  'Delete Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

    }
}
