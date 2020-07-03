<?php
require_once '../classes/init.php';
if (!isset($_SESSION['stud'])) { Redirect::redirectmeTo('index.php');}?>

<?php 
$cid =     $_GET['candidate'];
$stud_id = $_GET['stid'];
$rid =     $_GET['roleid'];

$vote = CastVote::InsertVote($cid,$stud_id,$rid);

if ($vote == true) {
	echo '<script>alert("great your vote has been casted please continue")</script>';
	 Redirect::redirectmeTo('index.php');
}else{
	header("refresh:5;url=index.php");
	echo '<script>alert("error trying to cast your vote")</script>';
}
?>
