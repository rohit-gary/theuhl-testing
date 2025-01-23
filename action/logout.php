<?php
if (!isset($_SESSION['dwd_username'])) {
  session_start();
}
session_destroy();
if (isset($_COOKIE['dwd_UserType'])) {
  unset($_COOKIE['dwd_UserType']);
  unset($_COOKIE['dwd_email']);
  setcookie('dwd_UserType', "", -1, '/');
  setcookie('dwd_email', "", -1, '/');
}
header('Location: ../index');
?>
?>