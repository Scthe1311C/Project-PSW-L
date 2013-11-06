<?php
 class UserData{
     private $loginEmail;
     private $password;
     private $dropboxEmail;
     private $name;
     private $surname;
     private $gender;
     private $city;
     private $birthDate;
     private $avatar;
     function __construct($loginEmail, $password,$dropboxEmail, $name,$surname, $gender, $city, $birthDate, $avatar) {
         $this->loginEmail = $loginEmail;
         $this->password = $password;
         $this->dropboxEmail =$dropboxEmail;
         $this->name = $name;
         $this->surname = $surname;
         $this->gender = $gender;
         $this->city = $city;
         $this->birthDate = $birthDate;
         if($avatar == NULL)
             $this->avatar = "src/img/default_user_avatar.png";
         else
         $this->avatar = $avatar;
     }

     public function getPersonalData(){
         return [
                    "loginEmail" =>  $this->loginEmail,
                    "dropboxEmail" => $this->dropboxEmail,
                    "name" => $this->name,
                    "surname" => $this->surname,
                    "gender" => $this->gender,
                    "city" => $this->city,
                    "birthDate" => $this->birthDate,
                    "avatar" => $this->avatar
                ];
     }
 }
?>

