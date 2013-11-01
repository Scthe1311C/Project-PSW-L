<?php 

function home(){
	return render_template( "home.php");
}

function login(){
	return render_template( "login.php", array(
		"css_stylesheets" => array("src/css/login.css"),
		"fullscreen" => true,
		"title" => "login"
	));
}

function about(){
	return render_template( "about.php", array(
		"css_stylesheets" => array("src/css/about.css"),
		"title" => "AAa"
	));
}

function popular(){
	return render_template( "gallery-view.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
		//"user_name" => NULL
		"user_name" => "Adam Smith"
	));
}

function user(){
	return render_template( "user-view.php", array(
		"css_stylesheets" => array("src/css/user-view.css"),
		"title" => "User",
		"user_name" => "Adam Smith"
	));
}

function render_template( $path, array $args = NULL){
	if ( $args === NULL || !in_array('title', $args)){
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