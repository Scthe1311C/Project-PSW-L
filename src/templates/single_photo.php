
<!-- Carousel
   ================================================== -->
<div  id="myCarousel" class="carousel slide">

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php
	$i = 0;
		foreach ($photos as $photo) {
			echo ($photo == $chosen_photo) ? '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="active"></li>' : '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';
		$i++;
		}
		?> 
	</ol> 
	
	<div  class="carousel-inner">
		<?php
	$galleryLink = $galleryId == DatabaseManager::POPULAR_GALLARY_ID? "popular" :'gallery?galleryId=' . $galleryId; 
		foreach ($photos as $photo) {
		   echo ($photo == $chosen_photo) ? '<div class="item active">' : '<div class="item">';
		   echo
			'<div class="container">
				<div class="photo_container">
					<div class="carousel-caption">
						<img class="image"src="' . $photo->link . '">
					 <div>
						<div class="photo_name">
						  <p>' . $photo->name . '</p>
						 </div>
						<div>
						  <a id="browse" class="btn btn-large btn-primary" href="'.$galleryLink.'">Browse gallery</a>
						</div>
					 </div>
					</div>
					</div>
				</div>
			</div>';
		}
		?>
	</div>
	<a  class="left carousel-control" href="#myCarousel" onclick="previous()" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" onclick="next()" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- /.carousel -->

<!--comments-->

<!--TODO Fix bug with not sinchronized comments and photos-->

<div class ="carousel-inner" id="comments">
	<?php {
		foreach ($photos as $photo) {
	?> 

			<div class="<?php echo $photo == $chosen_photo ? "item active" : "item" ?>">
				<?php
				$comments = $photo->allComments();
				foreach ($comments as $comment) {
					$writer = $comment->getWriter();
				?>
					<div class="well">
						<table>
							<tr>
								<td>
									<figure class="person-comment">
										<img src="<?php echo $writer->avatar ==NULL? "src/img/default_user_avatar.png" : $writer->avatar ?>" class="img-thumbnail" alt="No image found">   
										<a href="<?php echo 'profile?userId='.$writer->id?>"><?php echo $writer->getSignature() ?></a>
									</figure>
								</td> 
								<td>
									<h3><?php echo $comment->title ?></h3>
									<hr>
									<section>
										<p><?php echo $comment->text ?></p>
									</section>    
								</td>
							</tr>
						</table>
					</div>
			<?php } ?>
			</div>
	<?php }} ?>

</div>
<!--Add comment form-->
<div class="well">
	<h5>Add comment</h5>
	<form>
		<div class="form-group">
			<input class="form-control" name="title" type="text" placeholder="Title?">
		</div>
		<div class="md-editor active" id="1384301335718">
			<div class="md-header btn-toolbar">
				<div class="btn-group">
					<button class="btn btn-default btn-sm" title="Bold" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdBold">
						<span class="glyphicon glyphicon-bold"></span> 
					</button>
					<button class="btn btn-default btn-sm" title="Italic" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdItalic">
						<span class="glyphicon glyphicon-italic"></span>
					</button>
					<button class="btn btn-default btn-sm" title="Heading" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdHeading">
						<span class="glyphicon glyphicon-font"></span>
					</button>
				</div>
				<div class="btn-group">
					<button class="btn btn-default btn-sm" title="URL/Link" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdUrl">
						<span class="glyphicon glyphicon-globe"></span>
					</button>
					<button class="btn btn-default btn-sm" title="Image" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdImage"><span class="glyphicon glyphicon-picture"></span> </button></div>
				<div class="btn-group">
					<button class="btn btn-default btn-sm" title="List" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdList">
						<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>
				<div class="btn-group">
					<button class="btn btn-primary btn-sm btn-default btn-sm" title="Preview" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdPreview" data-toggle="button">
						<span class="glyphicon glyphicon-search"></span>
						Preview
					</button>
				</div>
			</div>
			<textarea id="textArea" name="content" data-provide="markdown" rows="15" class="md-input" style="resize: none;">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac volutpat magna. Vestibulum semper dignissim diam, eget auctor diam feugiat vitae. Integer suscipit orci at nisl ultricies dignissim. Donec elementum leo est, at rhoncus elit pellentesque id. Aenean euismod dolor tellus, porttitor facilisis elit tempus quis. Mauris accumsan risus magna, vitae vehicula massa tempor pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec in purus nisl. Aliquam hendrerit tortor non felis lobortis egestas. Donec risus diam, consequat vitae varius quis, convallis a nunc. Integer vel dui augue. Ut non sapien pulvinar, commodo risus at, porttitor urna. Duis massa nunc, aliquet in aliquet pulvinar, luctus nec eros. Morbi vel cursus risus. Vestibulum posuere tempus augue non adipiscing.
			Enjoy!
			</textarea>
		</div>
		<label class="checkbox">
			<input name="publish" type="checkbox"> Publish
		</label>
		<hr>
		<button type="submit" class="btn">Submit</button>
	</form>
</div>

<!--function return photo name from path-->
<?php

function getNameFromPath($path) {
	$lastSlash = strripos($path, '/');
	$lastDot = strripos($path, '.');
	return substr($path, $lastSlash + 1, -(strlen($path) - $lastDot));
}
?>
