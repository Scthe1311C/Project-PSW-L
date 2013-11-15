<?php
class Gallery {
    private $id;
    private $designer;
    public $photosRef;
    public $name;
    public $description;
    public $tumbnail;
    
    function __construct($id,$photosRef, $name, $description, $tumbnail, $designer) {
        $this->id = $id;
        $this->photosRef = $photosRef;
        $this->name = $name;
        $this->description = $description;
        $this->tumbnail = $tumbnail;
        $this->designer = $designer;
    }
  public function __get($name) {
        switch ($name) {
            case "id": return $this->id; break;
            case "designer": return $this->designer; break;
            default: throw new InvalidArgumentException('Invalid property: ' . $name);
        }
    }

    public function __set($name, $value) {
        switch ($name) {
            default: throw new InvalidArgumentException('Invalid property: ' . $name);
        }
    }  
    
    function allPhotos(){
        $photos = array();
        foreach ($this->photosRef as $ref){
            $photos[] = Photos::getInstance()->getPhoto($ref);                  
        }
        return $photos;
    }
}

// Singleton class represent all galleries aviable
class Galleries {
    private $galeries;
    private static $instance;
    private function __clone() { } //not provide to make kopy of object

    private function __construct() {
        $this->galeries=[];
        $g1 = new Gallery(1,["src/img/img1.jpg", "src/img/img2.jpg", "src/img/img3.jpg"], "Gallery1", "Test gallery1", "src/img/img1.jpg",1);
        $g2 = new Gallery(2,["src/img/img4.jpg", "src/img/img5.jpg", "src/img/img6.jpg"], "Gallery2", "Test gallery2", "src/img/img4.jpg",2);
        $g3 = new Gallery(3,["src/img/img1.jpg", "src/img/img2.jpg", "src/img/img3.jpg","src/img/img4.jpg", "src/img/img5.jpg", "src/img/img6.jpg","src/img/img7.jpg", "src/img/img8.jpg"], "Popular", "Test gallery2", "src/img/img4.jpg",NULL);
        $galleries = [$g1, $g2, $g3];
        foreach ($galleries as $gallery) {
            $this->addGallery($gallery);
        }
    }

    public static function getInstance() {
        return (self::$instance === null) ? self::$instance = new Galleries() : self::$instance;
    }

    public function addGallery($gallery){
        $this->galeries[$gallery->id] = $gallery;              
    }
    public function getGallery($id){
        return $this->galeries[$id];
    }    
}

?>


