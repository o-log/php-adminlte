<?php

namespace AdminLTEDemo;

use OLOG\BT;
use OLOG\BT\InterfaceBreadcrumbs;
use OLOG\BT\InterfacePageTitle;
use OLOG\BT\InterfaceUserName;

class DemoAction implements InterfaceBreadcrumbs, InterfacePageTitle, InterfaceUserName
{
    public function currentUserName()
    {
        return 'Demo User';
    }

    public function currentBreadcrumbsArr()
    {
        return [BT\BT::a('/admin/', '', 'glyphicon glyphicon-wrench')];
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

	public function showLayoutContentPanel()
	{
		return false;
	}

	public function overrideBackgroundColor()
    {
        return '';
    }
}