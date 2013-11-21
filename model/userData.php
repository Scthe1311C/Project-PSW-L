<?php

class User{
    private $data;

    function __construct($data) {
        $this->data = $data;  
    }

    public function __get($name) {
        return $this->data[$name];
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



