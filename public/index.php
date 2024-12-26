<?php

require_once __DIR__ . "/../config/config.php";
require_once ROOT . "/vendor/autoload.php";
require_once HELPERS . "/helpers.php";

use PHPFramework\Application;

$app = new Application();

require_once CONFIG . "/routes.php";

$app->run();