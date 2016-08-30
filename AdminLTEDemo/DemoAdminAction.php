<?php

namespace AdminLTEDemo;

use OLOG\BT;
use OLOG\BT\InterfaceBreadcrumbs;
use OLOG\BT\InterfacePageTitle;
use OLOG\BT\InterfaceUserName;
use OLOG\InterfaceAction;

class DemoAdminAction implements
    InterfaceAction,
    InterfacePageTitle,
    InterfaceUserName
{
    public function currentUserName()
    {
        return 'Demo User';
    }

    public function currentPageTitle()
    {
        return 'Admin';
    }

    public function url()
    {
        return '/admin';
    }

    public function action()
    {
        $html = '<div>TEST CONTENT</div>';
        $html .= '<div>' . BT\BT::a((new DemoAction2(2))->url(), (new DemoAction2(2))->currentPageTitle()) . '</div>';

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