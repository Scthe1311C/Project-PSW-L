<?php

class User{
    private $data;

    function __construct($data) {
        $this->data = $data;  
    }

    public function __get($name) {
	switch($name){
	    case "address":{
		if(!array_key_exists("address", $this->data)){    
		include './model/connection.php';	    //if address is not upload download it from database
		include './model/address.php';
		
		$sql = "SELECT addresses.id,`city`,`latitude`,`longitude`, code, name FROM addresses, countries
			Where countries.id = ".$this->data["address_id"]." and addresses.id = ".$this->data["address_id"];

		$resource = mysql_query($sql, $sql_conn);
		$data = mysql_fetch_assoc($resource);
		$address = new Address($data);
		$this->data["address"] = $address;
		}
		return $this->data["address"];
	    }
	    default : return $this->data[$name];
	}
    }

    public function __set($name, $value) {
        switch ($name) {
            case "id": throw new Exception('Property: ' .$name.' is private!'); break;
            case "login": throw new Exception('Property: ' .$name.' is private!'); break;
            default: $this->data[$name] = $value;
        }
    }
    
    public function getSignature(){
        $signature = isset($this->data["name"]) || isset($this->data["surname"])?
                                            $this->data["name"]." ".$this->data["surname"] :
                                            $this->data["login"];                                       
        return $signature;
    }
}

class Users{
    public static function getUser($userId){
        include './model/connection.php';
    
        $sql = "SELECT * FROM `users` WHERE id = ".$userId;
        $resource = mysql_query($sql, $sql_conn);
        $data = mysql_fetch_assoc($resource);
        $user  = new User($data);
        return $user;
    }
    
    public static function getUserSignature($userId){
        include './model/connection.php';
        
        $sql = "Select login ,name, surname from users\n"
             . "where users.id = ".$userId;
        
        $resource = mysql_query($sql, $sql_conn);
        $data = mysql_fetch_assoc($resource);
        $signature = isset($data["name"]) || isset($data["surname"])?
                                            $data["name"]." ".$data["surname"] :
                                            $data["login"];                                       
        return $signature;
    }   
}
?>



