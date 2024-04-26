<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Database.php';

session_start();

$env = new Dotenv();

$db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
date_default_timezone_set("Asia/Kolkata");
// update Stock.
if (
  $db_obj->updateInto(
    'stocks',
    ['stock','price','last_updated'],
    [
      $_POST['name'],
      $_POST['price'],
      date("Y/m/d h:i:sa")
    ],
    $_SESSION['email'],
    $_POST['id']
    )
  ) {
  echo "1";
}
else {
  echo "0";
}

