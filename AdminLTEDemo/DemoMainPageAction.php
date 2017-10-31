<?php

namespace AdminLTEDemo;

use OLOG\HTML;
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
        $html .= '<div>' . HTML::a((new DemoAdminAction())->url(), (new DemoAdminAction())->pageTitle()) . '</div>';

        echo $html;
    }
}