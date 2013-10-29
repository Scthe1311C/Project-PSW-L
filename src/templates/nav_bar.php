<div class="navbar navbar-default" role="navigation" id="navigation-bar">
	
		<!-- 
			TODO provide home url
			TODO provide $is_logged, user name, user avater etc.
		-->
		
		<!-- TODO check if this uri is ok for every page -->
		<?php $main_url = ((!empty($_SERVER["HTTPS"])) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
		<?php $is_logged = false; ?>
		<?php $active_user_name = "user1"; ?>
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
						<?php echo $active_user_name; ?>
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


