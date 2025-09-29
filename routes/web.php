<?php

use Illuminate\Support\Facades\Route;

// تعطيل الديباجر
app('debugbar')->disable();

// تحميل جميع ملفات الروoutes
require base_path('routes/auth.php');
require base_path('routes/frontend.php');
require base_path('routes/admin.php');
require base_path('routes/merchant.php');
require base_path('routes/driver.php');
require base_path('routes/frontend_dashboard.php');
