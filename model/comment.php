<?php
class Comment{
    private $data;
    
    public function __construct($data) {
        $this->data = $data;
    }
    
    public function __get($name) {
        return $this->data[$name];
    }

    public function __set($name, $value) {
        switch ($name) {
            case "user_id": throw new Exception('Property: ' .$name.' is private!'); break;
            case "photo_id": throw new Exception('Property: ' .$name.' is private!'); break;
            default: $this->data[$name] = $value;
        }
    }
}
?>
