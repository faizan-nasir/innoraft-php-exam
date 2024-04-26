<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Database.php';

session_start();

$env = new Dotenv();
$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
$email = $_SESSION['email'];

// insert new stocks.
try {
  date_default_timezone_set("Asia/Kolkata");
  if (
  $db_obj->insertInto(
    'stocks',
    ['email', 'stock', 'price', 'created', 'last_updated'],
    [$email, $_POST['stock'], $_POST['price'], date("Y/m/d h:i:sa"), date("Y/m/d h:i:sa")])
  ) {
    echo "1";
  }
  else {
    echo "0";
  }
}
catch (Exception $e) {
  echo "Error";
}
