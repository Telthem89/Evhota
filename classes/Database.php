<?php

class Database
{

	public $conn;
    public function __construct()
    {

	    $host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'evoteapp';
        try {
        	$this->conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
        	die(json_encode(array("message"=>"Cannot connect to DB", "response"=>false)));
        }
    }



}

