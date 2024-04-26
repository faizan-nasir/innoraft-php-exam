<?php

/**
 * Class to set variables for rendering and managing form actions.
 */
class Actionmanager {

  private $db_obj;

  function __construct() {
    $this->db_obj = new Database($_ENV['HOST_NAME'], $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['DB_PASSWORD']);
  }

  /**
   * Function to manage register form action.
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function registerManager() {
    $msg = '';
    $cls = 'red';

    session_start();
    if (isset($_POST['submit'])) {
      if (empty($_POST['otp']) || !preg_match("/^\d{4}$/", $_POST['otp'])) {
        $msg = 'Invalid OTP';
      }
      elseif($_POST['otp'] != $_SESSION['otp']) {
        $msg = 'OTP Does Not Match.';
      }
      elseif(strtotime('now') > $_SESSION['valid_time']) {
        $msg = 'OTP Expired';
        header('location:/register');
      }
      elseif(
        $this->db_obj->insertInto(
        'user',
        ['first_name', 'last_name', 'email', 'password'],
        [
          $_SESSION['fname'],
          $_SESSION['lname'],
          $_SESSION['email'],
          password_hash($_SESSION['password'], PASSWORD_DEFAULT)
        ]
      )) {
        $msg = 'Successfully Inserted Try Logging In';
        $cls = 'green';
      }
      else {
        $msg = 'Could not save data';
      }
    }
    $this->db_obj->closeDb();
    return [$msg,$cls];
  }

  /**
   * Function to set variables on homepage loading.
   *
   * @return array
   *   Returns the full name.
   */
  public function homeManager() {
    $email = $_SESSION['email'];
    $res = $this->db_obj->selectUser('user', $email);
    $this->db_obj->closeDb();
    return [$res['first_name']. ' ' . $res['last_name']];
  }

  /**
   * Function to manage login action and setting variables
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function loginManager() {
    $msg = '';
    $cls = 'red';
    if (isset($_POST['submit'])) {
      $res = $this->db_obj->selectUser('user', $_POST['email']);
      if ($res) {
        if (
          $res['email'] == $_POST['email'] &&
          password_verify($_POST['password'], $res['password'])
        ) {
          $msg = 'Success';
          $cls = 'green';
          session_start();
          $_SESSION['email'] = $res['email'];
          $_SESSION['fname'] = $res['first_name'];
          $_SESSION['lname'] = $res['last_name'];
          $_SESSION['login'] = 'in';
          header('location:/home');
        }
        else {
          $msg = 'Email or password does not match.';
        }
      }
      else {
        $msg = 'User does not exist! Sign up';
      }
    }
    $this->db_obj->closeDb();
    return [$msg,$cls];
  }

  /**
   * Function to manage edit action and setting variables
   *
   * @return array
   *   Returns an array of size 2 where first element is the status
   *   message and second is the css class.
   */
  public function stockManager() {
    $msg = '';
    $cls = 'red';
    return [$msg, $cls];
  }
}
