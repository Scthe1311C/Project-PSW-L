<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="src/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/login.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
    <body>
		<!-- 
		TODO: AJAX password check
		TODO: dynamic image change ?
		TODO: image info using actual image info
		-->
	
        <div id="login-page">
            <!-- main page content -->
            <div class="dialog"  id="login-dialog">
                <header>
                    <h1>
                        Dropbox App
                    </h1>
                </header>
				<div class="dialog-content" id="login-dialog-content">
					<form formmethod="post" style="margin-bottom:0px" role="form">
						<input type="text" class="form-control" placeholder="Username..">
						<input type="password" class="form-control" placeholder="Password..">
						<span id="sign-in">Sign in</span>
						<a href="#" id="forgot-password">forgot ?</a>
					</form>
				</div>
			</div>
			
			<div class="login-other-info-panel" id="login-image-info">
					"Some random city" by AAA
			</div>
			<div class="login-other-info-panel" id="login-register">
					<a href="#" id="register">register</a>
			</div>
        </div>
    </body>
</html>
