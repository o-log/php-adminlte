<?php

require_once '../vendor/autoload.php';

\OLOG\ConfWrapper::assignConfig(\AdminLTEDemo\DemoConfig::get());

\OLOG\Router::matchAction(\AdminLTEDemo\DemoAction::class, 0);