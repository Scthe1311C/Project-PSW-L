<?php

abstract class Data {
	protected $data;
	
	public function __construct($data) {
		$this->data = $data;
	}
	
	public function __get($name) {
		return $this->data[$name];
	}
	
	public function __set($name, $value) {
		$this->data[$name] = $value;
	}
	
	public function setData($data){
		foreach ($data as $name => $value){
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
	
	protected function allElementsArray($data){
		
	} 
	
	protected function allElementsAssoc($data){
		
	}

	public function __toString() {
		return get_class()."(". http_build_query($this->data).")";
	}
}
