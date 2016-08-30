<?php

namespace AdminLTEDemo;

use OLOG\BT;
use OLOG\BT\InterfaceBreadcrumbs;
use OLOG\BT\InterfacePageTitle;
use OLOG\BT\InterfaceUserName;
use OLOG\InterfaceAction;

class DemoMainPageAction implements
    InterfaceAction
{
    public function currentPageTitle()
    {
        return 'TEST PAGE TITLE';
    }

    public function url()
    {
        return '/';
    }

    public function action()
    {
        $html = '';
        $html .= '<div>' . BT\BT::a((new DemoAdminAction())->url(), (new DemoAdminAction())->currentPageTitle()) . '</div>';

        echo $html;
    }
}