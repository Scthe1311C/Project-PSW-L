<script>
$( document ).ready(function() {
	var tab =  <?php echo $register?2:1; ?>;
	var form1H = $("#login-section1-form").outerHeight();
	var form2H = $("#login-section2-form").outerHeight();
	var form1ErrorMsgH = $("#invalid-auth-msg").outerHeight();
	if(tab==1) $("#login-section2-form").hide();
	else $("#login-section1-form").hide();
	var dH = form2H-form1H;
	
	<?php if(!$register){ ?>
		var h1 = $("#dialog").outerHeight(); 	// sign in
		var h2 = h1 + dH;						// register
	<?php }else{ ?>
		var h2 = $("#dialog").outerHeight(); 	// register
		var h1 = h2 - dH;						// sign in
	<?php } ?>
	var nH1 = h1 + form1ErrorMsgH + 10; // sign in + error message + padding-bottom of parent
	var nH2 = h2 + form1ErrorMsgH + 10;
	//console.log(form1H+" "+form2H+" !" + $("#invalid-auth-msg").outerHeight());
		
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
			$("#invalid-register").hide();
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
				xhr.setRequestHeader('Method', "login");
			},
			success: function(data){
				var json = $.parseJSON( data );
				if ( json.status === 'ok') {
					window.location = 'user-profile';
				} else {
					// TODO error msg slide down animation
					$("#invalid-auth-msg").hide().slideDown(400);
					$("#dialog").animate({height: nH1+"px"}, 10);
				}
			}
	   });
	 });
	 
	 // submit register
	$('#login-section2-form').submit(function(e) {
		e.preventDefault();
		pass1 = $("#pass1").val();
		pass2 = $("#pass2").val();
		if( pass1==pass2){
			var data_ ={
				"login":$("#login").val(),
				"mail":$("#mail").val() };
				
			$.ajax({
				type: "POST",
				url: 'api.php', // TODO https
				data: data_,
				beforeSend: function (xhr) {
					var creds = username + ':' + password;
					var basicScheme = btoa(creds);
					var hashStr = "Basic "+basicScheme;
					xhr.setRequestHeader('Authorization', hashStr);
					xhr.setRequestHeader('Method', "register");
				},
				success: function(data){
					// https://localhost/webapp/login?register=1
					log(data);
					var json = $.parseJSON( data );
					if ( json.status === 'ok') {
						window.location = 'user-profile';
					} else {
						// TODO error msg slide down animation
						$("#invalid-register").hide().slideDown(400);
						$("#dialog").animate({height: nH2+"px"}, 10);
						
						if( json.cause==='invalidData'){
							log(json.invalidData);
							$("#invalid-register").text("Invalid data");
							
							if( $.inArray("login",json.invalidData)!=-1) $("#login").addClass("error-value");
							else $("#login").removeClass("error-value");
					
							if( $.inArray("mail",json.invalidData)!=-1) $("#mail").addClass("error-value");
							else $("#mail").removeClass("error-value");
							
						}else{
							// already exists
							log("ex");
							$("#invalid-register").text("User already exists");
						}
						
					}
				}
		   });
	   }else{
			// passwords do not match
			log("no match");
			$("#invalid-register").hide().slideDown(400);
			$("#dialog").animate({height: nH2+"px"}, 10);
			$("#invalid-register").text("Passwords do not match");
	   }
	 });
});


function log( text){
	if( typeof(text) != 'string')
		text = JSON.stringify(text);
		text = text.replace(/(\r\n|\n|\r)/gm, "");
	//document.getElementById("pseudo-console").innerHTML += "<br/>"+text;
}
</script>

<!-- TODO check for different browsers -->

<div id="login-page">

	<!--
	<pre id="pseudo-console">
	</pre>
	 -->

	<div id="login-dialog">
		<div id="login-tabs">
			<ul id="tab">
				<li id="register-tab" <?php if(!$register){ ?>class="inactive-tab"<?php } ?>>Register</a></li>
				<li id="sign-in-tab" <?php if($register){ ?>class="inactive-tab"<?php } ?>>Sign In</a></li>
			</ul>
		</div>
		
		<div id="dialog">
			<header>
				<a href="<?php echo $main_url; ?>"><h1>Dropbox App</h1></a>
			</header>
			
			<!-- login form -->
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
			
			<!-- register form -->
			<form class="login-section" id="login-section2-form" formmethod="post" role="form">
				<div class="alert alert-danger" id="invalid-register" style="display:none"></div>
				<input id="login" type="text" class="form-control" placeholder="Login">
				<input id="mail" type="text" class="form-control" placeholder="Mail">
				<input id="pass1" type="password" class="form-control" placeholder="Password">
				<input id="pass2" type="password" class="form-control" placeholder="Confirm password">
				<a href="user-profile">
					<input class="submit-button" action="user-profile" type="submit" name="sign-in-submit" value="Register">
				</a>
				<div style="clear:both"></div>
			</form>
		</div>
	</div>
	
</div>
