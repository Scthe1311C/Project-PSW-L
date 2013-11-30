<?php

$app_name = substr( $_SERVER["PHP_SELF"], 0, strrpos( $_SERVER["PHP_SELF"], "/"));
$main_url = ((!empty($_SERVER["HTTPS"])) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"].$app_name;

function check_user_authorization_or_go_to_login_page(){
	if (!isset($_SESSION["user_name"]) )
		header("Location: login");
}

function dropboxAuthorize(){
	global $main_url;
	return dropbox_authorize( $main_url."/dropboxAuthorize"); // TODO https
}

function home() {
    return render_template("home.php", array(
		"css_stylesheets" => array("src/css/home.css"),
		"minimal_navbar" => true,
		"content_width100" => true
	));
}

function login( $register=false) {
    return render_template("login.php", array(
        "css_stylesheets" => array("src/css/login.css"),
        "fullscreen" => true,
		"register" => $register,
        "title" => "Log in"
    ));
}

function about() {
    return render_template("about.php", array(
        "css_stylesheets" => array("src/css/about.css")
    ));
}

function popular() {
    include './model/gallery.php';
    include './model/photos.php';
    $gallery = Galleries::getInstance()->getGallery(3);
    $photos = $gallery->allPhotos();
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "photos" => $photos,
        "gallery" => $gallery,
        "user_name" => "Adam Smith"
    ));
}

function user_profile( $page) {
	//check_user_authorization_or_go_to_login_page();
	
    include './model/userData.php';
	$userData =  $personData = Users::getInstance()->getUser(1);
	return render_template("user-view.php", array(
        "css_stylesheets" => array("src/css/user-view.css","src/css/settings.css"),
        "title" => "User",
		"page" => $page,
        "user_name" => "Adam Smith",
		"userData" => $userData
    ));
}

function gallery() {
    include './model/gallery.php';
    include './model/photos.php';
    $galleryId = $_GET["galleryId"];
    $gallery = Galleries::getInstance()->getGallery($galleryId);
    $photos = $gallery->allPhotos();
    return render_template("gallery-view.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css"),
        "photos" => $photos,
        "gallery" => $gallery,
        "user_name" => "Adam Smith"
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
    $gallery1 = Galleries::getInstance()->getGallery(1);
    $gallery2 = Galleries::getInstance()->getGallery(2);
    $gallery3 = Galleries::getInstance()->getGallery(3);
    $galleries = [$gallery1, $gallery2, $gallery3];
    return render_template("galleries.php", array(
        "css_stylesheets" => array("src/css/gallery-view.css","src/css/galleries.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "galleries" => $galleries,
        "user_name" => "Adam Smith"
    ));   
}

function single_photo() {
    include './model/gallery.php';
    $galleryId = $_GET["galleryId"];
    $gallery = Galleries::getInstance()->getGallery($galleryId);
    $photos = $gallery->photosRef;
    $chosen_photo = $_GET["photo"];
    return render_template("single_photo.php", array(
        "css_stylesheets" => array(
            "src/css/carousel.css",
            "src/css/photo_style.css",
        ),
        "js_scripts" => array(
            "vendor/bootstrap/js/bootstrap.min.js",
            "vendor/bootstrap/js/holder.js"       
         ),
            "photos" => $photos,
            "chosen_photo" =>$chosen_photo,
            "galleryId" => $galleryId
    ));
}

function upload(){
	//check_user_authorization_or_go_to_login_page();
	return render_template("upload.php", array(
        "css_stylesheets" => array("src/css/upload.css"),
        "title" => "Upload"
    ));
}

///
///
///
function render_template($path, array $args = NULL) {
    if ($args === NULL || !isset($args['title'])) {
        $args["title"] = "app";
    }
	$args["session"] = $_SESSION;
	global $app_name, $main_url;
	$args["app_name"] = $app_name;
	$args["main_url"] = $main_url;
	
	extract($args);
    $content = $path;
    ob_start();
    //require "src/templates/" . $path;
    require "src/templates/app-layout.php";
    $html = ob_get_clean();
    return $html;
}

?>
