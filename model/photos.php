<?php

class Photo {
    private $href;
    public $data;

    function __construct($href, $data) {
        $this->data = $data;
        $this->href = $href;
    }

    public function __get($name) {
        switch ($name) {
            case "href": return $this->href;
                break;
            default: throw new InvalidArgumentException('Invalid property: ' . $name);
        }
    }

}

// Singleton class
class Photos {

    private static $instance;
    private $photos;

    private function __clone() {
        
    }

//not provide to make copy of object

    private static $defaultPhotoData = ["Resolution" => "1600x1050",
        "Camera" => "Canon EOS 5D Mark II",
        "Software" => "Adobe Photoshop CS5",
        "Date" => "2012-11-26 16:04:45",
        "Exposure time" => "1/200 sec",
        "F number" => "F2.8"];

    private function __construct() {
        $this->photos = [];
        $f1 = new Photo("src/img/img1.jpg", self::$defaultPhotoData);
        $f2 = new Photo("src/img/img2.jpg", self::$defaultPhotoData);
        $f3 = new Photo("src/img/img3.jpg", self::$defaultPhotoData);
        $f4 = new Photo("src/img/img4.jpg", self::$defaultPhotoData);
        $f5 = new Photo("src/img/img5.jpg", self::$defaultPhotoData);
        $f6 = new Photo("src/img/img6.jpg", self::$defaultPhotoData);
        $f7 = new Photo("src/img/img7.jpg", self::$defaultPhotoData);
        $f8 = new Photo("src/img/img8.jpg", self::$defaultPhotoData);
        $photoTab = [$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8];
        foreach ($photoTab as $photo) {
            $this->addPhoto($photo);
        }
    }

    public static function getInstance() {
        return (self::$instance === null) ? self::$instance = new Photos() : self::$instance;
    }

    public function addPhoto($photo) {
        $this->photos[$photo->href] = $photo;
    }

    public function getPhoto($href) {
        return $this->photos[$href];
    }

    public function allPhotos() {
        return $this->photos;
    }

}

?>
