<?php
  require_once 'classes/function.php';
 $database = new Database();

$status ="";
if (isset($_GET['stud_id']) && isset($_GET['password'])) {
	   $stud_id = trim($_GET['stud_id']);
     $password = md5(trim($_GET['password']));

    global $database;
        $sql ='SELECT * FROM voters where stud_id =? and password =?';
        $stmt = $database->conn->prepare($sql);
        $stmt->execute(array($stud_id,$password));
        $result_found= $stmt->fetch(PDO::FETCH_ASSOC);
        if($result_found == false){
              $status ="Failed";
              echo json_encode(array('response' =>$status));
         }
    else{
        $fullname = $result_found['firstname']." ".$result_found['lastname'];
        $user_id = $result_found['stud_id'];
        $status ="Success";
        echo json_encode(array('response' =>$status,'fullname'=>$fullname,'stud_id'=>$user_id ));
    }
}

   	// echo md5("123456");