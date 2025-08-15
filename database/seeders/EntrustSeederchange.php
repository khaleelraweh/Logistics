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

        //Invoices // invoices

        $manageInvoices = Permission::create(['name' => 'manage_invoices', 'display_name' => ['ar'  =>  'إدارة الفواتير',  'en'    =>  'Manage Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $manageInvoices->parent_show = $manageInvoices->id;
        $manageInvoices->save();
        $showInvoices    =  Permission::create(['name' => 'show_invoices',  'display_name' =>   ['ar'   =>  'الفواتير',   'en'        =>  'Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createInvoices  =  Permission::create(['name' => 'create_invoices', 'display_name'  =>   ['ar'   =>  'إضافة فاتورة',   'en'       =>  'Add New Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayInvoices =  Permission::create(['name' => 'display_invoices', 'display_name'  =>   ['ar'   =>  'استعراض  فاتورة',   'en'      =>  'Display Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateInvoices  =  Permission::create(['name' => 'update_invoices', 'display_name'  =>   ['ar'   =>  'تعديل فاتورة',   'en'        =>  'Update Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteInvoices  =  Permission::create(['name' => 'delete_invoices', 'display_name'  =>   ['ar'   =>  'حذف فاتورة',   'en'          =>  'Delete Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

    }
}
