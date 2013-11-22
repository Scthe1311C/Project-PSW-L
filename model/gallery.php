<?php
class Gallery {
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
            case "user_id": throw new Exception('Property: ' .$name.' is private!'); break;
            default: $this->data[$name] = $value;
        }
    }
    
    public function allPhotos(){
        include './model/connection.php';
        
        $sql = "Select * from photos\n"
             . "where id in\n"
             . "(SELECT photo_id From galleries, photos_galleries\n"
             . "where ".$this->data["id"]." = photos_galleries.gallery_id)";
        
        $resource = mysql_query($sql, $sql_conn);
        $allPhotos = [];
        while($data = mysql_fetch_assoc($resource)){
	    $photo = new Photo($data);
            $allPhotos[$photo->id]=$photo;
        }
        return $allPhotos;
    }
    
    public function getDesignerSignature(){
        include './model/connection.php';
        
        $sql = "Select name, surname from users\n"
             . "where ".$this->data["user_id"]." = users.id";
        
        $resource = mysql_query($sql, $sql_conn);
        return  mysql_fetch_assoc($resource);
    }
    
}
?>


