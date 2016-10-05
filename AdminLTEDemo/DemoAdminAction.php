<?php

namespace AdminLTEDemo;

use OLOG\AdminLTE\LayoutAdminlte;
use OLOG\HTML;
use OLOG\InterfaceAction;
use OLOG\Layouts\InterfacePageTitle;

class DemoAdminAction implements
    InterfaceAction,
    InterfacePageTitle
{
    /*
    public function currentUserName()
    {
        return 'Demo User';
    }
    */

    public function pageTitle()
    {
        return 'Admin';
    }

    public function url()
    {
        return '/admin';
    }

    public function pageToolbarHtml(){
        return '<a class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></a>';
    }

    public function action()
    {
        $html = '<div>TEST CONTENT</div>';
        $html .= '<div>' . HTML::a((new DemoAction2(2))->url(), (new DemoAction2(2))->pageTitle()) . '</div>';

        LayoutAdminlte::render($html, $this);
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