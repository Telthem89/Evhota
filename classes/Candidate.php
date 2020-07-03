<?php

class Candidate{
    public  function CreateCandidate($firstname,$lastname,$email,$programme,$gender,$dob,$address,$phone,$imageurl,$roleID)
	{
		$database = new Database();
		$sql ="INSERT INTO candidate (`firstname`,`lastname`,`email`,`programme`,`gender`,`dob`,`address`,`phone`,`imageurl`,`roleID`) VALUES ('$firstname','$lastname','$email','$programme','$gender','$dob','$address','$phone','$imageurl','$roleID')";
		$stmt = $database->conn->prepare($sql);
		    $result_arry = $stmt->execute(array($firstname,$lastname,$email,$programme,$gender,$dob,$address,$phone,$imageurl,$roleID));
		    if($result_arry){ return true;}
		    else{return false;}
    }
    
    public static function getCandidatesPostion()
	{
		$database = new Database();
	 	$sql ="SELECT id,`code`,`name` FROM roles";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCandidate()
    {
        $database = new Database();
        $sql ="SELECT cd.id,CONCAT(cd.firstname,' ',cd.lastname) AS fullname,cd.programme,cd.gender,cd.phone,cd.imageurl,rol.code,rol.name FROM candidate cd INNER JOIN roles AS rol ON  cd.roleID = rol.id";
        $stmt = $database->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public  function getCandidatesPostionPresident()
	{
        // presedent
        $database = new Database();
        $role =1;
	 	$sql ="SELECT cd.id,CONCAT(cd.firstname,' ',cd.lastname) AS fullname,cd.programme,cd.gender,cd.phone,cd.imageurl,rol.id AS rolid,rol.code,rol.name FROM candidate cd INNER JOIN roles AS rol ON  cd.roleID = rol.id WHERE roleID =?";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute(array($role));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public  function getCandidatesPostionVicePresident()
	{
        // vice presedent
        $database = new Database();
        $role =2;
	 	$sql ="SELECT cd.id,CONCAT(cd.firstname,' ',cd.lastname) AS fullname,cd.programme,cd.gender,cd.phone,cd.imageurl,rol.id AS rolid,rol.code,rol.name FROM candidate cd INNER JOIN roles AS rol ON  cd.roleID = rol.id WHERE roleID =?";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute(array($role));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function getCandidatesPostionSecretary()
	{
        // Secretary
        $database = new Database();
        $role =3;
	 	$sql ="SELECT cd.id,CONCAT(cd.firstname,' ',cd.lastname) AS fullname,cd.programme,cd.gender,cd.phone,cd.imageurl,rol.code,rol.id AS rolid,rol.name FROM candidate cd INNER JOIN roles AS rol ON  cd.roleID = rol.id WHERE roleID =?";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute(array($role));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public  function getCandidatesPostionFinance()
	{
        // finance
        $database = new Database();
        $role =4;
	 	$sql ="SELECT cd.id,CONCAT(cd.firstname,' ',cd.lastname) AS fullname,cd.programme,cd.gender,cd.phone,cd.imageurl,rol.id AS rolid,rol.code,rol.name FROM candidate cd INNER JOIN roles AS rol ON  cd.roleID = rol.id WHERE roleID =?";
		$stmt = $database->conn->prepare($sql);
		$stmt->execute(array($role));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	//=====================================UPDATE Candidate AND GET CANDIDATE BY ID====================================================
     public static function getCandidatebyId($cid)
     {
         $database = new Database();
         $sql ="SELECT c.id,c.firstname,c.lastname,c.email,c.programme,c.gender,c.dob,c.address,c.phone,c.imageurl,c.roleID FROM candidate c WHERE id =?";
         $stmt = $database->conn->prepare($sql);
         $stmt->execute(array($cid));
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }


     public static function UpdateCandidate($firstname,$lastname,$email,$programme,$gender,$dob,$address,$phone,$imageurl,$roleID,$cid)
        {
            $database = new Database();
            $sql ="UPDATE `candidate` SET `firstname` = ? , `lastname` = ? ,`email` = ? , `programme` = ?, `gender` = ?, `dob` = ?,`address` = ?,`phone` = ? WHERE `id` = ?";
                 $stmt = $database->conn->prepare($sql);
                $result_arry = $stmt->execute(array($firstname,$lastname,$email,$programme,$gender,$dob,$address,$phone,$imageurl,$roleID,$cid));
                if($result_arry){ return true;}
                else{return false;}
        }

        public static function deleteCandidatebyId($cid)
        {
            $database = new Database();
            $sql = "DELETE FROM candidate WHERE id =?";
                 $stmt = $database->conn->prepare($sql);
                $result_arry = $stmt->execute(array($cid));
                if($result_arry){ return true;}
                else{return false;}
        }
        public static function logout()
        {
            unset($_SESSION['admin_id']);
            unset($_SESSION['fullname']);
            session_destroy();
        }
}

//$candidate = new Candidate();