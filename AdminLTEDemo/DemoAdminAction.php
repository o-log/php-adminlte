<?php

namespace AdminLTEDemo;

use OLOG\ActionInterface;
use OLOG\AdminLTE\LayoutAdminlte;
use OLOG\HTML;
use OLOG\Layouts\MenuInterface;
use OLOG\Layouts\PageTitleInterface;

class DemoAdminAction implements
    ActionInterface,
    PageTitleInterface,
	MenuInterface
{

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

	static public function menuArr()
    {
	    return DemoMenu::menuArr();
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