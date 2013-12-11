<?php

abstract class Data {
	protected $data;
	
	public function __construct($data) {
			$this->checkCorrectData($data);
			$this->data = $data;	
	}
	
	public function __get($name) {
		return $this->data[$name];
	}
	
	public function __set($name, $value) {
		$this->checkCorrect($name,$value);
		$this->data[$name] = $value;	
	}
	
	public function setData($data) {
			foreach ($data as $name => $value) {
				__set($name, $value);
			}
	}

	public function getData($names){
		$data = [];
		foreach ($names as $name){
			$data[] = __get($name); 
		}
		return $data;
	}
	
	public function checkCorrectData($data){
		foreach ($data as $name => $value){
			$this->checkCorrect($name, $value);
		}
	}
	
	public function checkCorrect($name, $value){
		return true;
		//throw new Exception("Data not correct".$name." => ".$value);
	}
	
	public function __toString() {
		return  http_build_query($this->data);
	}
}
