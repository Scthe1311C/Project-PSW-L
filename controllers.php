<?php 

function home(){
	return render_template( "home.php");
}

function login(){
	return render_template( "login.php");
}

function popular(){
	return render_template( "gallery-view.php");
}

function render_template( $path, array $args = NULL){
	if ( $args === NULL || !in_array('title', $args)){
		$args["title"] = "app";
	}
    extract($args);
    ob_start();
    require "src/templates/" . $path;
    $html = ob_get_clean();
    return $html;
}

?>