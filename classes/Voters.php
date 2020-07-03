<?php

class Voters{
    public static function CreateVoter($stud_id,$firstname,$lastname,$password,$email,$gender,$dob,$address,$phone,$programme)
	{
        $database = new Database();
        $sql ="INSERT INTO `evoteapp`.`voters` (`stud_id`, `firstname`, `lastname`, `password`, `email`, `gender`, `dob`, `address`, `phone`, `programme`) VALUES ('$stud_id', '$firstname', '$lastname', '$password', '$email', '$gender', '$dob', '$address', '$phone', '$programme')";
		$stmt = $database->conn->prepare($sql);
        $result_arry = $stmt->execute(array($stud_id,$firstname,$lastname,$password,$email,$gender,$dob,$address,$phone,$programme));
		    if($result_arry){ return true;}
		    else{return false;}
    }
    public static function getAllVoters()
    {
        $database = new Database();
        $sql ="SELECT v.stud_id,v.firstname,v.lastname,v.email,v.gender,v.dob,v.address,v.phone FROM voters v";
        $stmt = $database->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getVoterbyId($stud_id)
    {
        $database = new Database();
        $sql ="SELECT v.stud_id,v.firstname,v.lastname,v.email,v.gender,v.dob,v.address,v.phone FROM voters v WHERE stud_id =?";
        $stmt = $database->conn->prepare($sql);
        $stmt->execute(array($stud_id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function UpdateVoter($firstname,$lastname,$email,$password,$gender,$programme,$dob,$address,$phone,$stud_id )
    {
        $database = new Database();
        $sql ="UPDATE `voters` SET `firstname` = ? , `lastname` = ? ,`email` = ? , `password` = ?, `gender` = ?,`address` = ?,`phone` = ? WHERE `stud_id` = ?";
             $stmt = $database->conn->prepare($sql);
            $result_arry = $stmt->execute(array($firstname,$lastname,$email,$password,$gender,$dob,$address,$phone,$stud_id));
            if($result_arry){ return true;}
            else{return false;}
    }

    public static function deleteVoterbyId($stud_id)
    {
        $database = new Database();
        $sql = "DELETE FROM voters WHERE stud_id =?";
             $stmt = $database->conn->prepare($sql);
            $result_arry = $stmt->execute(array($stud_id));
            if($result_arry){ return true;}
            else{return false;}
    }
    public static function logout()
    {
        unset($_SESSION['stud']);
        unset($_SESSION['fullname']);
        session_destroy();
    }



}