<div id="user-page">
	
	<!-- TODO avatar and name on the navbar ? get rid of them on this page -->
	<!-- TODO fill navbar background image with the last-activity images -->
	<?php 
		$friends_identifier = "friends";
		$photos_identifier = "photos";
		$galleries_identifier = "galleries";
		$groups_identifier = "groups";
		$settings_identifier = "settings";
	?>
	
	<div class="user-header">
		<!-- avatar -->
		<div id="user-avatar"></div>
		<!-- name -->
		<h1><?php echo $user->name." ".$user->surname; ?></h1>
	</div>
	
	<hr/>
	
	<div class="user-body">
		<!-- tabs -->
		<ul class="user-tabs">
			
			<!-- user's main profile page -->
			<li><a href="user-profile">Profile</a></li>
			
			<!-- last photos from friend's galleries -->
			<li><a href="user-profile?page=friends">Friends</a></li>
			
			<!-- all user's photos grouped by galleries -->
			<li><a href="user-profile?page=photos">My photos</a></li>
			
			<!-- all user's photos grouped by galleries -->
			<li><a href="user-profile?page=galleries">My galleries</a></li>
			
			<!-- last photos from followed groups galleries -->
			<li><a href="user-profile?page=groups">My groups</a></li>
			
			<!--
				settings: should allow to change ( in no spec. order):
					* avatar
					* input real name
					* password
					* age group \ both can be used to propose interesting photos to user
					* gender    / also to use mature content filter
					* link dropbox account
					* read only email info !!!
			-->
			<li><a href="user-profile?page=settings">Settings</a></li>
		</ul>
		<div style="clear:both"></div>
		
		
		<!-- page code -->
		<?php if($page === $settings_identifier){?>
			<!-- settings -->
			<?php include "settings.php"; ?>
			
			
		<?php }else if($page === $friends_identifier){ ?>
			fr<br/>
			<!-- friends page -->
			TODO: friends, whatever can be placed here<br/><br/>
			<br/><br/>
			<br/><br/>
			<br/><br/>
		<?php }else if($page === $galleries_identifier){ ?>
			
			<?php include "galleries.php"; ?>
			
		<?php }else if($page === $groups_identifier){ ?>
			gr<br/>
			<!-- groups the user belongs to -->
			TODO: groups the user belongs to<br/><br/>
			<br/><br/>
			<br/><br/>
			<br/><br/>
		<?php }else{ ?>
			<!-- profile page -->
			TODO: last friends activites, last followed activities etc.<br/><br/>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est, at rhoncus elit pellentesque id. Aenean euismod dolor tellus, porttitor facilisis elit tempus quis. Mauris accumsan risus magna, vitae vehicula massa tempor pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in purus nisl. Aliquam hendrerit tortor non felis lobortis egestas. Donec risus diam, consequat vitae varius quis, convallis a nunc. Integer vel dui augue. Ut non sapien pulvinar, commodo risus at, porttitor urna. Duis massa nunc, aliquet in aliquet pulvinar, luctus nec eros. Morbi vel cursus risus. Vestibulum posuere tempus augue non adipiscing.
			<br/><br/>
			<br/><br/>
			<br/><br/>
		<?php } ?>
		
		
		<!-- end of 'page code' -->
		
		</div>
	
	
</div>
