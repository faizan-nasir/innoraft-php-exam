<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Database.php';

session_start();

$env = new Dotenv();

$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
$task = "Edit";
$cls = 'selectBtn';
$res = $db_obj->getDefaultItems($_SESSION['email']);
// Load default number of products and display them.
require 'ajax-display.php';
