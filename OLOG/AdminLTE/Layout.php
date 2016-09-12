<?php

namespace OLOG\AdminLTE;

use OLOG\BT;
use OLOG\InterfaceAction;
use OLOG\Sanitize;

class Layout
{

	static public function render($content_html, $action_obj = null)
	{
		$breadcrumbs_arr = BT\BTConfig::getBreadcrumbsPrefixArr();

		$h1_str = '&nbsp;';
		$menu_arr = [];

		$application_title = BT\BTConfig::getApplicationTitle();
		$page_title = $application_title;

		$user_name = 'Имя пользователя отсутствует';

		if ($action_obj) {
			if ($action_obj instanceof BT\InterfaceBreadcrumbs) {
				$breadcrumbs_arr = array_merge($breadcrumbs_arr, $action_obj->currentBreadcrumbsArr());

				// при такой схеме генерации бредкрамбов в них включается текущая страница, убираем ее
				if (count($breadcrumbs_arr) > 2) {
					array_pop($breadcrumbs_arr);
				}
			}

			if ($action_obj instanceof BT\InterfaceTopActionObj) {
				$top_action_obj = $action_obj->topActionObj();
				$extra_breadcrumbs_arr = [];

				while ($top_action_obj){
					$top_action_title = '#NO_TITLE#';
					if ($top_action_obj instanceof BT\InterfacePageTitle){
						$top_action_title = $top_action_obj->currentPageTitle();
					}

					$top_action_url = '#NO_URL#';
					if ($top_action_obj instanceof InterfaceAction){
						$top_action_url = $top_action_obj->url();
					}

					array_unshift($extra_breadcrumbs_arr, BT\BT::a($top_action_url, $top_action_title));

					$top_action_obj = null;
					if ($top_action_obj instanceof BT\InterfaceTopActionObj) {
						$top_action_obj = $top_action_obj->topActionObj();
					}
				}

				$breadcrumbs_arr = array_merge($breadcrumbs_arr, $extra_breadcrumbs_arr);
			}

			if ($action_obj instanceof BT\InterfacePageTitle) {
				$h1_str = $action_obj->currentPageTitle();
				$page_title = $h1_str;
			}

			if ($action_obj instanceof BT\InterfaceUserName) {
				$user_name = $action_obj->currentUserName();
			}
		}

		$menu_classes_arr = BT\BTConfig::getMenuClassesArr();

		if ($menu_classes_arr) {
			foreach ($menu_classes_arr as $menu_class) {
				if (in_array(BT\InterfaceMenu::class, class_implements($menu_class))) {
					$menu_arr = array_merge($menu_arr, $menu_class::menuArr());
				}
			}
		}

		?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $page_title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.5/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
		  page. However, you can choose any other skin. Make sure you
		  apply the skin class to the body tag so the changes take effect.
	-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.5/css/skins/skin-blue.min.css">

	<style>
		.sidebar-collapse .sidebar-menu .treeview:hover .pull-right-container > .fa {display: none;}
		.sidebar-collapse .sidebar .user-panel .user-ico {width: 30px;height: 30px;}
	</style>
	
	<!-- jQuery 2.2.3 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">





<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="/" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><?= mb_substr($application_title, 0, 3)  ?></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><?= $application_title ?></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
                    <?php /*
					<!-- Messages: style can be found in dropdown.less-->
					<li class="dropdown messages-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
							<span class="label label-success">4</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 4 messages</li>
							<li>
								<!-- inner menu: contains the messages -->
								<ul class="menu">
									<li><!-- start message -->
										<a href="#">
											<div class="pull-left">
												<!-- User Image -->
												<img src="<?= ImageData::render() ?>" class="img-circle" alt="User Image">
											</div>
											<!-- Message title and timestamp -->
											<h4>
												Support Team
												<small><i class="fa fa-clock-o"></i> 5 mins</small>
											</h4>
											<!-- The message -->
											<p>Why not buy a new awesome theme?</p>
										</a>
									</li>
									<!-- end message -->
								</ul>
								<!-- /.menu -->
							</li>
							<li class="footer"><a href="#">See All Messages</a></li>
						</ul>
					</li>
					<!-- /.messages-menu -->
					<!-- Notifications Menu -->
					<li class="dropdown notifications-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 10 notifications</li>
							<li>
								<!-- Inner Menu: contains the notifications -->
								<ul class="menu">
									<li><!-- start notification -->
										<a href="#">
											<i class="fa fa-users text-aqua"></i> 5 new members joined today
										</a>
									</li>
									<!-- end notification -->
								</ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<!-- Tasks Menu -->
					<li class="dropdown tasks-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-flag-o"></i>
							<span class="label label-danger">9</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 9 tasks</li>
							<li>
								<!-- Inner menu: contains the tasks -->
								<ul class="menu">
									<li><!-- Task item -->
										<a href="#">
											<!-- Task title and progress text -->
											<h3>
												Design some buttons
												<small class="pull-right">20%</small>
											</h3>
											<!-- The progress bar -->
											<div class="progress xs">
												<!-- Change the css width attribute to simulate progress -->
												<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
													<span class="sr-only">20% Complete</span>
												</div>
											</div>
										</a>
									</li>
									<!-- end task item -->
								</ul>
							</li>
							<li class="footer">
								<a href="#">View all tasks</a>
							</li>
						</ul>
					</li>
					<!-- User Account Menu -->
                    */ ?>
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<svg viewBox="0 0 50 50" width="25px" height="25px" style="display: block;" class="user-image">
								<circle cx="25" cy="25" fill="none" r="24" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/>
								<rect fill="none" height="50" width="50"/>
								<path fill="#ffffff" d="M29.933,35.528c-0.146-1.612-0.09-2.737-0.09-4.21c0.73-0.383,2.038-2.825,2.259-4.888c0.574-0.047,1.479-0.607,1.744-2.818  c0.143-1.187-0.425-1.855-0.771-2.065c0.934-2.809,2.874-11.499-3.588-12.397c-0.665-1.168-2.368-1.759-4.581-1.759  c-8.854,0.163-9.922,6.686-7.981,14.156c-0.345,0.21-0.913,0.878-0.771,2.065c0.266,2.211,1.17,2.771,1.744,2.818  c0.22,2.062,1.58,4.505,2.312,4.888c0,1.473,0.055,2.598-0.091,4.21c-1.261,3.39-7.737,3.655-11.473,6.924  c3.906,3.933,10.236,6.746,16.916,6.746s14.532-5.274,15.839-6.713C37.688,39.186,31.197,38.93,29.933,35.528z"/>
							</svg>
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?= $user_name ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<svg viewBox="0 0 50 50" width="90px" height="90px" style="display: block;margin: auto;">
									<circle cx="25" cy="25" fill="none" r="24" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/>
									<rect fill="none" height="50" width="50"/>
									<path fill="#ffffff" d="M29.933,35.528c-0.146-1.612-0.09-2.737-0.09-4.21c0.73-0.383,2.038-2.825,2.259-4.888c0.574-0.047,1.479-0.607,1.744-2.818  c0.143-1.187-0.425-1.855-0.771-2.065c0.934-2.809,2.874-11.499-3.588-12.397c-0.665-1.168-2.368-1.759-4.581-1.759  c-8.854,0.163-9.922,6.686-7.981,14.156c-0.345,0.21-0.913,0.878-0.771,2.065c0.266,2.211,1.17,2.771,1.744,2.818  c0.22,2.062,1.58,4.505,2.312,4.888c0,1.473,0.055,2.598-0.091,4.21c-1.261,3.39-7.737,3.655-11.473,6.924  c3.906,3.933,10.236,6.746,16.916,6.746s14.532-5.274,15.839-6.713C37.688,39.186,31.197,38.93,29.933,35.528z"/>
								</svg>

								<p><?= $user_name ?></p>
							</li>
                            <?php /*
							<!-- Menu Body -->
							<li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
								<!-- /.row -->
							</li>
                            */ ?>
							<!-- Menu Footer-->
							<li class="user-footer">
                                <?php /*
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Profile</a>
								</div>
                                */ ?>
								<div class="pull-right">
									<a href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
                    <?php /*
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
                    */ ?>
				</ul>
			</div>
		</nav>

	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel (optional) -->
			<div class="user-panel">
				<div class="pull-left image">
					<svg viewBox="0 0 50 50" width="45px" height="45px" style="display: block;" class="user-ico">
						<circle cx="25" cy="25" fill="none" r="24" stroke="#b8c7ce" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/>
						<rect fill="none" height="50" width="50"/>
						<path fill="#b8c7ce" d="M29.933,35.528c-0.146-1.612-0.09-2.737-0.09-4.21c0.73-0.383,2.038-2.825,2.259-4.888c0.574-0.047,1.479-0.607,1.744-2.818  c0.143-1.187-0.425-1.855-0.771-2.065c0.934-2.809,2.874-11.499-3.588-12.397c-0.665-1.168-2.368-1.759-4.581-1.759  c-8.854,0.163-9.922,6.686-7.981,14.156c-0.345,0.21-0.913,0.878-0.771,2.065c0.266,2.211,1.17,2.771,1.744,2.818  c0.22,2.062,1.58,4.505,2.312,4.888c0,1.473,0.055,2.598-0.091,4.21c-1.261,3.39-7.737,3.655-11.473,6.924  c3.906,3.933,10.236,6.746,16.916,6.746s14.532-5.274,15.839-6.713C37.688,39.186,31.197,38.93,29.933,35.528z"/>
					</svg>
				</div>
				<div class="pull-left info">
					<p><?= $user_name ?></p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>


			<!-- search form (Optional) -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
				</div>
			</form>
			<!-- /.search form -->

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<li class="header">Меню</li>
				<!-- Optionally, you can add icons to the links -->
				<?php

				/** @var $menu_item_obj MenuItem */
				foreach ($menu_arr as $menu_item_obj) {
					$children_arr = $menu_item_obj->getChildrenArr();

					$href = '';
					if ($menu_item_obj->getUrl()) {
						$href = 'href="' . Sanitize::sanitizeUrl($menu_item_obj->getUrl()) . '"';
					}

					$icon = '';
					if ($menu_item_obj->getIconClassesStr()) {
						$icon = '<i class="' . $menu_item_obj->getIconClassesStr() . '"></i> ';
					}

					if (count($children_arr)) {
						echo '<li class="treeview">';
						echo '<a ' . $href . '>' . $icon . '<span>' . Sanitize::sanitizeTagContent($menu_item_obj->getText()) . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
						echo '<ul class="treeview-menu">';
						/** @var  $child_menu_item_obj MenuItem */
						foreach ($children_arr as $child_menu_item_obj) {
							$children_href = '';
							if ($child_menu_item_obj->getUrl()) {
								$children_href = 'href="' . Sanitize::sanitizeUrl($child_menu_item_obj->getUrl()) . '"';
							}

							$children_icon = '';
							if ($child_menu_item_obj->getIconClassesStr()) {
								$children_icon = '<i class="' . $child_menu_item_obj->getIconClassesStr() . '"></i> ';
							}

							echo '<li><a ' . $children_href . '>' . $children_icon . '<span>' . Sanitize::sanitizeTagContent($child_menu_item_obj->getText()) . '</span></a></li>';
						}
						echo '</ul>';
					} else {
						echo '<li><a ' . $href . '>' . $icon . '<span>' . Sanitize::sanitizeTagContent($menu_item_obj->getText()) . '</span></a></li>';
					}
				}
				?>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
    <?php
        $override_background_color = '';
        if (method_exists($action_obj, 'overrideBackgroundColor')) {
            if ($action_obj->overrideBackgroundColor()) {
                $override_background_color = 'style="background-color: ' . $action_obj->overrideBackgroundColor() . ';"';
            }
        }
    ?>
	<div class="content-wrapper" <?= $override_background_color ?>>
		<!-- Content Header (Page header) -->
		<section class="content-header">
            <style>
                .content-header>.breadcrumb {position: relative;margin-top: 5px;top: 0;right: 0;float: none;padding-left: 0;font-size: 20px; display: inline-block; vertical-align: middle;}
                .content-header>.breadcrumb>li+li:before {content: '/\00a0';color: #b0b0b0;}
                .content-header>.breadcrumb>li>a {color: #3c8dbc;}
                .content-header>.breadcrumb>li>div {color: #000000;}
				.content-header>.toolbar {display: inline-block; vertical-align: middle;}
            </style>
			<?php
			if (!empty($breadcrumbs_arr)) {
                $breadcrumbs_arr = array_merge($breadcrumbs_arr, [BT\BT::div('<h1 style="display: inline;">' . $h1_str . '</h1>', 'style="display: inline;"')]);

				echo BT\BT::breadcrumbs($breadcrumbs_arr);
			}

			if (method_exists($action_obj, 'pageToolbarHtml')){
				echo '<span class="toolbar">';
				echo $action_obj->pageToolbarHtml();
				echo '</span>';
			}

			?>
            <!--
            <h1>
                <?= $h1_str ?>
            </h1>
            -->
		</section>

		<!-- Main content -->
		<section class="content">
			<?php

				if (method_exists($action_obj, 'showLayoutContentPanel')) {
					if ($action_obj->showLayoutContentPanel()) {
			?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?= $content_html ?>
					</div>
				</div>
			<?php
					} else {
						echo $content_html;
					}
				} else {
			?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?= $content_html ?>
					</div>
				</div>
			<?php
				}
			?>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<strong>Copyright &copy; 2016.
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript::;">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>

							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript::;">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
							</h4>

							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>

					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>

						<p>
							Some information about this general settings option
						</p>
					</div>
					<!-- /.form-group -->
				</form>
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
		 immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>


 </div>
<!-- ./wrapper -->










<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.5/js/app.min.js"></script>

</body>
</html>

		<?php
	}
}