<?php

class Address extends Data{
	public function __construct($data) {
		parent::__construct($data);
		$this->data["country_name"] = $data["name"];
		$this->data["country_code"] = $data["code"];
	}
}
?>
