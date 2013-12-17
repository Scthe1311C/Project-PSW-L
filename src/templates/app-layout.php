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
		
		<script src="vendor/jquery-min.js"></script>
		<?php if( isset($js_scripts) ){
			foreach( $js_scripts as $script){?>
				<script src="<?php echo $script; ?>"></script>
		<?php }} ?>
	</head>
	
	<?php
		// read auxiliary variables
		$is_logged = isset($_SESSION["user"]) && $_SESSION["user"] != NULL;
		if(!isset($user_name)) $user_name = "Adam Smith";
		$is_fullscreeen = isset($fullscreen) && $fullscreen; //remove navbar
		$minimal_navbar = isset($minimal_navbar) && $minimal_navbar;  // do not display the big image on top
		$content_width100 = isset($content_width100) && $content_width100;  // span whole page from edge to edge
		$hide_back_to_top = isset($hide_back_to_top) && $hide_back_to_top;  // do not show the 'back to the top' button
	?>
		
	<body id="page-main">
		
		<?php if( !$is_fullscreeen) {
			include 'nav_bar.php';
			/*include 'breadcrumbs.php';*/?>
			
			<div class="container" <?php if($content_width100) echo 'style="width:100% !important; max-width: 100% !important; padding:0 !important"'; ?>>
				<?php include $content; ?>
			</div>
			<?php include 'footer.php'; ?>
		<?php } else{
			include $content;
		}?>
		
	</body>
</html>
