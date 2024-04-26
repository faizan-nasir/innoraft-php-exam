<?php

// Require managerler class
require 'UrlManager.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];
$url = explode('/', $url);
// Break down the url for routing.

$manager = new UrlManager();
// Object of manager.

// Routing.
switch ($url[1]) {
  case '':
    $manager->redirectLogin();
    break;
  case 'register':
    $manager->redirectRegister();
    break;
  case 'home':
    $manager->redirectHome();
    break;
  case 'stock-entry':
    $manager->redirectStock();
    break;
  default:
    header('HTTP/1.0 404 not found');
}
