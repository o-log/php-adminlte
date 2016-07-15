<?php

namespace AdminLTEDemo;

use OLOG\BT;

class DemoMenu implements BT\InterfaceMenu
{
    static public function menuArr(){
        return [
            new BT\MenuItem('123', '/', NULL, 'glyphicon glyphicon-th-list'),
            new BT\MenuItem('234', '', [
                new BT\MenuItem('345', '/2', NULL, 'glyphicon glyphicon-pencil'),
                new BT\MenuItem('456', '/3', NULL, 'glyphicon glyphicon-folder-open')
            ], 'glyphicon glyphicon-home'),
            new BT\MenuItem('567', '', [
                new BT\MenuItem('678', '/4'),
                new BT\MenuItem('789', '/5')
            ])
        ];
    }


}