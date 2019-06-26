<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions

  include('public_header.php');
  include('functions.php');
  include('config.php');
  setApiAccessToken();
  $errors = [];

  ?>
