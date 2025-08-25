<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',

    'options' => [
        'default_font' => 'DroidKufi', // الخط الافتراضي
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
    ],

    'font_dir' => storage_path('fonts/'),
    'font_cache' => storage_path('fonts/'),

    'fonts' => [
        'droidkufi' => [
            'R' => 'DroidKufi-Regular.ttf',
            'B' => 'DroidKufi-Bold.ttf',
        ],
        'tajawal' => [
            'R'  => 'Tajawal-Regular.ttf',
            'B'  => 'Tajawal-Bold.ttf',
        ],
    ],
];

