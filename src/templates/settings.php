<script>
$(function() {
	$('input[type=file]').each(function(){
		var $this = $(this);
		var labeltext = $(this).attr('title');

		var $fileContainer = $('<div class="file-container" />');

		var $text_file = $('<input type="text" class="input-text" value="..." />');
		var $uploadbutton = $('<input class="input-browse" type="button" value="'+labeltext+'" />');

		$this.wrap($fileContainer);			
		$this.parents('.file-container').append($text_file).append($uploadbutton);	
		$this.bind('click', function() {
			$this.parent().find('.input-text').val($this.val());
		});
	});
})
</script>

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
							<span><?php echo $userData->loginEmail ?></span>
						</td>
					</tr>
					<tr>
						<td class="settings-label">Password</td>
						<td class="settings-value form-read-only">
							<span><a href="#">change password</a></span>
						</td>
					</tr>
					
					<tr>
						<td class="settings-label">Name</td>
						<td class="settings-value">
							<input type="text" class="form-control" name="userName" value ="<?php echo $userData->name ?>">
						</td>
					</tr>
					<tr>
						<td class="settings-label">Surname</td>
						<td class="settings-value">
							<input type="text"class="form-control" name="userSurname" value ="<?php echo $userData->surname ?>">
						</td >
					</tr>
					<tr>
						<td class="settings-label">Gender</td>
						<td class="settings-value">
							<select name="userSex" class="form-control">
								<option value="F" selected="true">Female</option>
								<option value="M">Male</option>
							</select> 
						</td>
					</tr>
					<tr>
						<td class="settings-label">City</td>
						<td class="settings-value">
							<input type="text" class="form-control" name="city" value ="<?php echo $userData->city ?>">
						</td>
					</tr>
					<tr>
						<td class="settings-label">Birth date</td>
						<td class="settings-value">
							<input type="date" class="form-control" name="birthDate" value ="<?php echo date_format($userData->birthDate, 'Y-m-d'); ?>">
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
				<a style="width: 100%" id="browse" class="btn btn-large btn-primary" href="">Connect Dropbox account</a>
			</div>
		</section>
	</div>

	<!-- avatar -->
	<div class="column50">
		<section class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Avatar</h3>
			</div>
			<img src="<?php echo $userData->avatar ?>" id="avatar-image"  alt="No image found"/>
			<input type="file" value="" title="Browse" />
		</section>
	</div>
	
	<div style="clear:both"></div>
	<!-- save button -->
	<input type="submit" id="save-button" class="btn btn-default" value="Save" >
</form>
