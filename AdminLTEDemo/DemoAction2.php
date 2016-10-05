<?php

namespace AdminLTEDemo;

use OLOG\AdminLTE\LayoutAdminlte;
use OLOG\InterfaceAction;
use OLOG\Layouts\InterfacePageTitle;
use OLOG\Layouts\InterfaceTopActionObj;

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

    public function pageTitle(){
        return 'Action ' . $this->id;
    }

    public function topActionObj(){
        return new DemoAdminAction();
    }

    public function action(){
        $html = '';

        $html .= '<div>TEST ACTION ' . $this->id . '</div>';

        LayoutAdminlte::render($html, $this);
    }
}