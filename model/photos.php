<?php

class Photo {
    private $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function __get($name) {
        return $this->data[$name];
    }
}
?>
