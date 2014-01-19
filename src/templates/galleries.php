<script>
	
$('document').ready(function(){
	$("#add-new-gallery").click(function(e){
		var el = document.getElementById("dialog_overlay");
		//console.log( (el.style.display != "block")+"  " +el.style.display);
		el.style.display = el.style.display != "block" ? "block" : "none";
	});	
	
	$("#dialog_overlay").click(function( e){
		//console.log( "black-background "+e.target.nodeName);
		if( e.target.id == "dialog_overlay")
			document.getElementById("dialog_overlay").style.display = "none";
	});
	
	var base_uri = "api.php"; // TODO https ?
	
	$("#create-gallery-button").click(function( e){
		var name = $("#gallery-name").val();
		$.ajax({
			type: "GET",
			url: base_uri,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Method', "createGallery");
				xhr.setRequestHeader('GalleryName', name);
			},
			success: function(data){
				//document.getElementById("pseudo-console").innerHTML += "<br/>"+data;
				var json = $.parseJSON( data );
				if( json.status == "ok"){
					location.reload(); // lazy way to do things :)
					//document.getElementById("dialog_overlay").style.display = "none";
					//document.getElementById("pseudo-console").innerHTML += "<br/>OOOOOOOOK !";
				}
			}
		});
	});
});
	
</script>

<div class="galleries">

	<?php foreach ($galleries as $gallery) { ?>
		<div class="gallery">
			<!-- image -->
			<a href="gallery?galleryId=<?php echo $gallery->id ?>">
				<img class="gallery-thumbnail" src="<?php echo $gallery->tumbnail_href ?>"/>
			</a>
			<div class="gallery-thumbnail gallery-darken-layer">
				<label><?php echo count( $gallery->allPhotos()); ?></label>
			</div>
			<!--title-->
			<h4><?php echo $gallery->name ?></h4>
		</div>
	<?php } ?>

	<?php if( isset($user) && strpos($_SERVER["REQUEST_URI"],'user-profile') !== false){ ?>
		<div class="gallery">
			<!-- image -->
			<div id="add-new-gallery">
				<span id="gallery-add" class="glyphicon glyphicon-plus"></span>
			</div>
		</div>
	<?php } ?>

</div>

<div id="dialog_overlay">
	<div>
		<h4>Create new gallery</h4>
		<input id="gallery-name" type="text" class="form-control" placeholder="Gallery name..">
		<input type="submit" id="create-gallery-button" class="btn btn-default" value="Create gallery" >
	</div>
</div>
