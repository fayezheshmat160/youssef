<?php

namespace App\Http\Controllers\Dashboard\Settings;

trait SettingComponents
{


    // Main Tabs
    private static $tabs = [
        'logos' => 'الشعار & الخلفيات',
        'contact' => 'معلومات الاتصال',
        'social' => 'روابط السوشيال ميديا',
        
    ];




    /*
    |
    | Social Media Properties [ Name , Icon , Color , ...]
    | Have Helper Function In \App\Helpers\Functions\main.php Function name socialMedia()
    |
    */
    public static $socialMedia = [
        'facebook'  => [
            'icon' => '<i class="fa-brands fa-facebook-f"></i>',
            'color' => '#0165E1'
        ],
        'twitter'   => [
            'icon' => '<i class="fa-brands fa-twitter"></i>',
            'color' => '#1DA1F2'
        ],
        'instagram' => [
            'icon' => '<i class="fa-brands fa-instagram"></i>',
            'color' => '#E1306C'
        ],
        'youtube'   => [
            'icon' => '<i class="fa-brands fa-youtube"></i>',
            'color' => '#ff0000'
        ],
        'telegram'  => [
            'icon' => '<i class="fa-brands fa-telegram"></i>',
            'color' => '#0088cc'
        ],
        'whatsapp'  => [
            'icon' => '<i class="fa-brands fa-whatsapp"></i>',
            'color' => '#25D366'
        ],
        'tiktok'    => [
            'icon' => '<i class="fa-brands fa-tiktok"></i>',
            'color' => '#000'
        ],

        'linkedin'  => [
            'icon' => '<i class="fa-brands fa-linkedin-in"></i>',
            'color' => '#0a66c2'
        ],

    ];
}
