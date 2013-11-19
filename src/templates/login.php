<script>
$( document ).ready(function() {
	$("#login-section2-title").click(function(){
		//console.log("aa");
		$("#login-section1-form").slideUp(function(){
			$("#login-section2-form").slideDown();
		});
	});
	
	$("#login-section1-title").click(function(){
		$("#login-section2-form").slideUp(function(){
			$("#login-section1-form").slideDown();
		});
	});
});
</script>

<!-- 
TODO tabs on the side ?
 -->

<div id="login-page">

	<div class="dialog" id="login-dialog">
		<header>
			<a href="<?php echo $main_url; ?>"><h1>Dropbox App</h1></a>
		</header>
		 
		<h2 id="login-section1-title">Sign In</h2>
		<form class="login-section" id="login-section1-form" formmethod="post" role="form">
			<input type="text" class="form-control" placeholder="Username..">
			<input type="password" class="form-control" placeholder="Password..">
			<div style="position:relative">
				<a href="user-profile"><span class="submit-button">Sign in</span></a>
				<a href="#" id="forgot-password">forgot ?</a>
			</div>
			
			<div style="clear:both"></div>
		</form>
		
		<h2 id="login-section2-title">Register</h2>
		<form class="login-section" id="login-section2-form" formmethod="post" role="form">
			<input type="text" class="form-control" placeholder="Login">
			<input type="text" class="form-control" placeholder="Mail">
			<input type="password" class="form-control" placeholder="Password">
			<input type="password" class="form-control" placeholder="Confirm password">
			<a href="user-profile"><span class="submit-button">Register</span></a>
			<!-- 
				TODO add fields: gender, age segment
			-->
		</form>
	</div>
</div>
