<?php
//class included gallery discription and content
class Gallery {
    private $id;
    private $photos;
    private $name;
    private $description;
    private $tumbnail;
    private $designer;
    
    function __construct($id,$photos, $name, $description, $tumbnail, $designer) {
        $this->id = $id;
        $this->photos = $photos;
        $this->name = $name;
        $this->description = $description;
        $this->tumbnail = $tumbnail;
        $this->designer = $designer;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPhotos() {
        return $this->photos;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getTumbnail() {
        return $this->tumbnail;
    }
    
    public function getDesigner(){
        return $this->designer;
    }

    public function __toString() {
        return $this->id." ";
    }

}

class Galleries{
    private $galeries;
        
    public function __construct($galleries) {
        $this->galeries=[];
        foreach ($galleries as $gallery) {
            $this->addGallery($gallery);
        }
    }
    
    public function getAllGalleries(){
        return $this->galeries;
    }

    public function addGallery($gallery){
        $this->galeries[$gallery->getId()] = $gallery;              
    }
    public function getGallery($id){
        return $this->galeries[$id];
    }
}
?>
<?php  

$g1 = new Gallery(1,["src/img/img1.jpg", "src/img/img2.jpg", "src/img/img3.jpg"], "Gallery1", "Test gallery1", "src/img/img1.jpg",1);
$g2 = new Gallery(2,["src/img/img4.jpg", "src/img/img5.jpg", "src/img/img6.jpg"], "Gallery2", "Test gallery2", "src/img/img4.jpg",2);
$gall=new Galleries([$g1,$g2]);


echo $gall->getGallery(1);
?>
