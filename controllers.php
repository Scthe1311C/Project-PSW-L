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
    include './model/photos.php';
    	
    $gallery = Galleries::getGallery(Galleries::POPULAR_GALLARY_ID);
    $photos = $gallery->allPhotos();
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "photos" => $photos,
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

function gallery($id) {
    include './model/connection.php';
    include './model/gallery.php';
    include './model/photos.php';
    
    
    $gallery = Galleries::getGallery($id);
    $photos = $gallery->allPhotos();
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"),
        "photos" => $photos,
        "gallery" => $gallery,
        "user_name" => "Adam Smith"
    ));
}

function settings($userId) {
    include './model/userData.php';
    
    $user  = Users::getUser($userId);
    
    return render_template('settings.php', array(
        "css_stylesheets" => array("src/css/settings.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "user" => $user
    ));
}

function person_info() {
    include './model/connection.php';
    include './model/userData.php';
    
    $sql = "SELECT * FROM `users` WHERE id = ".$_GET["userId"];
    $resource = mysql_query($sql, $sql_conn);
    $data = mysql_fetch_assoc($resource);
    $person = new User($data);
    return render_template('public-person-view.php', array(
        "css_stylesheets" => array("src/css/settings.css"),
        "person" => $person
    ));
}

function galleries(){
    include './model/connection.php';
    include './model/gallery.php';
    include './model/photos.php';
    include './model/userData.php';
    
    $sql = "SELECT * FROM `galleries` WHERE 1";
    $resource = mysql_query($sql, $sql_conn);
    $galleries = [];
        while($data = mysql_fetch_assoc($resource)){
            $galleries[]=new Gallery($data);
        }
    return render_template("galleries.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css","src/css/galleries.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "galleries" => $galleries,
        "user_name" => "Adam Smith"
    ));   
}

function single_photo($galleryId, $photoId) {
    include './model/gallery.php';
    include './model/photos.php';
    include './model/userData.php';
    include './model/comment.php';
    
    $gallery = Galleries::getGallery($galleryId);
    $photos = $gallery->allPhotos();
    $chosen_photo = $photos[$photoId];
    return render_template("single_photo.php", array(
        "css_stylesheets" => array(
            "src/css/carousel.css",
            "src/css/photo_style.css",
        ),
        "js_scripts" => array(
            "vendor/bootstrap/js/bootstrap.min.js",
            "vendor/bootstrap/js/holder.js",
	    "src/js/commentFold.js"
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
