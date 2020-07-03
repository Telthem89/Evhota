<?php 
require_once 'classes/function.php';
//getLoction.php
 header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');}

$candidate = CastVote::getJSON();
echo json_encode($candidate,true);

?>