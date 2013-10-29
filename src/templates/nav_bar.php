<?php $minimal_navbar = isset($minimal_navbar) && $minimal_navbar;?>

<script>
$( document ).ready(function() {
	document.getElementById('navigation-bar').scrollIntoView();
	// having calculated height write it to the property
	var navBar = $('#navigation-bar');
	var navBarH = $(navBar).height();
	$(navBar).css("height", navBarH);
	
	<?php if( $minimal_navbar){?>
			//$(navBar).addClass("navbar-fixed-top");
			$(navBar).css("position","relative");
	<?php } ?>
});

/*
function isScrolledIntoView(elem){
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
*/

<?php if( $minimal_navbar){?>
$(window).scroll(function() {
	var elem = $('#navigation-bar-image');
	var navBar = $('#navigation-bar');
	var docViewTop = $(window).scrollTop();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
	var navBarH = $(navBar).height();
	var isTopImageVisible = docViewTop < elemBottom - navBarH;
	//console.log( "page: "+docViewTop+" ; image: "+elemBottom+"   -> visible: "+ (docViewTop<elemBottom));
	if( !isTopImageVisible && !$(navBar).hasClass("navbar-fixed-top")){
		$(navBar).addClass("navbar-fixed-top");
		$(navBar).css("position","fixed");
    }else if( isTopImageVisible && $(navBar).hasClass("navbar-fixed-top")){
		$(navBar).removeClass("navbar-fixed-top");
		$(navBar).css("position","absolute");
	}
});
<?php } ?>
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
		<?php if( !isset( $user_avatar) ) $user_avatar = "src/img/user-icon.jpg"; ?>
		
		
			<ul class="nav navbar-nav">
				<a class="navbar-brand" id="brand" href="<?php echo $main_url; ?>">Dropbox App</a>
				<?php if( !$is_logged) { ?>
					<li><a href="#" class="navigation-bar-item">Sign Up</a></li>
				<?php } ?>
				<li class="dropdown">
					<a href="#" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">Explore</a>
					<ul class="dropdown-menu">
						<li><a href="#" class="navigation-bar-dropdown-item">Galleries</a></li>
						<li><a href="#" class="navigation-bar-dropdown-item">Popular</a></li>
					</ul>
				</li>
				<?php if( $is_logged) { ?>
					<li><a href="#" class="navigation-bar-item">Upload</a></li>
				<?php } ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<!-- 
				<input class="navbar-search" id="navigation-bar-search" type="text"> </input>
				<div class="navigation-bar-search-icon">
					<input type="submit" name="" value="">
				</div>
				 -->
				<li><a href="#" class="navigation-bar-item">About</a></li>
				<?php if( ! $is_logged) { ?>
				<li><a href="#" class="navigation-bar-item">Sign in</a></li>
				<?php } else { ?>
					<li class="dropdown">
						<a href="#" class="navigation-bar-item dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo $user_avatar; ?>" width="20" height="20"/>
							<?php echo $user_name; ?>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#" class="navigation-bar-dropdown-item">Settings</a></li>
							<li><a href="#" class="navigation-bar-dropdown-item">My photos</a></li>
							<li><a href="#" class="navigation-bar-dropdown-item">My galleries</a></li>
						</ul>
					</li>
				<?php } ?>
			</ul>
			
		
		
	</div>

<?php if( !$minimal_navbar){?>
	<!-- background end -->
	</div>
<?php } ?>
