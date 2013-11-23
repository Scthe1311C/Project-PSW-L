<script>
$( document ).ready(function() {
	var tab = 1;
	var h1 = $("#login-section1-form").outerHeight();
	var h2 = $("#login-section2-form").outerHeight();
	var dH = h2-h1;
	h1 = $("#dialog").outerHeight(); 	// sign in
	h2 = h1 + dH;						// register
	var nH = h1 + $("#invalid-auth-msg").outerHeight() + 10; // sign in + error message + padding-bottom of parent
	//console.log(h1+" "+h2);
		
	$("#register-tab").click(function(){
		// change to register tab, enlarge the dialog
		if(tab==1){
			tab = 2;
			$("#invalid-auth-msg").hide();
			$("#dialog").animate({height: h2+"px"}, 500);
			$("#login-section1-form").fadeOut(500).hide();
			$("#login-section2-form").delay(500).fadeIn( 200);
			$("#register-tab").removeClass("inactive-tab");
			$("#sign-in-tab").addClass("inactive-tab");
		}
	});
	
	$("#sign-in-tab").click(function(){
		// change to sign in tab, make the dialog smaller
		if(tab==2){
			tab =1;
			$("#dialog").animate({height: h1+"px"}, 500);
			$("#login-section2-form").fadeOut(500).hide();
			$("#login-section1-form").delay(500).fadeIn( 200);
			$("#sign-in-tab").removeClass("inactive-tab");
			$("#register-tab").addClass("inactive-tab");
		}
	});
	
	// submit sign in
	$('#login-section1-form').submit(function(e) {
		e.preventDefault();
		username = $("#username").val();
		password = $("#password").val();
		$.ajax({
			type: "POST",
			url: 'api.php', // TODO https
			data: $(this).serialize(),
			beforeSend: function (xhr) {
				var creds = username + ':' + password;
				var basicScheme = btoa(creds);
				var hashStr = "Basic "+basicScheme;
				xhr.setRequestHeader('Authorization', hashStr);
				xhr.setRequestHeader('Method', "login"); // TODO handle by uri not header
			},
			success: function(data){
				if (data === 'true') {
					window.location = 'user-profile';
				} else {
					// TODO error msg slide down animation
					$("#invalid-auth-msg").hide().slideDown(400);
					$("#dialog").animate({height: nH+"px"}, 10);
				}
			}
	   });
	 });
	 
});
</script>

<!-- TODO check for different browsers -->
<div id="login-page">

	<div  id="login-dialog">
		
		<div id="login-tabs">
			<ul id="tab">
				<li id="register-tab" class="inactive-tab">Register</a></li>
				<li id="sign-in-tab">Sign In</a></li>
			</ul>
		</div>
		
		<div id="dialog">
			<header>
				<a href="<?php echo $main_url; ?>"><h1>Dropbox App</h1></a>
			</header>
			
			<form class="login-section" id="login-section1-form" formmethod="post" role="form">
				<div class="alert alert-danger" id="invalid-auth-msg">Please enter a correct username and password.</div>
				<input id="username" type="text" class="form-control" placeholder="Username..">
				<input id="password" type="password" class="form-control" placeholder="Password..">
				<div style="position:relative">
					<input class="submit-button" action="user-profile" type="submit" name="sign-in-submit" value="Sign in">
					<a href="#" id="forgot-password">forgot ?</a> <!-- TODO  forgot button -->
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
