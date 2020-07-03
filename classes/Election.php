<?php

/**
 * to start election 
 *param id,electionName,date,startTime,endtime
 *status either in progress or Completed
 */
class Election
{
	
	public static function startElection($electionName,$startTime,$endtime,$date_aadded)
	{
		$database = new Database();
		$status = "In Progress";
		$sql ="INSERT INTO elections (`electname`,`start_time`,`stop_time`,`status`,`date_aadded`) VALUES ('$electionName','$startTime','$endtime','$status','$date_aadded')";
		    $stmt = $database->conn->prepare($sql);
		    $result_arry = $stmt->execute(array($electionName,$startTime,$endtime,$status,$date_aadded));
		    if($result_arry){ return true;}
		    else{return false;}
	}

	public static function getElection()
	{
		$database = new Database();
		$sql = "SELECT `id`,`electname`,`start_time`,`stop_time`,`status`,`date_aadded` FROM  elections";
		$stmt = $database->conn->prepare($sql);
		$result_arry = $stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public static function getElectionStatus()
	{
		$database = new Database();
		$sql = "SELECT `id`,`electname`,`start_time`,`stop_time`,`status`,`date_aadded`  FROM  elections";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public static function stopElection($eid)
      {
      	$database = new Database();
        $sql ="UPDATE `elections` SET `status` = 'Completed' , `stopTimeDate` = now()  WHERE `id` = ?";
         $stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($eid));
        if($result_arry){ return true;}
        else{return false;}
     }

     public static function getTimeofElectiontoKickoff()
      {
      	$database = new Database();
        $sql ="SELECT timestampdiff(HOUR,NOW(),c.date_aadded) AS totalLeft from elections c";
        $stmt = $database->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }


	
}