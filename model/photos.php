<?php

class Photo {
    private $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function __get($name) {
        return $this->data[$name];
    }
    
    public function allComments(){
        include './model/connection.php';
        
        $sql = "SELECT * FROM comments\n"
             . "WHERE ".$this->data["id"]." = comments.photo_id";
        $resource = mysql_query($sql, $sql_conn);
        $comments = [];
        while($data = mysql_fetch_assoc($resource)){
	    $comment = new Comment($data);
            $comments[]=$comment;
        }
        return $comments;
    }
}
?>
