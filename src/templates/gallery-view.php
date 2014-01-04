<!-- 
TODO provide exif data variables !
-->

<script>

$('document').ready(function(){
	$("#gallery-remove").click(function(){
		log("remove");
	});	
	
	$("#gallery-rename").click(function(){
		log("rename");
	});	
	
	$("#gallery-upload").click(function(){
		log("upload");
	});	
	
	
});

function hearthIt( photoId){
	log("hearth: "+photoId);
}
	
function log( text){
	document.getElementById("pseudo-console").innerHTML += "<br/>"+text;
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

<pre id="pseudo-console">
</pre>

<!-- photos -->
<?php foreach($photos as $photo){ ?>

	<!-- single image element -->
	<div class="gallery-thumbnail" style="width:188px; height:141">
		
		<!-- gradients -->
		<div class="image-stats gallery-thumbnail-bottom-gradient"></div>
		<div style="height:30px !important;" class="image-stats gallery-thumbnail-top-gradient"></div>
		
		<!-- image info -->
		<div class="image-stats views-count">
			<span class="glyphicon glyphicon-eye-open"></span>&nbsp;
			<span><?php echo $photo->views<1000? $photo->views: ($photo->views/1000)."k"?></span>
		</div>
		<div class="image-stats favorite-count">
			<span class="glyphicon glyphicon-heart"></span>&nbsp;
			<span><?php echo $photo->favorites<1000? $photo->favorites: ($photo->favorites/1000)."k"?></span>
		</div>

		<!-- quick mark as favorite -->
		<?php if( $is_logged){ ?>
			<div class="image-stats favorite-mark-up">
				<span class="glyphicon glyphicon-heart" onclick="hearthIt(<?php echo $photo->id; ?>);"></span>
			</div>
		<?php } ?>
		
		<!-- image -->
		<a href="<?php echo 'photo?galleryId='.$gallery->id.'&photoId='.$photo->id;?>">
			<img src="<?php echo $photo->thumbnail_link; ?>" class="file"/>
		</a>		
	</div>
<?php } ?>
