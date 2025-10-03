<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SystemModulesMenuSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $modules = [
            [
                'title'       => ['ar' => 'نظام إدارة عمليات التوصيل', 'en' => 'Delivery Operations Management'],
                'link'        => ['ar' => 'delivery-operations', 'en' => 'delivery-operations'],
                'icon'        => 'fa fa-truck',
                'description' => [
                    'ar' => 'إدارة جميع عمليات التوصيل من الشحن حتى التسليم النهائي للعملاء بكفاءة وسرعة.',
                    'en' => 'Manage all delivery operations from shipment to final customer delivery efficiently and quickly.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة المستودعات', 'en' => 'Warehouse Management'],
                'link'        => ['ar' => 'warehouse-management', 'en' => 'warehouse-management'],
                'icon'        => 'fa fa-warehouse',
                'description' => [
                    'ar' => 'تنظيم المخازن وإدارة المخزون لضمان التخزين الصحيح وسهولة الوصول للبضائع.',
                    'en' => 'Organize warehouses and manage inventory to ensure proper storage and easy access to goods.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة الطرود', 'en' => 'Parcel Management'],
                'link'        => ['ar' => 'parcel-management', 'en' => 'parcel-management'],
                'icon'        => 'fa fa-box',
                'description' => [
                    'ar' => 'متابعة الطرود من لحظة الاستلام وحتى التسليم مع تحديثات الحالة المستمرة.',
                    'en' => 'Track parcels from pickup to delivery with continuous status updates.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة خدمات النقل', 'en' => 'Transport Services Management'],
                'link'        => ['ar' => 'transport-services', 'en' => 'transport-services'],
                'icon'        => 'fa fa-shipping-fast',
                'description' => [
                    'ar' => 'تنسيق جميع وسائل النقل وتحديد أفضل الطرق والشحنات لضمان سرعة وكفاءة التوصيل.',
                    'en' => 'Coordinate all transport means and determine the best routes and shipments to ensure fast and efficient delivery.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة المرتجعات', 'en' => 'Returns Management'],
                'link'        => ['ar' => 'returns-management', 'en' => 'returns-management'],
                'icon'        => 'fa fa-undo-alt',
                'description' => [
                    'ar' => 'إدارة جميع طلبات المرتجعات بشكل منظم وسريع لضمان رضا العملاء.',
                    'en' => 'Manage all return requests in an organized and fast manner to ensure customer satisfaction.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة العملاء', 'en' => 'Customer Management'],
                'link'        => ['ar' => 'customer-management', 'en' => 'customer-management'],
                'icon'        => 'fa fa-users',
                'description' => [
                    'ar' => 'حفظ معلومات العملاء، متابعة الطلبات والتواصل معهم بشكل فعال.',
                    'en' => 'Store customer information, track orders, and communicate with them effectively.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام إدارة الفواتير والمدفوعات', 'en' => 'Billing & Payments Management'],
                'link'        => ['ar' => 'billing-management', 'en' => 'billing-management'],
                'icon'        => 'fa fa-credit-card',
                'description' => [
                    'ar' => 'إنشاء الفواتير، متابعة المدفوعات والتحكم الكامل في الحسابات المالية للعملاء.',
                    'en' => 'Generate invoices, track payments, and have full control over customer financial accounts.'
                ],
            ],
            [
                'title'       => ['ar' => 'نظام التقارير والإحصائيات', 'en' => 'Reports & Analytics'],
                'link'        => ['ar' => 'reports-analytics', 'en' => 'reports-analytics'],
                'icon'        => 'fa fa-chart-line',
                'description' => [
                    'ar' => 'تقديم تقارير مفصلة وإحصائيات دقيقة لدعم اتخاذ القرارات وتحسين الأداء.',
                    'en' => 'Provide detailed reports and accurate analytics to support decision-making and improve performance.'
                ],
            ],
        ];

        foreach ($modules as $item) {
            Menu::create([
                'title'        => $item['title'],
                'icon'         => $item['icon'],
                'link'         => $item['link'],
                'created_by'   => 'admin',
                'status'       => true,
                'section'      => 3,
                'published_on' => $faker->dateTimeBetween('-6 months', 'now'),
                'parent_id'    => null,
                'description'  => $item['description'], // يمكن إضافتها في قاعدة البيانات إذا كان العمود موجود
            ]);
        }
    }
}
