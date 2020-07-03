<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} 
$eleid = $_GET['eleq'];

$results = Election::stopElection($eleid);
//var_dump($results);
if ($results==true) {
	$_SESSION['err_message'] = "Elections has been stopped";
	echo "<script>alert('Elections has been stopped')</script>";
	Redirect::redirectmeTo('Start_Election.php');
}else{
	return false;
}
?>