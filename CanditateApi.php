<?php
  require_once 'classes/function.php';
  $candidate = new Candidate();
 header('Content-Type: application/json');

$candidate = $candidate->getAllCandidate();
echo json_encode($candidate,true);