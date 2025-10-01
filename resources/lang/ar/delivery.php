<?php
    return [

        // العناوين العامة
        'manage_deliveries'        => 'إدارة عمليات التوصيل',
        'view_deliveries'          => 'عرض عمليات التوصيل',
        'add_new_delivery'         => 'إضافة توصيل جديد',
        'add_delivery'            => 'إضافة عملية توصيل',
        'edit_delivery'           => 'تعديل عملية التوصيل',
        'delivery_data'           => 'بيانات التوصيل',
        'delivery_description'    => 'يمكنك هنا إدارة ومتابعة عمليات التوصيل.',
        'delivery_info'           => 'معلومات التوصيل',

        'update_status'         => 'تحديث الحالة',
        'update_delivery_status' => 'تحديث حالة التوصيل',
        'add_delivery_note_placeholder' => 'أضف ملاحظة حول حالة التوصيل...',
        'special_instructions' => 'تعليمات خاصة',
        'view_on_map' => 'عرض على الخريطة',
        'recipient'       => 'المستلم',
        'address'       => 'العنوان',
        'cod_amount'       => 'الدفع عند الاستلام',

        'delivery_details'        => 'تفاصيل التوصيل',
        'driver_info'             => 'معلومات السائق',
        'package_info'            => 'معلومات الطرد',
        'timeline_title'         => 'جدول زمني للتوصيل',
        'receiver'           => 'المستلم',

        'delivery_updated_status' => 'تم تحديث حالة التوصيلة إلى :status، السائق: :driver',
        'delivery_assigned_status' => 'تم إسناد التوصيلة للسائق: :driver',



        // أسماء الأعمدة
        'package'                 => 'الطرد',
        'driver'                  => 'السائق',
        'status'                  => 'الحالة',
        'assigned_at'             => 'تاريخ التعيين',
        'delivered_at'            => 'تاريخ التسليم',
        'created_at'              => 'تاريخ الإنشاء',
        'note'                    => 'ملاحظة',
        'actions'                 => 'الإجراءات',

        // الحالات
        'status_pending'            => 'قيد الانتظار',
        'status_assigned_to_driver' => 'تم التعيين للسائق',
        'status_driver_picked_up'   => 'استلم السائق الطرد',
        'status_in_transit'         => 'في الطريق',
        'status_arrived_at_hub'     => 'وصل إلى المستودع',
        'status_out_for_delivery'   => 'خارج للتسليم',
        'status_delivered'          => 'تم التسليم',
        'status_delivery_failed'    => 'فشل التسليم',
        'status_returned'           => 'تم الإرجاع',
        'status_cancelled'          => 'ملغي',
        'status_in_warehouse'       => 'في المستودع',


        // العمليات
        'show'                    => 'عرض',
        'edit'                    => 'تعديل',
        'delete'                  => 'حذف',
        'save_delivery'           => 'حفظ بيانات التوصيل',
        'update_delivery'        => 'تحديث بيانات التوصيل',

        // رسائل
        'no_deliveries_found'     => 'لا توجد عمليات توصيل مسجلة حالياً.',
        'delivery_created'       => 'تم إنشاء عملية التوصيل بنجاح.',
        'delivery_updated'       => 'تم تحديث بيانات التوصيل بنجاح.',
        'delivery_deleted'       => 'تم حذف عملية التوصيل بنجاح.',
        'something_went_wrong'   => 'حدث خطأ ما، يرجى المحاولة مرة أخرى.',
        'confirm_delete'         => 'هل أنت متأكد أنك تريد حذف هذه العملية؟',
        'yes_delete'             => 'نعم، احذف',
        'cancel'                 => 'إلغاء',

        // اختيارات
        'select_driver'          => 'اختر السائق',
        'select_package'         => 'اختر الطرد',

        // اسناد
        'assign_to_driver' => 'إسناد لسائق',
        'assigned_at' => 'تاريخ التعيين',
        'note' => 'ملاحظات',
        'assign' => 'إسناد',
        'view_delivery' => 'عرض التوصيل',

        // index blade
        'status_updated_successfully' => 'تم تحديث حالة التسليم بنجاح',
        'unauthorized_status_update' => 'غير مصرح لك بتحديث حالة هذا التسليم',

        // نصوص السجلات
        'log_driver_picked_up' => 'قام السائق :driver باستلام الطرد في الساعة :time',
        'log_in_transit' => 'الطرد قيد النقل مع السائق :driver',
        'log_arrived_at_hub' => 'الطرد وصل إلى المركز',
        'log_out_for_delivery' => 'الطرد خرج للتوصيل',
        'log_delivered' => 'تم تسليم الطرد في :time بواسطة السائق :driver',
        'log_delivery_failed' => 'فشل محاولة التوصيل (المحاولة :attempt)',
        'log_returned' => 'تم إرجاع الطرد',
        'log_cancelled' => 'تم إلغاء التسليم',
        'log_status_changed' => 'تم تغيير الحالة من :from إلى :to',

        // نصوص الحالات
        'mark_as' => 'تحديد كـ',

        // نصوص الإشعارات
        'notification_delivered' => 'تم تسليم طردك بنجاح',
        'notification_failed' => 'فشل توصيل طردك',

            // نصوص الإحصائيات
    'total_deliveries' => 'إجمالي التسليمات',
    'pending' => 'معلقة',
    'assigned' => 'مسندة',
    'in_transit' => 'قيد النقل',
    'delivered' => 'تم التسليم',
    'failed_cancelled' => 'فاشلة/ملغاة',

    // الإحصائيات التفصيلية
    'detailed_statistics' => 'الإحصائيات التفصيلية',
    'picked_up' => 'تم الاستلام',
    'at_hub' => 'في المركز',
    'out_for_delivery' => 'خارج للتسليم',
    'successful' => 'ناجحة',
    'failed' => 'فاشلة',
    'returned' => 'مرتجعة',

    // حالات التسليم
    'status_pending' => 'معلقة',
    'status_assigned_to_driver' => 'مسندة للسائق',
    'status_driver_picked_up' => 'تم الاستلام',
    'status_in_transit' => 'قيد النقل',
    'status_arrived_at_hub' => 'وصلت للمركز',
    'status_out_for_delivery' => 'خارج للتسليم',
    'status_delivered' => 'تم التسليم',
    'status_delivery_failed' => 'فشل التسليم',
    'status_returned' => 'مرتجعة',
    'status_cancelled' => 'ملغاة',
    'status_in_warehouse' => 'في المستودع',

     'view_pending' => 'عرض المعلقة',
    'view_assigned' => 'عرض المسندة',
    'view_in_transit' => 'عرض قيد النقل',
    'view_delivered' => 'عرض التي تم تسليمها',
    'view_failed_cancelled' => 'عرض الفاشلة/الملغاة',
    'view_returned' => 'عرض المرتجعة',
    'view_in_warehouse' => 'عرض في المستودع',
    'today_deliveries' => 'توصيلات اليوم',
    'nearest_deliveries' => 'أقرب التوصيلات',

    'scheduled_today' => 'المجدولة لليوم',
    'by_distance' => 'حسب المسافة',


    ];
