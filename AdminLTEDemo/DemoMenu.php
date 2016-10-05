<?php

namespace AdminLTEDemo;


use OLOG\Layouts\InterfaceMenu;
use OLOG\Layouts\MenuItem;

class DemoMenu implements InterfaceMenu
{
    static public function menuArr(){
        return [
            new MenuItem('123', '/', NULL, 'glyphicon glyphicon-th-list'),
            new MenuItem('234', '', [
                new MenuItem('345', '/2', NULL, 'glyphicon glyphicon-pencil'),
                new MenuItem('456', '/3', NULL, 'glyphicon glyphicon-folder-open')
            ], 'glyphicon glyphicon-home'),
            new MenuItem('567', '', [
                new MenuItem('678', '/4'),
                new MenuItem('789', '/5')
            ])
        ];
    }


}