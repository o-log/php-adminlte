<?php

namespace AdminLTEDemo;

use OLOG\BT;

class DemoMenu implements BT\InterfaceMenu
{
    static public function menuArr(){
        return [
            new BT\MenuItem('123', '/', NULL, 'fa fa-fw fa-newspaper-o'),
            new BT\MenuItem('234', '', [
                new BT\MenuItem('345', '/2', NULL, 'fa fa-fw fa-star-half-empty'),
                new BT\MenuItem('456', '/3', NULL, 'fa fa-fw fa-user-plus')
            ], 'fa fa-fw fa-recycle'),
            new BT\MenuItem('567', '', [
                new BT\MenuItem('678', '/4'),
                new BT\MenuItem('789', '/5')
            ])
        ];
    }


}