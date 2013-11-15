<?php

function home() {
    return render_template("home.php");
}

function login() {
    return render_template("login.php", array(
        "css_stylesheets" => array("src/css/login.css"),
        "fullscreen" => true,
        "title" => "login"
    ));
}

function about() {
    return render_template("about.php", array(
        "css_stylesheets" => array("src/css/about.css"),
        "title" => "AAa"
    ));
}

function popular() {
    include './model/gallery.php';
    $gallery = Galleries::getInstance()->getGallery(3);
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "gallery" => $gallery,
        "user_name" => "Adam Smith"
    ));
}

function user() {
    return render_template("user-view.php", array(
        "css_stylesheets" => array("src/css/user-view.css"),
        "title" => "User",
        "user_name" => "Adam Smith"
    ));
}

function gallery($id){
    include './model/gallery.php';
    $gallery = Galleries::getInstance()->getGallery($id);
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"),
        "gallery" => $gallery,
        "user_name" => "Adam Smith"
    ));
}

function settings() {
    //static data input
    include './model/userData.php';
    $userData =  $personData = Users::getInstance()->getUser(1);
    return render_template('settings.php', array(
        "css_stylesheets" => array("src/css/settings.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "userData" => $userData
    ));
}

function person_info() {
    //static data input
    include './model/userData.php';
    $person = Users::getInstance()->getUser(2);
    return render_template('public-person-view.php', array(
        "css_stylesheets" => array("src/css/settings.css"),
        "person" => $person
    ));
}
function galleries(){
    include './model/gallery.php';
    $galleryIndex = [1,2,3];   
    return render_template("galleries.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css","src/css/galleries.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "galleryIndex" => $galleryIndex,
        "user_name" => "Adam Smith"
    ));
    
}
function single_photo($galleryId, $chosen_photo) {
    include './model/gallery.php';
    $gallery = Galleries::getInstance()->getGallery($galleryId);
    $photos = $gallery->photos;
    return render_template("single_photo.php", array(
        "css_stylesheets" => array(
            "src/css/carousel.css",
            "src/css/photo_style.css",
        ),
        "js_scripts" => array(
            "src/js/bootstrap.min.js",
            "src/js/holder.js"       
         ),
            "photos" => $photos,
            "chosen_photo" =>$chosen_photo,
            "galleryId" => $galleryId
    ));
}

function render_template($path, array $args = NULL) {
    if ($args === NULL || !in_array('title', $args)) {
        $args["title"] = "app";
    }
    extract($args);
    $content = $path;
    ob_start();
    //require "src/templates/" . $path;
    require "src/templates/app-layout.php";
    $html = ob_get_clean();
    return $html;
}

?>