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
		include './model/address.php';

                $data = DAO::select(
                        ["addresses", "countries"], 
                        ["addresses.id", "city", "latitude", "longitude", "code", "name"],
                        [new Condition("countries.id", "=", $this->data["address_id"]), new Condition("addresses.id", "=", $this->data["address_id"])],
                        NULL)[0];
		$address = new Address($data);
		$this->data["address"] = $address;
		}
		return $this->data["address"];
	    }
	    default : return $this->data[$name];
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
        $data = DAO::select("users", "*", new Condition("id","=",$userId), NULL)[0];
        $user  = new User($data);
        return $user;
    }
    
    public static function getUserSignature($userId){
        $data = DAO::select("users", ["name", "surname", "login"], new Condition("id","=",$userId), NULL)[0];
        $user = new User($data);                                  
        return $user->getSignature();
    }   
}
?>



