<?php
class Comment{
	private $data;

	public function __construct($data) {
		$this->data = $data;
	}

	public function __get($name) {
		return $this->data[$name];
	}
}
?>
