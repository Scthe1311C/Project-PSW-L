<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/style.css"/>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</head>
	
	<body style="background:url('src/img/img1.jpg') no-repeat center center fixed !important; height:100%">
		<div class="container">
			<?php include 'nav_bar.php' ?>
			
			<div class="dialog-content" style="margin-top:10px;">
				<table style="margin:10px auto">
					<tr>
						<td style="text-align: center; width:150px">D:</td>
						<td style="text-align: center; width:150px">M:</td>
					</tr>
					<tr>
						<td style="vertical-align:top">
							<li><a href="register">Register</a></li>
							<li><a href="settings">Settings</a></li>
							<li><a href="galleries">Galleries</a></li>
							<li><a href="photo">Photo</a></li>
						</td>
						<td>
							<li><a href="login">Login</a></li>
							<li><a href="about">About</a></li>
							<li><a href="popular">Popular</a></li>
							<li><a href="upload">Upload</a></li>
							<li><a href="profile_photos">Profile photos</a></li>
							<li><a href="profile_galleries">Profile galleries</a></li>
						</td>
					</tr>
				
				</table>
			<div>
		</div>
	</body>
</html>