<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Validator.php';
require_once 'Mailer.php';
require_once 'Database.php';

$env = new Dotenv();

$message = '';

// Perform verification and validations and send otp for registering.
if (
  empty($_POST['email']) ||
  empty($_POST['fname']) ||
  empty($_POST['lname']) ||
  empty($_POST['password']) ||
  empty($_POST['confirm'])
) {
  $message = 'All fields are required.';
}
else {
  $valid = new Validator();
  if (
    !$valid->isValidEmail($_POST['email']) ||
    !$valid->isValidName($_POST['fname']) ||
    !$valid->isValidName($_POST['lname']) ||
    !$valid->isValidPassword($_POST['password'])
  ) {
    $message = 'Please match format requested.';
  }
  elseif ($_POST['password'] != $_POST['confirm']) {
    $message = 'Password does not match.';
  }
  elseif ($valid->isExistingUser($_POST['email'])) {
    $message = 'User already exist';
  }
  else {
    $mail = new Mailer();
     if ($mail->sendOtpMail($_POST['email'],'register')) {
      $message = 'Check Mail for OTP';
      session_start();
      $_SESSION['fname'] = $_POST['fname'];
      $_SESSION['lname'] = $_POST['lname'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password'] = $_POST['password'];
    }
    else {
      $message = 'OTP Was not sent Try again!';
    }
  }
}
echo $message;
