<?php
//define('PUBLIC', str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"]));

define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

include_once __DIR__ . '/../vendor/autoload.php';
use App\Dispatcher;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$dispatch = new Dispatcher();
$dispatch->dispatch();
