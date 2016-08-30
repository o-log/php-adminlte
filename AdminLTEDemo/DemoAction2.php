<?php

namespace AdminLTEDemo;

use OLOG\BT\InterfacePageTitle;
use OLOG\BT\InterfaceTopActionObj;
use OLOG\InterfaceAction;

class DemoAction2 implements
    InterfaceAction,
    InterfacePageTitle,
    InterfaceTopActionObj
{
    protected $id;

    public function __construct($id = '(\d+)')
    {
        $this->id = $id;
    }

    public function url(){
        return '/action/' . $this->id;
    }

    public function currentPageTitle(){
        return 'Action ' . $this->id;
    }

    public function topActionObj(){
        return new DemoAdminAction();
    }

    public function action(){
        $html = '';

        $html .= '<div>TEST ACTION ' . $this->id . '</div>';

        \OLOG\AdminLTE\Layout::render($html, $this);
    }
}