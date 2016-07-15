<?php

namespace AdminLTEDemo;

class DemoConfig
{
    public static function get()
    {
        // for mac
        header('Content-Type: text/html; charset=utf-8');
        date_default_timezone_set('Europe/Moscow');

        $conf['php-bt'] = [
			'layout_class_name' => \OLOG\AdminLTE\Layout::class,
            'menu_classes_arr' => [
                DemoMenu::class
            ],
			'application_title' => 'AdminTEST'
        ];

        return $conf;
    }

}