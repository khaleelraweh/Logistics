<?php

return [

    // العناوين العامة
    'invoice_details'   => 'تفاصيل الفاتورة',
    'invoice_description'   =>  'يمكنك استعراض تفاصيل الفواتير في الاسفل',
    'invoice_info'      => 'معلومات الفاتورة',
    'invoice_number'    => 'رقم الفاتورة',
    'invoice_status'    => 'حالة الفاتورة',
    'merchant'          => 'التاجر',
    'issued_at'         => 'تاريخ الإصدار',
    'due_date'          => 'تاريخ الاستحقاق',
    'currency'          => 'العملة',
    'notes'             => 'ملاحظات',
    'no_notes'          => 'لا توجد ملاحظات',
    'actions'           => 'إجراءات',
    'manage_invoices' => 'إدارة الفواتير',

    // الحالات
    'invoice_status' => 'حالة الفاتورة',

    'status'    => 'الحالة',
    'status_paid'    => 'مدفوع',
    'status_partial' => 'مدفوع جزئياً',
    'status_unpaid'  => 'غير مدفوع',

    'payable_id'    => 'رقم الفاتورة',
    'payable_type'   => 'نوع الدفع ',
    'payable_type_package'   => 'فاتورة طرد',
    'paid_amount'   => 'المبلغ المدفوع',


    // المبالغ
    'total_amount'     => 'المبلغ الإجمالي',
    'amount_paid'      => 'المبلغ المدفوع',
    'remaining_amount' => 'المبلغ المتبقي',

    // قسم المدفوعات
    'payments'        => 'سجل المدفوعات',
    'no_payments'     => 'لا توجد مدفوعات مسجلة لهذه الفاتورة',
    'payment_count'   => ':count مدفوعات',

    // الحقول في جدول المدفوعات
    'payment_amount'   => 'المبلغ',
    'payment_method'   => 'طريقة الدفع',
    'payment_date'     => 'تاريخ الدفع',
    'payment_notes'    => 'ملاحظات',
    'payment_reference'=> 'رقم المرجع',

    'show_invoice' => 'عرض الفاتورة',

    // طرق الدفع
    'methods' => [
        'cash'         => 'نقداً',
        'credit_card'  => 'بطاقة ائتمان',
        'bank_transfer'=> 'تحويل بنكي',
        'wallet'       => 'المحفظة',
        'cod'          => 'الدفع عند الاستلام',
    ],

    // أزرار
    'add_payment'    => 'إضافة دفعة جديدة',
    'record_payment' => 'تسجيل الدفع',
    'edit'           => 'تعديل',
    'delete'         => 'حذف',
    'cancel'         => 'إلغاء',
    'confirm_delete' => 'هل أنت متأكد من حذف هذا الدفع؟',

    // رسائل تنبيه
    'max_amount'     => 'الحد الأقصى: :amount',
    'exceed_amount'  => 'المبلغ المدخل يتجاوز المبلغ المتبقي!',
    'payment_recorded_successfully'     =>  'تم تسجيل الدفع بنجاح',

];
