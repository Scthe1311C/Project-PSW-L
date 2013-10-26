<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/gallery-view.css"/>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</head>
	
	<!-- 
		TODO provide variables !
		TODO scale favorite-mark-up icon, make red on hover
	-->
	<?php 
		$is_logged = true;
	?>
	
	<body style="background-color: #222 !important; height:100%">
		<div class="container">
			<?php include 'nav_bar.php' ?>
			
			<?php for( $i = 1; $i < 8; $i++){ ?>
				<!-- single image element -->
				
				<div class="gallery-thumbnail" style="width:250px; height:188px">
					<!-- image info -->
					<div class="image-info views-count">
						<i class="icon-eye-open icon-white"></i><span>&nbsp;2k</span>
					</div>
					<div class="image-info favorite-count">
						<i class="icon-heart icon-white"></i><span>&nbsp;1k</span>
					</div>
					<?php if( $is_logged || true){ ?>
						<!-- quick mark as favorite -->
						<div class="image-info favorite-mark-up">
							<i class="icon-heart icon-white" width="40px" height="40px"></i>
						</div>
					<?php } ?>
					
					<!-- image -->
					<a href="#">
						<img src="src/img/img<?php echo $i; ?>.jpg" class="file"/>
					</a>
				</div>
			<?php } ?>
			
		</div>
	</body>
</html>