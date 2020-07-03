<?php
require_once '../classes/init.php';
$Voters = new Voters();
$redirect = new Redirect();
$Voters->logout();
$_SESSION['err_message'] ="You logout successfully";
Redirect::redirectmeTo('../index.php');