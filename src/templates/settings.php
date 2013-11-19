<form enctype="multipart/form-data" method="post">
	<section class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Personal settings</h3>
		</div>
		<div class="panel-body">
			<table>
				<tr>
					<td>Email</td>
					<td><?php echo $userData->loginEmail ?></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><a href="#">change password</a></td>
				</tr>
				
				<tr>
					<td>Name</td>
					<td><input type="text" name="userName" value ="<?php echo $userData->name ?>"></td >
				</tr>
				<tr>
					<td>Surname</td>
					<td><input type="text" name="userSurname" value ="<?php echo $userData->surname ?>"></td >
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<select name="userSex">
							<option value="F" selected="true">Female</option>
							<option value="M">Male</option>
						</select> 
					</td>
				</tr>
				<tr>
					<td>City</td>
					<td>
						<input type="text" name="city" value ="<?php echo $userData->city ?>">
					</td>
				</tr>
				<tr>
					<td>Birth date</td>
					<td>
						<input type="date" name="birthDate" value ="<?php echo date_format($userData->birthDate, 'Y-m-d'); ?>">
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

	<!-- avatar -->
	<section class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Avatar</h3>
		</div>
		<div class="panel-body">
			<img src="<?php echo $userData->avatar ?>" class="img-thumbnail"  alt="No image found"/>
			<input type="file" name="Change"/>
				<input type="submit" class="btn btn-lg btn-primary" value="Save" >
				<input type="reset" class="btn btn-lg btn-primary" value="Cancel">
		</div>
	</section>
</form>
