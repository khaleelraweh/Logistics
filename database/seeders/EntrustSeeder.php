<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        //create fake information  using faker factory lab
        $faker = Factory::create();


        //------------- 01- Roles ------------//
        //adminRole
        $adminRole = new Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'User Administrator'; // optional
        $adminRole->description  = 'User is allowed to manage and edit other users'; // optional
        $adminRole->allowed_route = 'admin';
        $adminRole->save();

        //supervisorRole
        $supervisorRole = Role::create([
            'name' => 'supervisor',
            'display_name' => 'User Supervisor',
            'description' => 'Supervisor is allowed to manage and edit other users',
            'allowed_route' => 'admin',
        ]);


        //customerRole
        $customerRole = new Role();
        $customerRole->name         = 'customer';
        $customerRole->display_name = 'Project Customer'; // optional
        $customerRole->description  = 'Customer is the customer of a given project'; // optional
        $customerRole->allowed_route = null;
        $customerRole->save();







        //------------- 02- Users  ------------//
        // Create Admin
        $admin = new User();
        $admin->first_name = ['ar'  =>  'مدير' , 'en'   => 'Admin'];
        $admin->last_name = ['ar'   =>  'النظام' , 'en' =>  'System'];
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->email_verified_at = now();
        $admin->mobile = '00967772036131';
        $admin->password = bcrypt('123123123');
        $admin->user_image = 'avator.svg';
        $admin->status = 1;
        $admin->layout_preferences = json_encode([
            "layout"    => "vertical",
            "topbar"    => "dark",
            "sidebar"   => "dark",
            "sidebar_size"  => "default",
            "layout_size"   => "fluid",
            "preloader" => true,
            "rtl"   => true,
            "mode"  => "light",
            "locale" => session('locale', config('locales.fallback_locale')),
        ]);

        $admin->remember_token = Str::random(10);
        $admin->save();

        // Create supervisor
        $supervisor = User::create([
            'first_name' => ['ar'   =>  'مشرف'  ,   'en'    =>  'Supervisor'],
            'last_name' => ['ar'    =>  'النظام'    ,   'en'    =>  'System'],
            'username' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036132',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // Create customer
        $customer = User::create([
            'first_name' => ['ar'   =>  'خليل' , 'en'   => 'khaleel'],
            'last_name' => ['ar'    => 'راوح' , 'en'    =>  'Raweh'],
            'username' => 'khaleel',
            'email' => 'khaleelvisa@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036133',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);




        //------------- 03- AttachRoles To  Users  ------------//
        $admin->attachRole($adminRole);
        $supervisor->attachRole($supervisorRole);
        $customer->attachRole($customerRole);



        //------------- 04-  Create random customer and  AttachRole to customerRole  ------------//
        for ($i = 1; $i <= 5; $i++) {
            //Create random customer
            $random_customer = User::create([
                'first_name' => ['ar'   =>  $faker->firstName , 'en'    =>  $faker->firstName],
                'last_name' => ['ar'    =>  $faker->lastName , 'en' =>  $faker->lastName],
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->email,
                'email_verified_at' => now(),
                'mobile' => '0096777' . $faker->numberBetween(1000000, 9999999),
                'password' => bcrypt('123123123'),
                'user_image' => 'avator.svg',
                'status' => 1,
                'remember_token' => Str::random(10),
            ]);

            //Add customerRole to RandomCusomer
            $random_customer->attachRole($customerRole);
        } //end for


        //------------- 05- Permission  ------------//
        //manage main dashboard page
        $manageMain = Permission::create(['name' => 'main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

         //merchants
        $manageMerchants = Permission::create(['name' => 'manage_merchants', 'display_name' => ['ar'  =>  'إدارة حساب التاجر',  'en'    =>  'Manage Merchants'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.index', 'icon' => ' fas fa-user-plus', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageMerchants->parent_show = $manageMerchants->id;
        $manageMerchants->save();
        $showMerchants    =  Permission::create(['name' => 'show_merchants',  'display_name' =>   ['ar'   =>  'التاجر',   'en'        =>  'Merchants'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.index', 'icon' => ' fas fa-user-plus', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createMerchants  =  Permission::create(['name' => 'create_merchants', 'display_name'  =>   ['ar'   =>  'إضافة تاجر',   'en'       =>  'Add New Merchant'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayMerchants =  Permission::create(['name' => 'display_merchants', 'display_name'  =>   ['ar'   =>  'استعراض تاجر',   'en'      =>  'Display Merchant'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateMerchants  =  Permission::create(['name' => 'update_merchants', 'display_name'  =>   ['ar'   =>  'تعديل تاجر',   'en'        =>  'Update Merchant'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMerchants  =  Permission::create(['name' => 'delete_merchants', 'display_name'  =>   ['ar'   =>  'حذف تاجر ',   'en'          =>  'Delete Merchant'], 'route' => 'merchants', 'module' => 'merchants', 'as' => 'merchants.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //Products
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => ['ar'  =>  'إدارة المنتجات',  'en'    =>  'Manage Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fab fa-product-hunt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();
        $showProducts    =  Permission::create(['name' => 'show_products',  'display_name' =>   ['ar'   =>  'المنتجات',   'en'        =>  'Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fab fa-product-hunt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createProducts  =  Permission::create(['name' => 'create_products', 'display_name'  =>   ['ar'   =>  'إضافة منتج',   'en'       =>  'Add New Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayProducts =  Permission::create(['name' => 'display_products', 'display_name'  =>   ['ar'   =>  'استعراض منتج',   'en'      =>  'Display Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateProducts  =  Permission::create(['name' => 'update_products', 'display_name'  =>   ['ar'   =>  'تعديل منتج',   'en'        =>  'Update Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProducts  =  Permission::create(['name' => 'delete_products', 'display_name'  =>   ['ar'   =>  'حذف منتج ',   'en'          =>  'Delete Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);



        //Warehouse
        $manageWarehouses = Permission::create(['name' => 'manage_warehouses', 'display_name' => ['ar'  =>  'إدارة المستودعات',  'en'    =>  'Manage Warehouses'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.index', 'icon' => 'fas fa-warehouse', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageWarehouses->parent_show = $manageWarehouses->id;
        $manageWarehouses->save();
        $showWarehouses    =  Permission::create(['name' => 'show_warehouses',  'display_name' =>   ['ar'   =>  'المستودعات',   'en'        =>  'Warehouses'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.index', 'icon' => 'fas fa-warehouse', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createWarehouses  =  Permission::create(['name' => 'create_warehouses', 'display_name'  =>   ['ar'   =>  'إضافة مستودع',   'en'       =>  'Add New Warehouse'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayWarehouses =  Permission::create(['name' => 'display_warehouses', 'display_name'  =>   ['ar'   =>  'استعراض مستودع',   'en'      =>  'Display Warehouse'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateWarehouses  =  Permission::create(['name' => 'update_warehouses', 'display_name'  =>   ['ar'   =>  'تعديل مستودع',   'en'        =>  'Update Warehouse'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteWarehouses  =  Permission::create(['name' => 'delete_warehouses', 'display_name'  =>   ['ar'   =>  'حذف مستودع ',   'en'          =>  'Delete Warehouse'], 'route' => 'warehouses', 'module' => 'warehouses', 'as' => 'warehouses.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        //Shelves
        $manageShelves = Permission::create(['name' => 'manage_shelves', 'display_name' => ['ar'  =>  'إدارة الرفوف',  'en'    =>  'Manage Shelves'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.index', 'icon' => 'mdi mdi-18px mdi-library-shelves', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageShelves->parent_show = $manageShelves->id;
        $manageShelves->save();
        $showShelves    =  Permission::create(['name' => 'show_shelves',  'display_name' =>   ['ar'   =>  'الرفوف',   'en'        =>  'Shelves'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.index', 'icon' => 'mdi mdi-18px mdi-library-shelves', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createShelves  =  Permission::create(['name' => 'create_shelves', 'display_name'  =>   ['ar'   =>  'إضافة رف',   'en'       =>  'Add New Shelve'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayShelves =  Permission::create(['name' => 'display_shelves', 'display_name'  =>   ['ar'   =>  'استعراض رف',   'en'      =>  'Display Shelve'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateShelves  =  Permission::create(['name' => 'update_shelves', 'display_name'  =>   ['ar'   =>  'تعديل رف',   'en'        =>  'Update Shelve'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteShelves  =  Permission::create(['name' => 'delete_shelves', 'display_name'  =>   ['ar'   =>  'حذف رف ',   'en'          =>  'Delete Shelve'], 'route' => 'shelves', 'module' => 'shelves', 'as' => 'shelves.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //WarehouseRentals / warehouse_rentals
        $manageWarehouseRentals = Permission::create(['name' => 'manage_warehouse_rentals', 'display_name' => ['ar'  =>  'إدارة تاجير الرفوف',  'en'    =>  'Manage Warehouse Rentals'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.index', 'icon' => ' fas fa-file-contract ', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $manageWarehouseRentals->parent_show = $manageWarehouseRentals->id;
        $manageWarehouseRentals->save();
        $showWarehouseRentals    =  Permission::create(['name' => 'show_warehouse_rentals',  'display_name' =>   ['ar'   =>  'تاجير الرفوف',   'en'        =>  'Warehouse Rentals'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.index', 'icon' => ' fas fa-file-contract ', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createWarehouseRentals  =  Permission::create(['name' => 'create_warehouse_rentals', 'display_name'  =>   ['ar'   =>  'إضافة عملية تاجير رف',   'en'       =>  'Add New Warehouse Rental'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayWarehouseRentals =  Permission::create(['name' => 'display_warehouse_rentals', 'display_name'  =>   ['ar'   =>  'استعراض عملية تاجير الرفوف',   'en'      =>  'Display Warehouse Rental'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateWarehouseRentals  =  Permission::create(['name' => 'update_warehouse_rentals', 'display_name'  =>   ['ar'   =>  'تعديل عملية تاجير الرفوف',   'en'        =>  'Update Warehouse Rental'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteWarehouseRentals  =  Permission::create(['name' => 'delete_warehouse_rentals', 'display_name'  =>   ['ar'   =>  'عملية تاجير رف ',   'en'          =>  'Delete Warehouse Rental'], 'route' => 'warehouse_rentals', 'module' => 'warehouse_rentals', 'as' => 'warehouse_rentals.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //StockItems / stock_items
        $manageStockItems = Permission::create(['name' => 'manage_stock_items', 'display_name' => ['ar'  =>  'إدارة المخزون',  'en'    =>  'Manage Stock Items'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.index', 'icon' => 'mdi mdi-1 8px mdi-stocking', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30',]);
        $manageStockItems->parent_show = $manageStockItems->id;
        $manageStockItems->save();
        $showStockItems    =  Permission::create(['name' => 'show_stock_items',  'display_name' =>   ['ar'   =>  'المخزون',   'en'        =>  'Stock Items'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.index', 'icon' => 'mdi mdi-1 8px mdi-stocking', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createStockItems  =  Permission::create(['name' => 'create_stock_items', 'display_name'  =>   ['ar'   =>  'إضافة عناصر لمخزن',   'en'       =>  'Add New Stock Item'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayStockItems =  Permission::create(['name' => 'display_stock_items', 'display_name'  =>   ['ar'   =>  'استعراض عناصر مخزن',   'en'      =>  'Display Stock Item'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateStockItems  =  Permission::create(['name' => 'update_stock_items', 'display_name'  =>   ['ar'   =>  'تعديل عناصر مخزن',   'en'        =>  'Update Stock Item'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteStockItems  =  Permission::create(['name' => 'delete_stock_items', 'display_name'  =>   ['ar'   =>  'حذف عناصر مخزن',   'en'          =>  'Delete Stock Item'], 'route' => 'stock_items', 'module' => 'stock_items', 'as' => 'stock_items.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //Packages / packages
        $managePackages = Permission::create(['name' => 'manage_packages', 'display_name' => ['ar'  =>  'إدارة الطرود',  'en'    =>  'Manage Packages'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.index', 'icon' => 'fas fa-boxes', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '35',]);
        $managePackages->parent_show = $managePackages->id;
        $managePackages->save();
        $showPackages    =  Permission::create(['name' => 'show_packages',  'display_name' =>   ['ar'   =>  'الطرود',   'en'        =>  'Packages'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.index', 'icon' => 'fas fa-boxes', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPackages  =  Permission::create(['name' => 'create_packages', 'display_name'  =>   ['ar'   =>  'إضافة طرد',   'en'       =>  'Add New Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPackages =  Permission::create(['name' => 'display_packages', 'display_name'  =>   ['ar'   =>  'استعراض طرد',   'en'      =>  'Display Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePackages  =  Permission::create(['name' => 'update_packages', 'display_name'  =>   ['ar'   =>  'تعديل طرد',   'en'        =>  'Update Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePackages  =  Permission::create(['name' => 'delete_packages', 'display_name'  =>   ['ar'   =>  'حذف طرد',   'en'          =>  'Delete Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //Drivers / drivers
        $manageDrivers = Permission::create(['name' => 'manage_drivers', 'display_name' => ['ar'  =>  'إدارة السائقين',  'en'    =>  'Manage Drivers'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.index', 'icon' => 'mdi mdi-1 8px mdi mdi-account-tie', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
        $manageDrivers->parent_show = $manageDrivers->id;
        $manageDrivers->save();
        $showDrivers    =  Permission::create(['name' => 'show_drivers',  'display_name' =>   ['ar'   =>  'السائقين',   'en'        =>  'Drivers'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.index', 'icon' => 'mdi mdi-1 8px mdi mdi-account-tie', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createDrivers  =  Permission::create(['name' => 'create_drivers', 'display_name'  =>   ['ar'   =>  'إضافة سائق',   'en'       =>  'Add New Driver'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayDrivers =  Permission::create(['name' => 'display_drivers', 'display_name'  =>   ['ar'   =>  'استعراض سائق',   'en'      =>  'Display Driver'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateDrivers  =  Permission::create(['name' => 'update_drivers', 'display_name'  =>   ['ar'   =>  'تعديل سائق',   'en'        =>  'Update Driver'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteDrivers  =  Permission::create(['name' => 'delete_drivers', 'display_name'  =>   ['ar'   =>  'حذف سائق',   'en'          =>  'Delete Driver'], 'route' => 'drivers', 'module' => 'drivers', 'as' => 'drivers.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


         //Deliveries / deliveries
        $manageDeliveries = Permission::create(['name' => 'manage_deliveries', 'display_name' => ['ar'  =>  'إدارة التوصيل',  'en'    =>  'Manage Deliveries'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.index', 'icon' => ' mdi mdi-1 8px mdi-truck-delivery', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageDeliveries->parent_show = $manageDeliveries->id;
        $manageDeliveries->save();
        $showDeliveries    =  Permission::create(['name' => 'show_deliveries',  'display_name' =>   ['ar'   =>  'التوصيل',   'en'        =>  'Deliveries'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.index', 'icon' => ' mdi mdi-1 8px mdi-truck-delivery', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createDeliveries  =  Permission::create(['name' => 'create_deliveries', 'display_name'  =>   ['ar'   =>  'إضافة عملية توصيل',   'en'       =>  'Add New Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayDeliveries =  Permission::create(['name' => 'display_deliveries', 'display_name'  =>   ['ar'   =>  'استعراض عملية توصيل',   'en'      =>  'Display Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateDeliveries  =  Permission::create(['name' => 'update_deliveries', 'display_name'  =>   ['ar'   =>  'تعديل عملية توصيل',   'en'        =>  'Update Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteDeliveries  =  Permission::create(['name' => 'delete_deliveries', 'display_name'  =>   ['ar'   =>  'حذف عملية توصيل',   'en'          =>  'Delete Delivery'], 'route' => 'deliveries', 'module' => 'deliveries', 'as' => 'deliveries.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        //PickupRequests / pickupRequests
        $managePickupRequests = Permission::create(['name' => 'manage_pickup_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الاستلام',  'en'    =>  'Manage Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $managePickupRequests->parent_show = $managePickupRequests->id;
        $managePickupRequests->save();
        $showPickupRequests    =  Permission::create(['name' => 'show_pickup_requests',  'display_name' =>   ['ar'   =>  'طلبات الاستلام',   'en'        =>  'Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPickupRequests  =  Permission::create(['name' => 'create_pickup_requests', 'display_name'  =>   ['ar'   =>  'إضافة عملية طلب استلام',   'en'       =>  'Add New Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPickupRequests =  Permission::create(['name' => 'display_pickup_requests', 'display_name'  =>   ['ar'   =>  'استعراض عملية طلب استلام',   'en'      =>  'Display Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePickupRequests  =  Permission::create(['name' => 'update_pickup_requests', 'display_name'  =>   ['ar'   =>  'تعديل عملية طلب استلام',   'en'        =>  'Update Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePickupRequests  =  Permission::create(['name' => 'delete_pickup_requests', 'display_name'  =>   ['ar'   =>  'حذف عملية طلب استلام',   'en'          =>  'Delete Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

         //ReturnRequests // return_requests
        $manageReturnRequests = Permission::create(['name' => 'manage_return_requests', 'display_name' => ['ar'  =>  'إدارة طلبات المرتجعات',  'en'    =>  'Manage Return Requests'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.index', 'icon' => 'dripicons-return', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageReturnRequests->parent_show = $manageReturnRequests->id;
        $manageReturnRequests->save();
        $showReturnRequests    =  Permission::create(['name' => 'show_return_requests',  'display_name' =>   ['ar'   =>  'طلبات المرتجعات',   'en'        =>  'Return Requests'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.index', 'icon' => 'dripicons-return', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createReturnRequests  =  Permission::create(['name' => 'create_return_requests', 'display_name'  =>   ['ar'   =>  'إضافة عملية طلب ارجاع',   'en'       =>  'Add New Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayReturnRequests =  Permission::create(['name' => 'display_return_requests', 'display_name'  =>   ['ar'   =>  'استعراض عملية طلب ارجاع',   'en'      =>  'Display Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateReturnRequests  =  Permission::create(['name' => 'update_return_requests', 'display_name'  =>   ['ar'   =>  'تعديل عملية طلب ارجاع',   'en'        =>  'Update Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteReturnRequests  =  Permission::create(['name' => 'delete_return_requests', 'display_name'  =>   ['ar'   =>  'حذف عملية طلب ارجاع',   'en'          =>  'Delete Return Request'], 'route' => 'return_requests', 'module' => 'return_requests', 'as' => 'return_requests.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        //ShippingPartners // shipping_partners
        $manageShippingPartners = Permission::create(['name' => 'manage_shipping_partners', 'display_name' => ['ar'  =>  'إدارة شركات الشحن',  'en'    =>  'Manage Shipping Partners'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.index', 'icon' => 'ri-ship-fill', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '60',]);
        $manageShippingPartners->parent_show = $manageShippingPartners->id;
        $manageShippingPartners->save();
        $showShippingPartners    =  Permission::create(['name' => 'show_shipping_partners',  'display_name' =>   ['ar'   =>  'شركات الشحن',   'en'        =>  'Shipping Partners'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.index', 'icon' => 'ri-ship-fill', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createShippingPartners  =  Permission::create(['name' => 'create_shipping_partners', 'display_name'  =>   ['ar'   =>  'إضافة  شركة شحن',   'en'       =>  'Add New Shipping Partner'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayShippingPartners =  Permission::create(['name' => 'display_shipping_partners', 'display_name'  =>   ['ar'   =>  'استعراض  شركة شحن',   'en'      =>  'Display Shipping Partner'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateShippingPartners  =  Permission::create(['name' => 'update_shipping_partners', 'display_name'  =>   ['ar'   =>  'تعديل  شركة شحن',   'en'        =>  'Update Shipping Partner'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteShippingPartners  =  Permission::create(['name' => 'delete_shipping_partners', 'display_name'  =>   ['ar'   =>  'حذف  شركة شحن',   'en'          =>  'Delete Shipping Partner'], 'route' => 'shipping_partners', 'module' => 'shipping_partners', 'as' => 'shipping_partners.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        //ExternalShipments // external_shipments
        $manageExternalShipment = Permission::create(['name' => 'manage_external_shipments', 'display_name' => ['ar'  =>  'إدارة الشحنات الخارجية ',  'en'    =>  'Manage External Shipments'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '65',]);
        $manageExternalShipment->parent_show = $manageExternalShipment->id;
        $manageExternalShipment->save();
        $showExternalShipment    =  Permission::create(['name' => 'show_external_shipments',  'display_name' =>   ['ar'   =>  'الشحنات الخارجية',   'en'        =>  'External Shipments'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.index', 'icon' => 'fas fa-external-link-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createExternalShipment  =  Permission::create(['name' => 'create_external_shipments', 'display_name'  =>   ['ar'   =>  'إضافة  شحنة خارجية',   'en'       =>  'Add New External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayExternalShipment =  Permission::create(['name' => 'display_external_shipments', 'display_name'  =>   ['ar'   =>  'استعراض شحنة خارجية',   'en'      =>  'Display External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateExternalShipment  =  Permission::create(['name' => 'update_external_shipments', 'display_name'  =>   ['ar'   =>  'تعديل  شحنة خارجية',   'en'        =>  'Update External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteExternalShipment  =  Permission::create(['name' => 'delete_external_shipments', 'display_name'  =>   ['ar'   =>  'حذف  شحنة خارجية',   'en'          =>  'Delete External Shipment'], 'route' => 'external_shipments', 'module' => 'external_shipments', 'as' => 'external_shipments.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        //Invoices // invoices
        $manageInvoices = Permission::create(['name' => 'manage_invoices', 'display_name' => ['ar'  =>  'إدارة الفواتير',  'en'    =>  'Manage Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => ' fas fa-file-invoice ', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '70',]);
        $manageInvoices->parent_show = $manageInvoices->id;
        $manageInvoices->save();
        $showInvoices    =  Permission::create(['name' => 'show_invoices',  'display_name' =>   ['ar'   =>  'الفواتير',   'en'        =>  'Invoices'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.index', 'icon' => ' fas fa-file-invoice ', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createInvoices  =  Permission::create(['name' => 'create_invoices', 'display_name'  =>   ['ar'   =>  'إضافة فاتورة',   'en'       =>  'Add New Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayInvoices =  Permission::create(['name' => 'display_invoices', 'display_name'  =>   ['ar'   =>  'استعراض  فاتورة',   'en'      =>  'Display Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updateInvoices  =  Permission::create(['name' => 'update_invoices', 'display_name'  =>   ['ar'   =>  'تعديل فاتورة',   'en'        =>  'Update Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deleteInvoices  =  Permission::create(['name' => 'delete_invoices', 'display_name'  =>   ['ar'   =>  'حذف فاتورة',   'en'          =>  'Delete Invoice'], 'route' => 'invoices', 'module' => 'invoices', 'as' => 'invoices.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


         //PricingRules // pricing_rules
        $managePricingRules = Permission::create(['name' => 'manage_pricing_rules', 'display_name' => ['ar'  =>  'إدارة قواعد التسعير',  'en'    =>  'Manage Pricing Rules'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.index', 'icon' => 'fas fa-pencil-ruler', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '75',]);
        $managePricingRules->parent_show = $managePricingRules->id;
        $managePricingRules->save();
        $showPricingRules    =  Permission::create(['name' => 'show_pricing_rules',  'display_name' =>   ['ar'   =>  'قواعد التسعير',   'en'        =>  'Pricing Rules'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.index', 'icon' => 'fas fa-pencil-ruler', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPricingRules  =  Permission::create(['name' => 'create_pricing_rules', 'display_name'  =>   ['ar'   =>  'إضافة قاعدة تسعير',   'en'       =>  'Add New Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPricingRules =  Permission::create(['name' => 'display_pricing_rules', 'display_name'  =>   ['ar'   =>  'استعراض  قاعدة تسعير',   'en'      =>  'Display Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePricingRules  =  Permission::create(['name' => 'update_pricing_rules', 'display_name'  =>   ['ar'   =>  'تعديل قاعدة تسعير',   'en'        =>  'Update Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePricingRules  =  Permission::create(['name' => 'delete_pricing_rules', 'display_name'  =>   ['ar'   =>  'حذف قاعدة تسعير',   'en'          =>  'Delete Pricing Rule'], 'route' => 'pricing_rules', 'module' => 'pricing_rules', 'as' => 'pricing_rules.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        // //Payments // payments
        // $managePayments = Permission::create(['name' => 'manage_payments', 'display_name' => ['ar'  =>  'إدارة الدفع المالية',  'en'    =>  'Manage Payments'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.index', 'icon' => ' fas fa-money-check-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '75',]);
        // $managePayments->parent_show = $managePayments->id;
        // $managePayments->save();
        // $showPayments    =  Permission::create(['name' => 'show_payments',  'display_name' =>   ['ar'   =>  'الدفع المالية',   'en'        =>  'Payments'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.index', 'icon' => ' fas fa-money-check-alt', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $createPayments  =  Permission::create(['name' => 'create_payments', 'display_name'  =>   ['ar'   =>  'إضافة  دفعة مالية',   'en'       =>  'Add New Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $displayPayments =  Permission::create(['name' => 'display_payments', 'display_name'  =>   ['ar'   =>  'استعراض دفعة مالية',   'en'      =>  'Display Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $updatePayments  =  Permission::create(['name' => 'update_payments', 'display_name'  =>   ['ar'   =>  'تعديل دفعة مالية',   'en'        =>  'Update Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $deletePayments  =  Permission::create(['name' => 'delete_payments', 'display_name'  =>   ['ar'   =>  'حذف دفعة مالية',   'en'          =>  'Delete Payment'], 'route' => 'payments', 'module' => 'payments', 'as' => 'payments.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        $adminRole->attachPermissions([
            $manageMain,
            $manageMerchants,
            $manageProducts,
            $manageWarehouses,
            $manageShelves,
            $manageWarehouseRentals,
            $manageStockItems,
            $managePackages,
            $manageDrivers,
            $manageDeliveries,
            $managePickupRequests,
            $manageReturnRequests,
            $manageShippingPartners,
            $manageExternalShipment,
            $manageInvoices,
            $managePricingRules,
            // $managePayments,

        ]);

        $supervisorRole->attachPermissions([
            $manageMain,
            $manageMerchants,
            $manageProducts,
            $manageWarehouses,
            $manageShelves,
            $manageWarehouseRentals,
            $manageStockItems,
            $managePackages,
            $manageDrivers,
            $manageDeliveries,
            $managePickupRequests,
            $manageReturnRequests,
            $manageShippingPartners,
            $manageExternalShipment,
            $manageInvoices,
            $managePricingRules,
            // $managePayments,

        ]);
    }
}
