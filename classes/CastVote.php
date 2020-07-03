<?php

class CastVote{
     

public static function InsertVote($cid,$stud_id,$roleid){
      $database = new Database();
        $sql ="INSERT INTO evocastvote(cid,stid,roleid) VALUES('$cid','$stud_id','$roleid')";
    $stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($cid,$stud_id,$roleid));
        if($result_arry){ return true;}
        else{return false;}
     }

     //check if voted

     public static function checkifVoted($stid,$roleid)
     {
       $database = new Database();
       $sql ="SELECT stid,roleid FROM evocastvote WHERE stid = ? && roleid = ?";
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
      $sql = 'SELECT sum(cv.vote) AS numbervote,CONCAT(c.firstname," ", c.lastname) AS fullname FROM evocastvote as cv INNER JOIN evocandidate AS c ON cv.cid = c.id WHERE cv.cid = ?';
      $stmt = $database->conn->prepare($sql);
    $stmt->execute(array($cid));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     public static function confirmVote($stid)
        {
            $database = new Database();
            $sql ="UPDATE `evovoters` SET `status` = ? WHERE `stud_id` = ?";
                 $stmt = $database->conn->prepare($sql);
                $result_arry = $stmt->execute(array($stid));
                if($result_arry){ return true;}
                else{return false;}
        }

      public static function getJSON()
      {
          $database = new Database();
          $sql ='SELECT cv.cid,cv.roleid, CONCAT(c.firstname," ", c.lastname) AS fullname,r.name,count(vote) AS numbervote FROM evocastvote as cv INNER JOIN evocandidate AS c ON cv.cid = c.id INNER JOIN evoroles  AS r ON cv.roleid = r.id GROUP BY(cv.cid)';
          $stmt = $database->conn->prepare($sql);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }



     public static function getWinner($cid,$rid)
     {
       $database = new Database();
       $sql ='SELECT evocastvote.roleid,evocastvote.cid,concat(c.firstname," ",c.lastname) AS fullname,sum(vote) AS ts,COUNT(vote) AS totalVote FROM evocastvote INNER JOIN evocandidate AS c ON evocastvote.cid = c.id INNER JOIN evoroles AS r ON evocastvote.roleid = r.id WHERE evocastvote.cid= ? or evocastvote.roleid = ? GROUP BY  evocastvote.cid  ORDER BY totalVote DESC LIMIT 1';
       $stmt = $database->conn->prepare($sql);
       $stmt->execute(array($cid,$rid));
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
}