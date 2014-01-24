<!-- 
TODO provide exif data variables !
-->

<script>
var base_uri = "api.php"; // TODO https ?

$('document').ready(function(){
	
	$("#gallery-remove").click(function(){
		// TODO ask if user really wants to remove this gallery
		log("remove");
		$.ajax({
			type: "GET",
			url: base_uri,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Method', "removeGallery");
				xhr.setRequestHeader('GalleryId', <?php echo $gallery->id; ?>);
			},
			success: function(data){
				log($.parseJSON( data ));
				var json = $.parseJSON( data );				
				if ( json.status === 'ok') {
					window.location = 'user-profile?page=galleries';
				}
			}
		});
	});	
	
	$("#gallery-upload").click(function(){
		window.location = "upload?galleryId=<?php echo $gallery->id; ?>";
	});	
	
	/*
	 Rename handlers
	*/
	$("#gallery-rename").click(function(){
		log("rename");
		var el = document.getElementById("dialog_overlay");
		el.style.display = el.style.display != "block" ? "block" : "none";
	});	
	
	$("#dialog_overlay").click(function( e){
		if( e.target.id == "dialog_overlay")
			document.getElementById("dialog_overlay").style.display = "none";
	});
	
	$("#create-gallery-button").click(function(){
		var name = $("#gallery-name").val();
		$.ajax({
			type: "GET",
			url: base_uri,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Method', "renameGallery");
				xhr.setRequestHeader('GalleryName', name);
				xhr.setRequestHeader('GalleryId', <?php echo $gallery->id; ?>);
			},
			success: function(data){
				//log($.parseJSON( data ));
				var json = $.parseJSON( data );
				if( json.status == "ok"){
					location.reload(); // lazy way to do things :)
				}
			}
		});
	});	
	
});

function heartIt( photoId){
	log("heart: "+photoId);
	$.ajax({
		type: "GET",
		url: base_uri,
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Method', "addToFavorite");
			xhr.setRequestHeader('photoId', photoId);
		},
		success: function(data){
			log($.parseJSON( data ));
			//var json = $.parseJSON( data );
			//if( json.status == "ok"){
			//	location.reload(); // lazy way to do things :)
				
			// TODO add little heart if You like this photo !
		}
	});
}

function removePhoto( photoId){
	log("remove: "+photoId);
	$.ajax({
		type: "GET",
		url: base_uri,
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Method', "removePhoto");
			xhr.setRequestHeader('photoId', photoId);
			log("send");
		},
		success: function(data){
			log("resp came ! :="+data);
			//log($.parseJSON( data ));
			var json = $.parseJSON( data );
			if( json.status == "ok")
				//log("resp ok");
				location.reload();
			//else
				//log("resp Error");
			//	location.reload(); // lazy way to do things :)
		}
	});
}
	
function log( text){
	if( typeof(text) != 'string')
		text = JSON.stringify(text);
	//alert(text);
	//document.getElementById("pseudo-console").innerHTML += "<br/>"+text;
}

</script>

<!-- gallery name etc. -->
<div id="gallery-stats">
	<span><?php echo $gallery->name; ?></span>
	<div>
		<span id="gallery-remove" class="gallery-action-icon glyphicon glyphicon-remove"></span>
		<span id="gallery-rename" class="gallery-action-icon glyphicon glyphicon-pencil"></span>
		<span id="gallery-upload" class="gallery-action-icon glyphicon glyphicon-arrow-down"></span>
	</div>
</div>
<hr>

<!-- 
<pre id="pseudo-console">
</pre>  -->


<!-- photos -->
<?php foreach($photos as $photo){ ?>

	<!-- single image element -->
	<div class="photo-thumbnail" style="width:188px;">
		
		<!-- gradients -->
		<div class="image-stats photo-thumbnail-bottom-gradient"></div>
		<div style="height:30px !important;" class="image-stats photo-thumbnail-top-gradient"></div>
		
		<!-- image info -->
		<!-- 
		<div class="image-stats views-count">
			<span class="glyphicon glyphicon-eye-open"></span>&nbsp;
			<span><?php echo $photo->views<1000? $photo->views: ($photo->views/1000)."k"?></span>
		</div>
		<div class="image-stats favorite-count">
			<span class="glyphicon glyphicon-heart"></span>&nbsp;
			<span><?php echo $photo->favorites<1000? $photo->favorites: ($photo->favorites/1000)."k"?></span>
		</div>
		-->
 
		<?php if( $is_logged){ ?>
			<div class="image-stats favorite-mark-up">
				<span class="glyphicon glyphicon-heart" onclick="heartIt(<?php echo $photo->id; ?>);"></span>
			</div>
			<div class="image-stats delte-img">
				<span class="glyphicon glyphicon-remove" onclick="removePhoto(<?php echo $photo->id; ?>);"></span>
			</div>
		<?php } ?>
		
		<!-- image -->
		<a href="<?php echo 'photo?galleryId='.$gallery->id.'&photoId='.$photo->id;?>">
			<img src="<?php echo $photo->link; ?>" class="file"/>
		</a>		
	</div>
<?php } ?>

<div id="dialog_overlay">
	<div>
		<h4>Rename '<?php echo $gallery->name; ?>'</h4>
		<input id="gallery-name" type="text" class="form-control" placeholder="New gallery name..">
		<input type="submit" id="create-gallery-button" class="btn btn-default" value="Rename gallery" >
	</div>
</div>
