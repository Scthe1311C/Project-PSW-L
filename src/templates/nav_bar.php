<script>
	/* script to scroll to the nav bar at page load */
	$( document ).ready(function() {
		document.getElementById('navigation-bar').scrollIntoView();
		// having calculated height write it to the property
		var navBar = $('#navigation-bar');
		var navBarH = $(navBar).height();
		$(navBar).css("height", navBarH);
		
		<?php if( $minimal_navbar){?>
			$(navBar).css("position","relative");
		<?php } ?>
		
		// scroll to the top button
		<?php if( !$minimal_navbar){?>
			var image = $('#navigation-bar-image');
			var imageBottom = $(image).offset().top + $(image).height();
			var scrollToTopTarget = imageBottom - navBarH;
		<?php } else {?>
			var scrollToTopTarget = 0;
		<?php } ?>
		$('.back-to-top').click(function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: scrollToTopTarget}, 500);
			return false;
		})
	});

	/* script to fix the nav bar to scroll to the top if the main image is not visible */
	$(window).scroll(function() {
		var image = $('#navigation-bar-image');
		var navBar = $('#navigation-bar');
		var docViewTop = $(window).scrollTop();
		var navBarH = $(navBar).height();
		<?php if( !$minimal_navbar){?>
			var imageBottom = $(image).offset().top + $(image).height();
		<?php }else{ ?>
			var imageBottom = navBarH;
		<?php } ?>
		
		var showBackToTopButton = docViewTop <= imageBottom - navBarH;
		if( !showBackToTopButton){
			$('.back-to-top').fadeIn(500);
			<?php if( !$minimal_navbar){?>
				$(navBar).addClass("navbar-fixed-top");
				$(navBar).css("position","fixed");
			<?php } ?>
		}else{
			$('.back-to-top').fadeOut(500);
			<?php if( !$minimal_navbar){?>
				$(navBar).removeClass("navbar-fixed-top");
				$(navBar).css("position","absolute");
			<?php } ?>
		}
	});
</script>

<?php if( !$minimal_navbar){?>
	<div id="navigation-bar-image">
		<div class="navbar navbar-default align-parent-bottom" role="navigation" id="navigation-bar">
<?php }else{ ?>
	<div class="navbar navbar-default" role="navigation" id="navigation-bar">
<?php } ?>
	
	
		<!-- 
			TODO provide home url
			TODO provide user avatar
		-->
		
		<ul class="nav navbar-nav">
			<a class="navbar-brand" id="brand" href="<?php echo $main_url; ?>">Dropbox App</a>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			
			<!-- Explore -->
			<li class="dropdown">
				<a href="#" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">Explore</a>
				<ul class="dropdown-menu">
					<li class="navigation-bar-dropdown-item"><a href="popular">Popular</a></li>
					<li class="navigation-bar-dropdown-item"><a href="galleries">Galleries</a></li>
				</ul>
			</li>
		
			<!-- Upload -->
			<?php if( $is_logged) { ?>
				<li><a href="upload" class="navigation-bar-item">Upload</a></li>
			<?php } ?>
			
			<!-- Spacer -->
			<li><span id="navigation-bar-spacer">|</span></li>
		
			<!-- Sign In/Up ; user -->
			<?php if( ! $is_logged) { ?>
				<li><a href="login" class="navigation-bar-item">Sign in / Register</a></li>
			<?php } else { ?>
				<!-- user avatar-->
				<li>
				<div style="position:relative;">
					<div id="navigation-bar-avatar"></div>
				</div>
				</li>
				<!-- user pages -->
				<li class="dropdown" id="navigation-bar-user">
					<a href="user-profile" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">
						<?php echo $user_name; ?>
					</a>
					<ul class="dropdown-menu">
						<li class="navigation-bar-dropdown-item"><a href="user-profile?page=friends">Friends</a></li>
						<li class="navigation-bar-dropdown-item"><a href="user-profile?page=galleries">My photos</a></li>
						<li class="navigation-bar-dropdown-item"><a href="user-profile?page=groups">My galleries</a></li>
						<li class="navigation-bar-dropdown-item"><a href="user-profile?page=settings">Settings</a></li>
						<li class="navigation-bar-dropdown-item"><a href="logout">Logout</a></li>
					</ul>
				</li>
			<?php } ?>
		
		</ul>
			
		
		
	</div>

<?php if( !$minimal_navbar){?>
	<!-- background end -->
	</div>
<?php } ?>

<a href="#" class="back-to-top">Back to Top</a>
