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
}
?>



