<script>
$( document ).ready(function() {
	var tab = 1;
	var h1 = $("#login-section1-form").outerHeight();
	var h2 = $("#login-section2-form").outerHeight();
	var dH = h2-h1;
	h1 = $("#dialog").outerHeight();
	h2 = h1 + dH;
	console.log(h1+" "+h2);
		
	$("#register-tab").click(function(){
	// change to register tab, enlarge dialog
	console.log(h1+" "+h2);
		if(tab==1){
			tab = 2;
			$("#dialog").animate({height: h2+"px"}, 500);
			$("#login-section1-form").fadeOut(500).hide();
			$("#login-section2-form").delay(500).fadeIn( 200);
		}
	});
	
	$("#sign-in-tab").click(function(){
		// change to sign in tab, make dialog smaller
		if(tab==2){
			tab =1;
			console.log(h1+" "+h2);
			$("#dialog").animate({height: h1+"px"}, 500);
			$("#login-section2-form").fadeOut(500).hide();
			$("#login-section1-form").delay(500).fadeIn( 200);
		}
	});
});
</script>

<div id="login-page">

	<div  id="login-dialog">
		
		<div id="login-tabs">
			<ul id="tab">
				<li id="register-tab">Register</a></li>
				<li id="sign-in-tab">Sign In</a></li>
			</ul>
		</div>
		
		<div id="dialog">
			<header>
				<a href="<?php echo $main_url; ?>"><h1>Dropbox App</h1></a>
			</header>
		
			<form class="login-section" id="login-section1-form" formmethod="post" role="form">
				<input type="text" class="form-control" placeholder="Username..">
				<input type="password" class="form-control" placeholder="Password..">
				<div style="position:relative">
					<a href="user-profile"><span class="submit-button">Sign in</span></a>
					<a href="#" id="forgot-password">forgot ?</a>
				</div>
				
				<div style="clear:both"></div>
			</form>
			
			<form class="login-section" id="login-section2-form" formmethod="post" role="form">
				<input type="text" class="form-control" placeholder="Login">
				<input type="text" class="form-control" placeholder="Mail">
				<input type="password" class="form-control" placeholder="Password">
				<input type="password" class="form-control" placeholder="Confirm password">
				<a href="user-profile"><span class="submit-button">Register</span></a>
			</form>
		</div>
	</div>
	
</div>
