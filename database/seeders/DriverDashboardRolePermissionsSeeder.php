<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class DriverDashboardRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1- Create Role
        $driverRole = Role::create([
            'name' => 'driver',
            'display_name' => 'Driver',
            'description' => 'User is Driver and has his own dashboard',
            'allowed_route' => 'driver',
        ]);

        // 2- Create Permission
         //===== Dashboard =====
        $manageMain = Permission::create(['name' => 'driver_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

         //===== Deliveries / deliveries =====
        $manageDeliveries = Permission::create(['name' => 'driver_manage_deliveries', 'display_name' => ['ar'  =>  'إدارة التوصيل',  'en'    =>  'Manage Deliveries'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.index', 'icon' => ' mdi mdi-1 8px mdi-truck-delivery', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageDeliveries->parent_show = $manageDeliveries->id;
        $manageDeliveries->save();
        $showDeliveries    =  Permission::create(['name' => 'driver_show_deliveries',  'display_name' =>   ['ar'   =>  'التوصيل',   'en'        =>  'Deliveries'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.index', 'icon' => ' mdi mdi-1 8px mdi-truck-delivery', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createDeliveries  =  Permission::create(['name' => 'driver_create_deliveries', 'display_name'  =>   ['ar'   =>  'إضافة عملية توصيل',   'en'       =>  'Add New Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayDeliveries =  Permission::create(['name' => 'driver_display_deliveries', 'display_name'  =>   ['ar'   =>  'استعراض عملية توصيل',   'en'      =>  'Display Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateDeliveries  =  Permission::create(['name' => 'driver_update_deliveries', 'display_name'  =>   ['ar'   =>  'تعديل عملية توصيل',   'en'        =>  'Update Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteDeliveries  =  Permission::create(['name' => 'driver_delete_deliveries', 'display_name'  =>   ['ar'   =>  'حذف عملية توصيل',   'en'          =>  'Delete Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //PickupRequests / pickupRequests
        $managePickupRequests = Permission::create(['name' => 'driver_manage_pickup_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الاستلام',  'en'    =>  'Manage Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $managePickupRequests->parent_show = $managePickupRequests->id;
        $managePickupRequests->save();
        $showPickupRequests    =  Permission::create(['name' => 'driver_show_pickup_requests',  'display_name' =>   ['ar'   =>  'طلبات الاستلام',   'en'        =>  'Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPickupRequests  =  Permission::create(['name' => 'driver_create_pickup_requests', 'display_name'  =>   ['ar'   =>  'إضافة عملية طلب استلام',   'en'       =>  'Add New Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPickupRequests =  Permission::create(['name' => 'driver_display_pickup_requests', 'display_name'  =>   ['ar'   =>  'استعراض عملية طلب استلام',   'en'      =>  'Display Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePickupRequests  =  Permission::create(['name' => 'driver_update_pickup_requests', 'display_name'  =>   ['ar'   =>  'تعديل عملية طلب استلام',   'en'        =>  'Update Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePickupRequests  =  Permission::create(['name' => 'driver_delete_pickup_requests', 'display_name'  =>   ['ar'   =>  'حذف عملية طلب استلام',   'en'          =>  'Delete Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


         //ReturnRequests // return_requests
        $manageReturnRequests = Permission::create(['name' => 'driver_manage_return_requests', 'display_name' => ['ar'  =>  'إدارة طلبات المرتجعات',  'en'    =>  'Manage Return Requests'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.index', 'icon' => 'dripicons-return', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageReturnRequests->parent_show = $manageReturnRequests->id;
        $manageReturnRequests->save();
        $showReturnRequests    =  Permission::create(['name' => 'driver_show_return_requests',  'display_name' =>   ['ar'   =>  'طلبات المرتجعات',   'en'        =>  'Return Requests'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.index', 'icon' => 'dripicons-return', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createReturnRequests  =  Permission::create(['name' => 'driver_create_return_requests', 'display_name'  =>   ['ar'   =>  'إضافة عملية طلب ارجاع',   'en'       =>  'Add New Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayReturnRequests =  Permission::create(['name' => 'driver_display_return_requests', 'display_name'  =>   ['ar'   =>  'استعراض عملية طلب ارجاع',   'en'      =>  'Display Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateReturnRequests  =  Permission::create(['name' => 'driver_update_return_requests', 'display_name'  =>   ['ar'   =>  'تعديل عملية طلب ارجاع',   'en'        =>  'Update Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteReturnRequests  =  Permission::create(['name' => 'driver_delete_return_requests', 'display_name'  =>   ['ar'   =>  'حذف عملية طلب ارجاع',   'en'          =>  'Delete Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        // 3- attatch role to Permissions
        $permissions = [
            // Dashboard
            $manageMain,

            // Resources
            $manageDeliveries,$showDeliveries,$createDeliveries,$displayDeliveries,$updateDeliveries,$deleteDeliveries,
            $managePickupRequests,$showPickupRequests,$createPickupRequests,$displayPickupRequests,$updatePickupRequests,$deletePickupRequests,
            $manageReturnRequests,$showReturnRequests,$createReturnRequests,$displayReturnRequests,$updateReturnRequests,$deleteReturnRequests,

        ];

        foreach ($permissions as $permission) {
            if (!$driverRole->hasPermission($permission->name)) {
                $driverRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');
    }
}
