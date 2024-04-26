<?php

require_once 'vendor/autoload.php';
require_once 'core/Dotenv.php';
require_once 'Database.php';
require_once 'ActionManager.php';
require_once 'Validator.php';

/**
 * Class to route url to destination
 */
class UrlManager extends ActionManager {

  function __construct() {
    $obj = new Dotenv;
    parent::__construct();
  }

  /**
   * Function to destroy session.
   *
   * @return void
   */
  private function destroy_session() {
    session_start();
    session_unset();
    session_destroy();
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  public function redirectRegister() {
    $res = $this->registerManager();
    $msg = $res[0];
    $cls = $res[1];
    $this->destroy_session();
    require 'register.php';
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  public function redirectLogin() {
    $this->destroy_session();
    $res = $this->loginManager();
    $msg = $res[0];
    $cls = $res[1];
    require 'login.php';
  }

  /**
   * Function to set variables for the view and render the view page
   *
   * @return void
   */
  public function redirectHome() {
    session_start();
    if (
      isset($_SESSION['email']) &&
      isset($_SESSION['login'])
    ) {
      $valid = new Validator();
      if ($valid->isExistingUser($_SESSION['email'])) {
        $res = $this->homeManager();
        $name = $res[0];
        require 'home.php';
      }
      else {
        $this->destroy_session();
        header('location:/register');
      }
    }
    else {
      $this->destroy_session();
      header('location:/');
    }
  }

  /**
   * Function to validate session set variables for the view
   * and render the view page
   *
   * @return void
   */
  function redirectStock() {
    session_start();
    if (
      isset($_SESSION['email']) &&
      isset($_SESSION['login'])
    ) {
      $valid = new Validator();
      if ($valid->isExistingUser($_SESSION['email'])) {
        $res = $this->stockManager();
        require 'stock.php';
      }
      else {
        $this->destroy_session();
        header('location:/register');
      }
    } else {
      $this->destroy_session();
      header('location:/');
    }
  }
}
