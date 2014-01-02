<form enctype="multipart/form-data" method="post">
	
	<div class="column50">
		<section class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Personal settings</h3>
			</div>
			<div class="panel-body">
				<table> <!-- TODO table ?! srsly ? -->
					<tr>
						<td class="settings-label">Email</td>
						<td class="settings-value form-read-only">
							<span><?php echo $user->email ?></span>
						</td>
					</tr>
					<tr>
						<td class="settings-label">Password</td>
						<td class="settings-value form-read-only">
							<span><a href="#">change password</a></span><!-- TODO password change -->
						</td>
					</tr>
					
					<tr>
						<td class="settings-label">Name</td>
						<td class="settings-value">
							<input type="text" class="form-control" name="userName" value ="<?php echo $user->name ?>">
						</td>
					</tr>
					<tr>
						<td class="settings-label">Surname</td>
						<td class="settings-value">
							<input type="text"class="form-control" name="userSurname" value ="<?php echo $user->surname ?>">
						</td >
					</tr>
					<tr>
						<td class="settings-label">Gender</td>
						<td class="settings-value">
							<select name="userSex" class="form-control">
								
								<option value="F" <?php if($user->gender == "F") echo 'selected="true"'?>>Female</option>
								<option value="M" <?php if($user->gender == "M") echo 'selected="true"'?>>Male</option>
							</select> 
						</td>
					</tr>
					<tr>
						<td class="settings-label">City</td>
						<td class="settings-value">
							<input type="text" class="form-control" name="city" value ="<?php echo $user->address->city ?>">
						</td>
					</tr>
					<tr>
						<td class="settings-label">Birth date</td>
						<td class="settings-value">
							<input type="date" class="form-control" name="birthDate" value ="<?php echo $user->birth_date; ?>">
						</td> 
					</tr>
				</table>
			</div>
		</section>
		
		
		<!-- dropbox -->
		<section  class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Dropbox account</h3>
			</div>
			<div class="panel-body">
				<?php if( ! $user->hasDropboxAccount() ){ ?>
				<a style="width: 100%" id="browse" class="btn btn-large btn-primary" href="dropboxAuthorize?source=<?php echo urlencode("user-profile?page=settings"); ?>">Connect Dropbox account</a>
				<?php }else{ ?>
				<!-- TODO dropbox account unlink -->
				<a style="width: 100%" id="browse" class="btn btn-large btn-primary" href="dropboxAuthorize?source=<?php echo urlencode("user-profile?page=settings"); ?>">Unlink Dropbox account</a>
				<?php } ?>
			</div>
			<?php 
				//$user->debug();
				//if( isset($_SESSION['oauth2_token']) )
				//	echo "'".$_SESSION['oauth2_token_r']."<>".$_SESSION['oauth2_token_a']."'";
			?>
		</section>
	</div>

	<!-- avatar -->
	<div class="column50">
		<section class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Avatar</h3>
			</div>
			<img src="<?php echo $user->avatar ==NULL? "src/img/default_user_avatar.png" : $user->avatar ?>" id="avatar-image"  alt="No image found"/>
			<input type="file" value="" title="Browse" />
		</section>
	</div>
	
	<div style="clear:both"></div>
	<!-- save button -->
	<input type="submit" id="save-button" class="btn btn-default" value="Save" >
</form>
