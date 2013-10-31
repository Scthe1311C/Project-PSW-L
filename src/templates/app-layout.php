<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/style.css"/>
		<?php if( isset($css_stylesheets) ){
			foreach( $css_stylesheets as $sheet){?>
				<link rel="stylesheet" type="text/css" href="<?php echo $sheet; ?>"/>
		<?php }} ?>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<?php if( isset($js_scripts) ){
			foreach( $js_scripts as $script){?>
				<script src="<?php echo $script; ?>"></script>
		<?php }} ?>
	</head>
	
	<?php
		// read auxiliary variables
		$main_url = ((!empty($_SERVER["HTTPS"])) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$is_logged = isset($user_name);
		$is_fullscreeen = isset($fullscreen) && $fullscreen; //remove navbar
		//$minimal_navbar  //does not display big image behind
	?>
		
	<body id="page-main">
		
		<?php if( !$is_fullscreeen) {
			include 'nav_bar.php';
			include 'breadcrumbs.php';?>
			<div class="container">
		<?php }  ?>
		
		<?php include $content; ?>
			
		<?php if( !$is_fullscreeen){?>
			</div>
			<?php 
			include 'footer.php';
		}
		?>
		
	</body>
</html>