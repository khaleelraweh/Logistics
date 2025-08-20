<?php

return [

    'manage_packages'        => 'إدارة الطرود',
    'add_new_package'        => 'إضافة طرد جديد',
    'packages'               => 'الطرود',
    'package_data'           => 'بيانات الطرد',
    'package_details'        => 'تفاصيل الطرد',
    'package_information'    => 'معلومات الطرد',
    'package_info'           => 'معلومات الطرد',

    'package_description'    => 'يمكنك إدارة الطرود هنا',

    'trip_information'       => 'معلومات الرحلة',
    'basic_informaion'      =>  'المعلومات الأساسية',
    'delivery_options'      =>  'خيارات التوصيل',
    'review'                =>  'مراجعة',
    'review_the_information'                =>  'مراجعة المعلومات',

    'sender_Information'     => 'معلومات المرسل',
    'sender_first_name'      => 'الاسم الأول',
    'sender_middle_name'     => 'اسم الأب',
    'sender_last_name'       => 'الاسم الأخير',
    'sender_email'           => 'البريد الإلكتروني للمرسل',
    'sender_phone'           => 'هاتف المرسل',
    'sender_address'         => 'عنوان المرسل',
    'sender_country'         => 'دولة المرسل',
    'sender_region'          => 'منطقة المرسل',
    'sender_city'            => 'مدينة المرسل',
    'sender_district'        => 'حي المرسل',
    'sender_postal_code'     => 'الرمز البريدي',
    'sender_location'        => 'الموقع الجغرافي',
    'sender_others'          => 'أخرى',

    'receiver_Information'   => 'معلومات المستلم',
    'receiver_first_name'    => 'الاسم الأول',
    'receiver_middle_name'   => 'اسم الأب',
    'receiver_last_name'     => 'الاسم الأخير',
    'receiver_email'         => 'البريد الإلكتروني للمستلم',
    'receiver_phone'         => 'هاتف المستلم',
    'receiver_address'       => 'عنوان المستلم',
    'receiver_country'       => 'دولة المستلم',
    'receiver_region'        => 'منطقة المستلم',
    'receiver_city'          => 'مدينة المستلم',
    'receiver_district'      => 'حي المستلم',
    'receiver_postal_code'   => 'الرمز البريدي',
    'receiver_location'      => 'الموقع الجغرافي',
    'receiver_others'        => 'أخرى',
    'address'               =>  'العنوان',

    'package_specifications'    =>  'مواصفات الطرد',


    'receiver_name'          => 'اسم المستلم',
    'tracking_number'        => 'رقم التتبع',
    'merchant'               => 'التاجر',

    'timeline_title'         => 'خط زمني للطرد',
    'timeline_empty'         => 'لا توجد أحداث مسجلة لهذا الطرد.',

    'status'                 => 'الحالة',

    'log_created'                => 'تم إنشاء الطرد',
    'log_updated_with_status'    => 'تم تحديث حالة الطرد إلى: :status',

    // حالات الطرد
    'status_pending'             => 'قيد الانتظار',
    'status_assigned_to_driver'  => 'تم التعيين للسائق',
    'status_driver_picked_up'    => 'تم الاستلام من السائق',
    'status_in_transit'          => 'في الطريق',
    'status_arrived_at_hub'      => 'وصل إلى المحطة',
    'status_out_for_delivery'    => 'في طريق التسليم',
    'status_delivered'           => 'تم التسليم',
    'status_delivery_failed'     => 'فشل التسليم',
    'status_returned'            => 'تم الإرجاع',
    'status_cancelled'           => 'تم الإلغاء',
    'status_in_warehouse'        => 'في المستودع',

    'total_fee'              => 'إجمالي الرسوم',
    'paid_amount'            => 'المبلغ المدفوع',
    'due_amount'             => 'المبلغ المستحق',
    'remaining_amount'       => 'المبلغ المتبقي',
    'delivery_date'          => 'تاريخ التسليم',
    'expected_delivery_date' => 'تاريخ التسليم المتوقع',
    'delivery_method'        => 'طريقة التوصيل',
    'delivery_speed'         => 'سرعة التوصيل',
    'package_type'           => 'نوع الطرد',
    'package_size'           => 'حجم الطرد',
    'created_at'             => 'تاريخ الإنشاء',

    'show_package'           => 'عرض الطرد',
    'edit_package'           => 'تعديل الطرد',
    'delete_package'         => 'حذف الطرد',

    'collection'             => 'التحصيل',

    'dimensionss'           =>  'الأبعاد',
    'dimensions' => [
        'length'            => 'الطول',
        'width'             => 'العرض',
        'height'            => 'الارتفاع',
    ],

    'cm'                    =>  'سم',

    'package_content'       => 'محتويات الطرد',
    'package_note'          =>  'ملاحظات الطرد',

    'weight'                => 'الوزن',
    'kgm'                   =>  'كجم',

    'additional_information' => 'معلومات إضافية',

    'delivery_fee'          => 'رسوم التوصيل',
    'insurance_fee'         => 'رسوم التأمين',
    'service_fee'           => 'رسوم الخدمة',
    'cod_amount'            => 'الدفع عند الاستلام',

    // طرق التوصيل
    'method_standard'       => 'توصيل عادي',
    'method_express'        => 'توصيل سريع',
    'method_pickup'         => 'استلام من المتجر',
    'method_courier'        => 'خدمة المندوب',

    // أنواع الطرود
    'type_box'              => 'صندوق',
    'type_envelope'         => 'ظرف',
    'type_pallet'           => 'منصة نقالة',
    'type_tube'             => 'أنبوب',
    'type_bag'              => 'حقيبة',

    // مصادر الطرد
    'origin_type'           => 'مصدر الطرد',
    'origin_warehouse'      => 'المستودع',
    'origin_store'          => 'المتجر',
    'origin_home'           => 'المنزل',
    'origin_other'          => 'مصدر آخر',

    // أحجام الطرود
    'size_small'            => 'صغير',
    'size_medium'           => 'متوسط',
    'size_large'            => 'كبير',
    'size_oversized'        => 'كبير جداً',

    // سرعات التوصيل
    'speed_standard'        => 'عادي',
    'speed_express'         => 'سريع',
    'speed_same_day'        => 'نفس اليوم',
    'speed_next_day'        => 'اليوم التالي',

    'payment_responsibility'    => 'مسؤولية الدفع',
    'responsibility_merchant'   => 'التاجر',
    'responsibility_recipient'  => 'المستلم',

    'payment_method' => 'طريقة الدفع',
    'payment_prepaid' => 'مدفوع مسبقاً',
    'payment_cod' => 'الدفع عند الاستلام',
    'payment_exchange' => 'تبديل',
    'payment_bring' => 'إحضار',

    'collection_method' => 'طريقة التحصيل',
    'collection_cash' => 'كاش',
    'collection_cheque' => 'شيك',
    'collection_bank_transfer' => 'حوالة بنكية',
    'collection_e_wallet' => 'محفظة إلكترونية',
    'collection_credit_card' => 'بطاقة ائتمان',
    'collection_mada' => 'مدى',


    'delivery_status_note'      => 'ملاحظات حالة التسليم',

    'additional_options'         =>  'خيارات اضافية',

    'package_attributes'        => 'خصائص إضافية للطرد',

    // خصائص الطرد
    'is_fragile'                => 'هش',
    'is_returnable'             => 'قابل للإرجاع',
    'is_confidential'           => 'معلومات سرية',
    'is_express'                => 'توصيل سريع',
    'is_cod'                   => 'الدفع عند الاستلام',
    'is_gift'                   => 'هدية',
    'is_oversized'              => 'كبير جداً',
    'is_hazardous_material'     => 'مواد خطرة',
    'is_temperature_controlled' => 'يتطلب تحكم بدرجة الحرارة',
    'is_perishable'             => 'قابل للتلف',
    'is_signature_required'     => 'يتطلب توقيع',
    'is_inspection_required'    => 'يتطلب تفتيش',
    'is_special_handling_required' => 'يتطلب معالجة خاصة',

    'save_package_data'         => 'حفظ بيانات الطرد',
    'update_package_data'       => 'تحديث بيانات الطرد',

    // المنتجات في الطرد
    'products_in_package'       => 'المنتجات في الطرد',
    'type'                     => 'النوع',
    'stock_item'               => 'عنصر المخزون',
    'custom_name'              => 'اسم مخصص',
    'quantity'                 => 'الكمية',
    'price_per_unit'           => 'سعر الوحدة',
    'total_price'              => 'السعر الإجمالي',

    'no_products'              => 'لا توجد منتجات مضافة لهذا الطرد.',

    // بيانات الاتصال
    'email'                   => 'البريد الإلكتروني',
    'phone'                   => 'الهاتف',
    'address'                 => 'العنوان',
    'country'                 => 'الدولة',

    'custom'                    => 'مخصص',
    'stock'                     =>  'من مخزن',


    // قسم الفاتورة والدفع
    'invoice_payment'        => 'الفاتورة والدفعات',
    'invoice_number'         => 'رقم الفاتورة',
    'total_amount'           => 'المبلغ الإجمالي',
    'payment_date'           => 'تاريخ الدفع',
    'payment_method'         => 'طريقة الدفع',
    'collection_method'      => 'طريقة التحصيل',
    'amount'                 => 'المبلغ',
    'no_payments'            => 'لا توجد دفعات',
    'no_invoice'             => 'لا توجد فاتورة',

    // الحالات
    'paid'                   => 'مدفوع',
    'pending'                => 'معلق',
    'unpaid'                 => 'غير مدفوع',


];
