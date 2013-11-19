<!-- 
<table style="margin:50px auto 10px">
	<tr>
		<td style="text-align: center; width:150px">D:</td>
		<td style="text-align: center; width:150px">M:</td>
	</tr>
	<tr>
		<td style="vertical-align:top">
			<li><a href="register" style="text-decoration: line-through;">Register</a>( in login)</li>
			<li><a href="settings">_Settings</a></li>
			<li><a href="galleries">Galleries</a></li>
			<li><a href="photo?galleryId=3&photo=src/img/img2.jpg">Photo</a></li>
			<li><a href="user-profile">User page ( NEW)</a></li>
			<li><a href="user">Public profile</a></li>
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
-->

<script>
/* script to scroll to the nav bar at page load */
$( document ).ready(function() {
	// having calculated height write it to the property
	var navBar = $('#navigation-bar');
	$(navBar).addClass("navbar-fixed-top");
	$(navBar).css("position","fixed");
});
</script>

<div id="home-page">
	
	<div id="body-posters">
		<section id="section-1">
			<h1 class="text-center-horizontal">Share</h1>
			<h2 class="text-center-horizontal">so every one can enjoy Your photos</h2>
			<p class="text-center-horizontal"><a href="#" id="sign-up-button" class="btn">Sign up</a></p>
			<br/>
			<p class="text-center-horizontal section-link"><a href="#Easy">Easy</a> quick</p>
			<p class="text-center-horizontal section-link"><a href="#Impressive">Impressive</a> big spectacular</p>
			<p class="text-center-horizontal section-link"><a href="#Mobile">Mobile</a> anywhere</p>
			<p class="text-center-horizontal section-link" style="margin-top:30px"><a href="login">Sign In</a></p>
		</section>
		
		<a id="Easy" /></a>
		<section id="section-2">
			<h1 class="text-left-horizontal">Easy</h1>
			<p class="text-left-horizontal">Connect Your account with dropbox to share with just a few clicks</p>
		</section>
		
		<a id="Impressive" /></a>
		<section id="section-3">
			<h1 class="text-left-horizontal">Impressive</h1>
			<p class="text-left-horizontal">Fullscreen</p>
		</section>
		
		<a id="Mobile" /></a>
		<section id="section-4">
			<h1 class="text-left-horizontal">Mobile</h1>
			<p class="text-left-horizontal">Share on the go directly from Your phone</p>
		</section>
	</div>
	<!-- 
	TODO some images on the bottom ?
	<div id="body-images">
	</div>
	 -->
</div>




