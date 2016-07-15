<?php

namespace AdminLTEDemo;

use OLOG\BT;
use OLOG\BT\InterfaceBreadcrumbs;
use OLOG\BT\InterfacePageTitle;

class DemoAction implements InterfaceBreadcrumbs, InterfacePageTitle, BT\InterfaceUserName
{
    public function currentUserName()
    {
        return 'Demo User';
    }

    public function currentBreadcrumbsArr()
    {
        return array_merge([BT\BT::a('/', '', 'glyphicon glyphicon-home')], [BT\BT::a('/admin/', '', 'glyphicon glyphicon-wrench')]);
    }

    public function currentPageTitle()
    {
        return 'TEST PAGE TITLE';
    }

    static public function getUrl()
    {
        return '/';
    }

    public function action()
    {
        $html = '<div>TEST CONTENT</div>';

        \OLOG\AdminLTE\Layout::render($html, $this);
    }
}