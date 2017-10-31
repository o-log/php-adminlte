<?php

require_once '../vendor/autoload.php';

\AdminLTEDemo\DemoConfig::init();

\OLOG\Router::processAction(\AdminLTEDemo\DemoAdminAction::class, 0);

\OLOG\Router::processAction(\AdminLTEDemo\DemoAction2::class, 0);
\OLOG\Router::processAction(\AdminLTEDemo\DemoMainPageAction::class, 0);