<?php
return [

    // العناوين العامة
    'manage_return_requests'        => 'إدارة المرتجعات',
    'view_return_requests'          => 'عرض المرتجعات',
    'add_new_return_request'        => 'إضافة مرتجع جديد',
    'add_return_request'            => 'إضافة مرتجع',
    'edit_return_request'           => 'تعديل المرتجعات',
    'return_request_data'           => 'بيانات المرتجعات',
    'return_request_description'    => 'يمكنك هنا إدارة ومتابعة المرتجعات.',
    'return_request_info'           => 'معلومات المرتجعات',
    'view_return_request'           => 'عرض تفاصيل المرتجع',
    'additional_info'                => 'معلومات إضافية',
    'edit_return_request_description' => 'يمكنك هنا تعديل تفاصيل طلب الإرجاع.',
    'update_status_reason'      => 'تحديث الحالة والسبب',
    'return_request_summary' => 'ملخص طلب الإرجاع',
    'current_status' => 'الحالة الحالية',
    'status_help_text' => 'اختر الحالة الجديدة لطلب الإرجاع هذا. يُسمح فقط بانتقالات الحالة الصالحة.',
    'timeline' => 'الجدول الزمني',
    'reason_help_text' => 'قدم سببًا لتغيير الحالة، إذا كان ذلك مناسبًا.',
    'quick_actions' => 'إجراءات سريعة',
    'reason_placeholder' => 'أدخل سبب الإرجاع (إن وجد)',
    'package_details' => 'تفاصيل الطرد',
    'customer_info' => 'معلومات العميل',
    'total_requests' => 'إجمالي طلبات المرتجع',
    'pending'       =>  'قيد الانتظار',
    'in_progress'   =>  'قيد التنفيذ',
    'completed'     =>  'مكتمل',

    // أسماء الأعمدة
    'id'                      => 'المعرف',
    'package'                 => 'الطرد',
    'merchant'                => 'التاجر',
    'driver'                  => 'السائق',
    'status'                  => 'الحالة',
    'requested_at'            => 'تاريخ الطلب',
    'received_at'             => 'تاريخ الاستلام',
    'created_at'              => 'تاريخ الإنشاء',
    'updated_at'              => 'تاريخ التحديث',
    'note'                    => 'ملاحظة',
    'reason'                  => 'سبب الإرجاع',
    'target_address'          => 'العنوان الهدف',
    'return_type'             => 'نوع الإرجاع',

    // أنواع الإرجاع
    'type_to_warehouse'       => 'إلى مستودع',
    'type_to_merchant'        => 'إلى تاجر',
    'type_to_both'            => 'إلى مستودع / تاجر',

    // عناصر المرتجع
    'return_items'            => 'عناصر المرتجع',
    'return_item'             => 'عنصر المرتجع',
    'product'                 => 'المنتج',
    'shipped_qty'             => 'الكمية المشحونة',
    'return_qty'              => 'كمية المرتجع',
    'quantity'                => 'الكمية',
    'type'                    => 'النوع',
    'item_id'                 => 'معرف العنصر',

    // الحالات
    'status_requested'        => 'تم تقديم الطلب',
    'status_assigned_to_driver' => 'تم الإسناد إلى سائق',
    'status_picked_up'        => 'السائق استلم الطرد',
    'status_in_transit'       => 'قيد النقل',
    'status_received'        => 'تم الاستلام',
    'status_rejected'        => 'مرفوض',
    'status_partially_received' => 'تم الاستلام جزئيًا',
    'status_cancelled'       => 'تم الإلغاء',
    'unknown'                => 'غير معروف',

    // العمليات
    'show'                    => 'عرض',
    'edit'                    => 'تعديل',
    'delete'                  => 'حذف',
    'save_return_request'     => 'حفظ بيانات طلب الإرجاع',
    'update_return_request'   => 'تحديث بيانات طلب الإرجاع',
    'back'                    => 'رجوع',

    // رسائل
    'no_return_requests_found'  => 'لا توجد طلبات مرتجع مسجلة حالياً.',
    'return_request_created'    => 'تم إنشاء طلب الإرجاع بنجاح.',
    'return_request_updated'    => 'تم تحديث بيانات طلب الإرجاع بنجاح.',
    'return_request_deleted'    => 'تم حذف طلب الإرجاع بنجاح.',
    'return_request_not_found'  => 'طلب الإرجاع غير موجود.',
    'something_went_wrong'     => 'حدث خطأ ما، يرجى المحاولة مرة أخرى.',
    'confirm_delete'           => 'هل أنت متأكد أنك تريد حذف هذا الطلب؟',
    'yes_delete'               => 'نعم، احذف',
    'cancel'                   => 'إلغاء',

    // اختيارات
    'select_driver'            => 'اختر السائق',
    'select_package'           => 'اختر الطرد',

    // إسناد
    'assign_to_driver'        => 'إسناد لسائق',
    'assigned_at'             => 'تاريخ التعيين',
    'assign'                  => 'إسناد',
    'sender'                =>  'المرسل',
    'receiver'                => 'المستلم',
    'return_request_information'    =>  'معلومات طلب الإرجاع',

    'delivery_information'    =>  'معلومات التسليم',
    'reason_message'  => 'أدخل سبب الإرجاع (إن وجد)',
    'all_return_items'    => 'جميع عناصر الطلب',


    //show blade
    'total_items'  => 'إجمالي العناصر',
    'stock_items'  => 'عناصر المخزون',
    'custom_items'  => 'عناصر مخصصة',
    'total_quantity'  => 'إجمالي الكمية',
    'status_timeline' => 'الجدول الزمني للحالة',
    'progress_overview' => 'نظرة عامة على التقدم',
    'no_requests_found' => 'لا توجد طلبات مرتجع.',
    'no_requests_description' => 'يتم عرض طلبات الإرجاع التي تم إنشاؤها بواسطة العملاء هنا.',

];
