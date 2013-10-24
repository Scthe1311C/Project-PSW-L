<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="src/css/style.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
    <body>
        <div id="login-page">
            <!-- main page content -->
            <div class="dialog">
                <header>
                    <h1>
                        Dropbox App
                    </h1>
                </header>
				<div class="dialog-content">
					<form formmethod="post" style="margin-bottom:0px">
						<fieldset>
							<input type="text" placeholder="Username..">
							<input type="password" placeholder="Password..">
							<div id="dialog-buttons">
								<span>Sign in</span>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
        </div>
    </body>
</html>
