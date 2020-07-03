<?php

class CastVote{
     

public static function InsertVote($cid,$stud_id,$roleid){
      $database = new Database();
        $sql ="INSERT INTO castvote(cid,stid,roleid) VALUES('$cid','$stud_id','$roleid')";
    $stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($cid,$stud_id,$roleid));
        if($result_arry){ return true;}
        else{return false;}
     }

     //check if voted

     public static function checkifVoted($stid,$roleid)
     {
       $database = new Database();
       $sql ="SELECT stid,roleid FROM castvote WHERE stid = ? && roleid = ?";
       $stmt = $database->conn->prepare($sql);
       $stmt->execute(array($stid,$roleid));
       $num = $stmt->rowCount();
       if ($num ==1) {
         return true;
       }
       else {
         return false;
       }
     }

     public static function getVotes($cid)
     {
     	$database = new Database();
     	$sql = 'SELECT sum(cv.vote) AS numbervote,CONCAT(c.firstname," ", c.lastname) AS fullname FROM castvote as cv INNER JOIN candidate AS c ON cv.cid = c.id WHERE cv.cid = ?';
     	$stmt = $database->conn->prepare($sql);
		$stmt->execute(array($cid));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     public static function confirmVote($stid)
        {
            $database = new Database();
            $sql ="UPDATE `voters` SET `status` = ? WHERE `stud_id` = ?";
                 $stmt = $database->conn->prepare($sql);
                $result_arry = $stmt->execute(array($stid));
                if($result_arry){ return true;}
                else{return false;}
        }

      public static function getJSON()
      {
          $database = new Database();
          $sql ='SELECT cv.cid,cv.roleid, CONCAT(c.firstname," ", c.lastname) AS fullname,r.name,count(vote) AS numbervote FROM castvote as cv INNER JOIN candidate AS c ON cv.cid = c.id INNER JOIN roles  AS r ON cv.roleid = r.id GROUP BY(cv.cid)';
          $stmt = $database->conn->prepare($sql);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }



     public static function getWinner($cid,$rid)
     {
       $database = new Database();
       $sql ='SELECT castvote.roleid,castvote.cid,concat(c.firstname," ",c.lastname) AS fullname,sum(vote) AS ts,COUNT(vote) AS totalVote FROM castvote INNER JOIN candidate AS c ON castvote.cid = c.id INNER JOIN roles AS r ON castvote.roleid = r.id WHERE castvote.cid= ? or castvote.roleid = ? GROUP BY  castvote.cid  ORDER BY totalVote DESC LIMIT 1';
       $stmt = $database->conn->prepare($sql);
       $stmt->execute(array($cid,$rid));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
}