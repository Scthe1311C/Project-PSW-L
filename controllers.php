<?php

$app_name = substr( $_SERVER["PHP_SELF"], 0, strrpos( $_SERVER["PHP_SELF"], "/"));
$main_url = ((!empty($_SERVER["HTTPS"])) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"].$app_name;

function check_user_authorization_or_go_to_login_page(){
	$user = getActiveUser();
	if( $user == NULL)
		header("Location: login");
	return $user;
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
	// TODO what if user gets here ?
	return render_template("login.php", array(
		"css_stylesheets" => array("src/css/login.css"),
		"fullscreen" => true,
		"register" => $register,
		"title" => "Log in"
	));
}

function logout(){
	userLogout();
}

function about() {
	return render_template("about.php", array(
		"css_stylesheets" => array("src/css/about.css")
	));
}

function popular() {
	$gallery = getPopularGallery();
	$photos = $gallery->allPhotos();
	return render_template("gallery-view.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
		"photos" => $photos,
		"gallery" => $gallery,
	));
}

function user_profile( $page, $userId) {
	check_user_authorization_or_go_to_login_page();

	$userData = getUser( $userId);
	$userGalleries = getGalleriesByUser($userId);
	return render_template("user-view.php", array(
		"css_stylesheets" => array("src/css/user-view.css","src/css/settings.css","src/css/galleries.css"),
		"js_scripts" => array("src/js/settings.js"),
		"title" => "User",
		"page" => $page,
		"galleries" =>$userGalleries,
		"user" => $userData
	));
}

function gallery($id) {
	$gallery = getGalleryById( $id);
	$photos = $gallery->allPhotos();
	return render_template("gallery-view.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css","src/css/galleries.css"),
		"photos" => $photos,
		"gallery" => $gallery,
	));
}

function person_info($userId) {
	$person = getUser( $userId);
	return render_template('public-person-view.php', array(
		"css_stylesheets" => array("src/css/settings.css"),
		"person" => $person
	));
}

function galleries(){
	$galleries = getAllGalleries();
	return render_template("galleries.php", array(
		"css_stylesheets" => array("src/css/galleries.css"),
		"galleries" => $galleries,
	));
}

function single_photo($galleryId, $photoId) {	
	$gallery = getGalleryById( $galleryId);
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
	check_user_authorization_or_go_to_login_page();
	$userGalleries = getGalleriesByUser( getActiveUserId());
	return render_template("upload.php", array(
		"css_stylesheets" => array("src/css/upload.css"),
		"js_scripts" => array(
			"src/js/upload.js"
		 ),
		"title" => "Upload",
		"content_width100" => true,
		"user_galleries" => $userGalleries
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
	$__user__ = getActiveUser();
	if( isset($__user__) && $__user__ != NULL)
		$args["user"] = $__user__;
	
	extract($args);
	$content = $path;
	ob_start();
	//require "src/templates/" . $path;
	require "src/templates/app-layout.php";
	$html = ob_get_clean();
	return $html;
}

?>
