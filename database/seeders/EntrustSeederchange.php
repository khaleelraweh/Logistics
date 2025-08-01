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

        //ExternalShipments // external_shipments
        $manageExternalShipment = Permission::create(['name' => 'manage_external_shipments', 'display_name' => ['ar'  =>  'إدارة شركات الشحن',  'en'    =>  'Manage External Shipments'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $manageExternalShipment->parent_show = $manageExternalShipment->id;
        $manageExternalShipment->save();
        $showExternalShipment    =  Permission::create(['name' => 'show_external_shipments',  'display_name' =>   ['ar'   =>  'شركات الشحن',   'en'        =>  'External Shipments'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createExternalShipment  =  Permission::create(['name' => 'create_external_shipments', 'display_name'  =>   ['ar'   =>  'إضافة  شركة شحن',   'en'       =>  'Add New External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayExternalShipment =  Permission::create(['name' => 'display_external_shipments', 'display_name'  =>   ['ar'   =>  'استعراض  شركة شحن',   'en'      =>  'Display External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateExternalShipment  =  Permission::create(['name' => 'update_external_shipments', 'display_name'  =>   ['ar'   =>  'تعديل  شركة شحن',   'en'        =>  'Update External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteExternalShipment  =  Permission::create(['name' => 'delete_external_shipments', 'display_name'  =>   ['ar'   =>  'حذف  شركة شحن',   'en'          =>  'Delete External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

    }
}
