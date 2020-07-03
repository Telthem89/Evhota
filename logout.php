<?php
require_once 'classes/function.php';
$candidate = new Candidate();
$redirect = new Redirect();
$candidate->logout();
$_SESSION['err_message'] ="You logout successfully";
$redirect->redirectmeTo('index.php');