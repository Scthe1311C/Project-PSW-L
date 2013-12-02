<?php
$minimal_navbar = isset($minimal_navbar) && $minimal_navbar;
if( !isset( $user_avatar) ) $user_avatar = "src/img/user-icon.jpg";
//$is_logged=true;
?>


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
		var elem = $('#navigation-bar-image');
		var elemBottom = $(elem).offset().top + $(elem).height();
		var scrollToTopTarget = elemBottom - navBarH;
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
		var elem = $('#navigation-bar-image');
		var navBar = $('#navigation-bar');
		var docViewTop = $(window).scrollTop();
		var elemBottom = $(elem).offset().top + $(elem).height();
		var navBarH = $(navBar).height();
		var isTopImageVisible = docViewTop < elemBottom - navBarH;
		if( !isTopImageVisible && !$(navBar).hasClass("navbar-fixed-top")){
			$('.back-to-top').fadeIn(500);
			
			<?php if( !$minimal_navbar){?>
				$(navBar).addClass("navbar-fixed-top");
				$(navBar).css("position","fixed");
			<?php } ?>
		}else if( isTopImageVisible && $(navBar).hasClass("navbar-fixed-top")){
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
		<!-- TODO check if this uri is ok for every page -->
		
		<ul class="nav navbar-nav">
			<a class="navbar-brand" id="brand" href="<?php echo $main_url; ?>">Dropbox App</a>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			
			<!-- Explore -->
			<li class="dropdown">
				<a href="#" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">Explore</a>
				<ul class="dropdown-menu">
					<li><a href="#" class="navigation-bar-dropdown-item">Galleries</a></li>
					<li><a href="#" class="navigation-bar-dropdown-item">Popular</a></li>
				</ul>
			</li>
		
			<!-- Upload -->
			<?php if( $is_logged) { ?>
				<li><a href="#" class="navigation-bar-item">Upload</a></li>
			<?php } ?>
			
			<!-- About -->
			<li><a href="#" class="navigation-bar-item">About</a></li>
		
			<!-- Spacer -->
			<li><span id="navigation-bar-spacer">|</span></li>
		
			<!-- Sign In/Up ; user -->
			<?php if( ! $is_logged) { ?>
				<li><a href="#" class="navigation-bar-item">Sign Up</a></li>
				<li><a href="#" class="navigation-bar-item">Sign in</a></li>
			<?php } else { ?>
				<!-- user avatar-->
				<li>
				<div style="position:relative;">
					<div id="navigation-bar-avatar"></div>
				</div>
				</li>
				<!-- user pages -->
				<li class="dropdown" id="navigation-bar-user">
					<a href="#" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">
						<?php echo $user_name; ?>
					</a>
					<ul class="dropdown-menu">
						<li><a href="settings" class="navigation-bar-dropdown-item">Settings</a></li>
						<li><a href="#" class="navigation-bar-dropdown-item">My photos</a></li>
						<li><a href="#" class="navigation-bar-dropdown-item">My galleries</a></li>
												<li><a href="index.php" class="navigation-bar-dropdown-item">TODO</a></li>
					</ul>
				</li>
			<?php } ?>
		
		
		
		
			<!-- 
			<input class="navbar-search" id="navigation-bar-search" type="text"> </input>
			<div class="navigation-bar-search-icon">
				<input type="submit" name="" value="">
			</div>
			 -->
		
		</ul>
			
		
		
	</div>

<?php if( !$minimal_navbar){?>
	<!-- background end -->
	</div>
<?php } ?>

<a href="#" class="back-to-top">Back to Top</a>
