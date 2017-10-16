<?php

require_once '../vendor/autoload.php';

\AdminLTEDemo\DemoConfig::init();

\OLOG\Router::action(\AdminLTEDemo\DemoAdminAction::class, 0);

\OLOG\Router::action(\AdminLTEDemo\DemoAction2::class, 0);
\OLOG\Router::action(\AdminLTEDemo\DemoMainPageAction::class, 0);