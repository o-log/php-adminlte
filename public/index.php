<?php

require_once '../vendor/autoload.php';

\AdminLTEDemo\DemoConfig::init();

\OLOG\Router::matchAction(\AdminLTEDemo\DemoAction::class, 0);