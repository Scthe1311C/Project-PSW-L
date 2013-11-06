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


/*
function register(){
    return render_template( 'app_layout.php',
    array(
		"content" => "register.php"
	));
}
*/
function settings(){
   //static data input
   include './class/userData.php';
   $userData =  new UserData("adam.smith@gmail.com", "asm123!", "adam.smith@gmail.com", "Adam","Smith", "M", "New York", new DateTime('1992-10-07'), "src/img/img1.jpg");
   return render_template( 'settings.php',array(
	"css_stylesheets" => array("src/css/settings.css"), // TODO !!! WHY AM I PROVIDING *.CSS INSIDE CONTORLLER ?
        "userData" => $userData
	));      
}

function person_info(){
 //static data input
       include './class/userData.php';
    $personData =  new UserData("adam.smith@gmail.com", "asm123!", "adam.smith@gmail.com", "Adam","Smith", "M", "New York", new DateTime('1992-10-07'), "src/img/img2.jpg");
     return render_template( 'public-person-view.php',array(
		"css_stylesheets" => array("src/css/settings.css"),
        "personData" => $personData
	)); 
}

function single_photo(){
	$photos = ["src/img/img1.jpg","src/img/img2.jpg","src/img/img3.jpg","src/img/img4.jpg","src/img/img5.jpg","src/img/img6.jpg","src/img/img7.jpg", "src/img/img8.jpg"];
	return render_template( "single_photo.php", array(
        "css_stylesheets" => array(
			"src/css/carousel.css",
			"src/css/photo_style.css"
			),
		"photos" => $photos
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