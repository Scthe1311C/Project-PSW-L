<script>

var base_uri = "api.php";

$('document').ready(function(){
	$("#save-button").click(function( e){
		var data_ ={
			"name":$("[name=\"userName\"]").val(),
			"lastName":$("[name=\"userLastName\"]").val(),
			"gender":$("[name=\"gender\"]").val(),
			"city":$("[name=\"city\"]").val(),
			"birthDate":$("[name=\"birthDate\"]").val()
		}
		
		log("save");
		log(data_);
		
		$.ajax({
			type: "GET",
			url: base_uri,
			data:data_,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Method', "modifyUser");
			},
			success: function(data){
				log("success->"+data);
				var json = $.parseJSON( data );
				if( json.status == "ok"){
					log("data ok");
					$(".alert-danger").hide();
					$(".alert-info").show();
				}else{
					log("data NOT ok");
					//.has-error
					if( $.inArray("name",json.invalidData)!=-1) $("[name=\"userName\"]").addClass("error-value");
					else $("[name=\"userName\"]").removeClass("error-value");
					
					if( $.inArray("lastName",json.invalidData)!=-1) $("[name=\"userLastName\"]").addClass("error-value");
					else $("[name=\"userLastName\"]").removeClass("error-value");
					
					if( $.inArray("gender",json.invalidData)!=-1) $("[name=\"gender\"]").addClass("error-value");
					else $("[name=\"gender\"]").removeClass("error-value");
					
					if( $.inArray("birthDate",json.invalidData)!=-1) $("[name=\"birthDate\"]").addClass("error-value");
					else $("[name=\"birthDate\"]").removeClass("error-value");
					
					$(".alert-danger").show();
					$(".alert-info").hide();
				}
			},
			 error: function (xhr, ajaxOptions, thrownError) {
				log("error");
			}
		});
	});
});

function log( text){
	if( typeof(text) != 'string')
		text = JSON.stringify(text);
	//alert(text);
	//document.getElementById("pseudo-console").innerHTML += "<br/>"+text;
}
</script>

<!-- 
<pre id="pseudo-console">
</pre>
 -->

<form enctype="multipart/form-data" method="post">
	
	<!-- avatar -->
	<div id="panel-avatar">
		<section class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Avatar</h3>
			</div>
			<img src="<?php echo $user->avatar ==NULL? "src/img/default_user_avatar.png" : $user->avatar ?>" id="avatar-image"  alt="No image found"/>
			<input type="file" value="" title="Browse" />
		</section>
	</div>
	
	<div id="panel-data">
		<section class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Personal settings</h3>
			</div>
			<div class="panel-body">
			
				<!-- alerts -->
				<div class="alert alert-danger" style="display:none;height: 20px;line-height: 3px;">
				  <a href="#" class="alert-link">Some of the values are not valid</a>
				</div>
				<div class="alert alert-info" style="display:none;height: 20px;line-height: 3px;">
				  <a href="#" class="alert-link" >Data change successful</a>
				</div>

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
						<td class="settings-label">Last name</td>
						<td class="settings-value">
							<input type="text"class="form-control" name="userLastName" value ="<?php echo $user->surname ?>">
						</td >
					</tr>
					<tr>
						<td class="settings-label">Gender</td>
						<td class="settings-value">
							<select name="gender" class="form-control">
								
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

	
	
	<div style="clear:both"></div>
	
	<!-- save button -->
	<button type="button" id="save-button" class="btn btn-default">Save</button>
</form>
