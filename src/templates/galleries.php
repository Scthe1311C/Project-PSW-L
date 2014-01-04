<script>
	
$('document').ready(function(){
	$("#add-new-gallery").click(function(e){
		var el = document.getElementById("dialog_overlay");
		console.log( (el.style.display != "block")+"  " +el.style.display);
		el.style.display = el.style.display != "block" ? "block" : "none";
	});	
	
	$("#dialog_overlay").click(function( e){
		//console.log( "black-background "+e.target.nodeName);
		if( e.target.id == "dialog_overlay")
			document.getElementById("dialog_overlay").style.display = "none";
	});	
	
});
	
</script>

<div class="galleries">

	<?php foreach ($galleries as $gallery) { ?>
		<div class="gallery">
			<!-- image -->
			<a href="gallery?galleryId=<?php echo $gallery->id ?>">
				<img class="folder-image" src="src/img/folder-img2.png"/>
				<img class="gallery-thumbnail" src="<?php echo $gallery->tumbnail_href ?>"/>
			</a>
			<!--title-->
			<h4><?php echo $gallery->name ?></h4>
		</div>
	<?php } ?>

	<?php if( isset($user) && strpos($_SERVER["REQUEST_URI"],'user-profile') !== false){ ?>
		<div class="gallery">
			<!-- image -->
			<div id="add-new-gallery">
				<img class="folder-image" src="src/img/folder-img2.png"/>
				<span id="gallery-add" class="glyphicon glyphicon-plus"></span>
			</div>
			<!--title-->
			<h4>Add new gallery</h4>
		</div>
	<?php } ?>

</div>

<div id="dialog_overlay">
	<div>
		<h4>Create new gallery</h4>
		<input id="username" type="text" class="form-control" placeholder="Gallery name..">
		<input type="submit" id="create-gallery-button" class="btn btn-default" value="Create gallery" >
	</div>
</div>
