<?php

	class User extends Data{

	public function __get($name) {
		switch($name){
			case "address":{
				if(!array_key_exists("address", $this->data)){    					
				$address = getObjectById("Address", $this->data["address_id"]);
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
	
	public static function checkCorrect($name, $value) {
		$isCorrect = TRUE;
		switch ($name){
			case "gender": $isCorrect = ($value == "M" || $value == "F" || $value == NULL);
		}
		if(!$isCorrect)
			throw new Exception("Data not correct".$name." => ".$value);
		return $isCorrect;
	}
}
?>



