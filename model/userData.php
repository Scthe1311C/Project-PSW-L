<?php

class UserData {

    private $id;
    private $loginEmail;
    private $password;
    public $dropboxEmail;
    public $name;
    public $surname;
    public $gender;
    public $city;
    public $birthDate;
    public $avatar;

    function __construct($id, $loginEmail, $password, $dropboxEmail, $name, $surname, $gender, $city, $birthDate, $avatar) {
        $this->id = $id;
        $this->loginEmail = $loginEmail;
        $this->password = $password;
        $this->dropboxEmail = $dropboxEmail;
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->city = $city;
        $this->birthDate = $birthDate;
        if ($avatar == NULL)
            $this->avatar = "src/img/default_user_avatar.png";
        else
            $this->avatar = $avatar;
    }

    public function __get($name) {
        switch ($name) {
            case "id": return $this->id; break;
            case "loginEmail": return $this->loginEmail; break;
            case "password": return $this->password; break;
            default: throw new InvalidArgumentException('Invalid property: ' . $name);
        }
    }

    public function __set($name, $value) {
        switch ($name) {
            case "password": $this->password = $value; break;
            default: throw new InvalidArgumentException('Invalid property: ' . $name);
        }
    }
}

// Singleton class
class Users {

    private static $instance;
    private function __clone() { } //not provide to make kopy of object

    private function __construct() {
        $this->users = [];
        $u1 = new UserData(1, "adam.smith@gmail.com", "asm123!", "adam.smith@gmail.com", "Adam", "Smith", "M", "New York", new DateTime('1992-10-07'), "src/img/img2.jpg");
        $u2 = new UserData(2, "will.turnner@gmail.com", "wil123!", "will.turnner@gmail.com", "Will", "Turrner", "M", "New York", new DateTime('1991-10-07'), "src/img/img1.jpg");
        $userTab = [$u1, $u2];
        foreach ($userTab as $user) {
            $this->addUser($user);
        }
    }

    public static function getInstance() {
        return (self::$instance === null) ? self::$instance = new \Users() : self::$instance;
    }

    public function addUser($user) {
        $this->users[$user->id] = $user;
    }

    public function getUser($id) {
        return $this->users[$id];
    }
}
?>



