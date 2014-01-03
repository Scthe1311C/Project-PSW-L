<div class="galleries">

<?php foreach ($galleries as $gallery) { ?>
	<div class="gallery">
		<!-- image -->
		<a href="gallery?galleryId=<?php echo $gallery->id ?>">
			<img class="folder-image" src="src/img/folder-img2.png"/>
			<img class="gallery-thumbnail" src="<?php echo $gallery->tumbnail_href ?>"/>
		<div></div>
		</a>
		<!--title-->
		<h4><?php echo $gallery->name ?></h4>
	</div>
<?php } ?>

<?php if( isset($user) && strpos($_SERVER["REQUEST_URI"],'user-profile') !== false){ ?>
	<div class="gallery">
		<!-- image -->
		<input type="image" src="src/img/folder-img2.png" class="folder-image" >
		<span id="gallery-add" class="glyphicon glyphicon-plus"></span>
		<div></div>
		<!--title-->
		<h4>Add new gallery</h4>
	</div>
<?php } ?>


</div>