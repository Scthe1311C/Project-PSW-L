<?php
include './model/databaseManager.php';

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
	$gallery = getObjectById("Gallery", POPULAR_GALLARY_ID);		
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
	$userData =  getObjectById("User", 1);
	return render_template("user-view.php", array(
        "css_stylesheets" => array("src/css/user-view.css","src/css/settings.css"),
        "title" => "User",
		"page" => $page,
        "user_name" => "Adam Smith",
		"userData" => $userData
    ));
}

function gallery($id) {
	$gallery = getObjectById("Gallery", $id);
	$photos = $gallery->allPhotos();
	return render_template("gallery-view.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css"),
		"photos" => $photos,
		"gallery" => $gallery,
		"user_name" => "Adam Smith"
	));
}


//function settings($userId) {
//	
//	$user  = getObjectById("User", $userId);
//	
//	return render_template('settings.php', array(
//		"css_stylesheets" => array("src/css/settings.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
//		"user" => $user
//	));
//}

function person_info($userId) {
	
	$person = getObjectById("User", $userId);
	
	return render_template('public-person-view.php', array(
		"css_stylesheets" => array("src/css/settings.css"),
		"person" => $person
	));
}

function galleries(){	
	$galleries = getAllObjects("Gallery");
	return render_template("galleries.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css","src/css/galleries.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
		"galleries" => $galleries,
		"user_name" => "Adam Smith"
	));   
}

function single_photo($galleryId, $photoId) {	
	$gallery = getObjectById("Gallery", $galleryId);
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

function upload(){
	//check_user_authorization_or_go_to_login_page();
	return render_template("upload.php", array(
        "css_stylesheets" => array("src/css/upload.css"),
        "title" => "Upload",
		"content_width100" => true
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
