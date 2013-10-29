<?php 

function home(){
	return render_template( "home.php");
}

function login(){
	return render_template( "login.php", array(
		"css_stylesheets" => array("src/css/login.css"),
		"fullscreen" => true
	));
}

function about(){
	return render_template( "about.php");
}

function popular(){
	return render_template( "gallery-view.php", array(
		"css_stylesheets" => array("src/css/gallery-view.css"),
		//"user_name" => NULL
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