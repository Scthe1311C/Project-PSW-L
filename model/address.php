<?php

class Address extends Data{
	public function __construct($data) {
		parent::__construct($data);
	}
	public function __get($name) {
		switch ($name){
		case "country": 
			if(!array_key_exists("country", $this->data)){    
				$country = getObjectById("Country", $this->data["country_id"]);
				$this->data["country"] = $country;
			}
			return $this->data["country"];
		default : return $this->data[$name];
		}		
	}
}

class Country extends Data{
	public function __construct($data) {
		parent::__construct($data);
	}
}
?>
