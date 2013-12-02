<?php

class Address {
	private $id;
	public $city;
	public $latitude;
	public $longitude;
	public $country_code;
	public $country_name;

	public function __construct($data) {
	$this->id = $data["id"];
	$this->city = $data["city"];
	$this->latitude = $data["latitude"];
	$this->longitude = $data["longitude"];
	$this->country_code = $data["code"];
	$this->country_name = $data["name"];
	}
}
?>
