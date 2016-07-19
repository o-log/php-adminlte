<?php

namespace AdminLTEDemo;

use OLOG\BT\BTConfig;

class DemoConfig
{
    public static function init()
    {
        // for mac
        header('Content-Type: text/html; charset=utf-8');
        date_default_timezone_set('Europe/Moscow');

        BTConfig::setLayoutClassName(\OLOG\AdminLTE\Layout::class);
        BTConfig::setBreadcrumbsPrefixArr([\OLOG\BT\BT::a(\BTDemo\DemoAction::getUrl(), '', 'glyphicon glyphicon-home')]);
        BTConfig::setMenuClassesArr([
            DemoMenu::class
        ]);

        /*
        $conf['php-bt'] = [
			'layout_class_name' => \OLOG\AdminLTE\Layout::class,
            'menu_classes_arr' => [
                DemoMenu::class
            ],
			\OLOG\BT\BTConstants::BREADCRUMBS_PREFIX_ARR => [\OLOG\BT\BT::a(\BTDemo\DemoAction::getUrl(), '', 'glyphicon glyphicon-home')]
        ];

        return $conf;
        */
    }

}