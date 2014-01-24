<?php 
/*
TODO template mechanism
	declare-css(src/css/"a.css") // lazy buffer instantiate, write to buffer
	declare-js(src/js/"a.js")
TODO 'back' when in root reloads content
TODO when back from folder previously selected images should be visibly selected
TODO when quickly switching folders old async. response updates new content ( unique ids should do the work)
*/
?> 
 
 
<script>

$('document').ready(function(){

	// 'Back' button handler
	$("#folder-hierarchy-up").click(function(){
		var return_path = current_folder.substr( 0,  current_folder.lastIndexOf("/"));
		//document.getElementById("pseudo-console").innerHTML += "up pressed, current path: '"+current_folder+"' back to: '"+return_path+"'";
		go_to_folder(return_path);
	});	
	
	// place itself in root
	go_to_folder("/");
	
	
	// add to gallery button
	$("#add-to-gallery").click(function(){
		if( selectedImages.length < 1)
			return;
		<?php if( !isset( $_GET["galleryId"]) || $_GET["galleryId"] == NULL){ ?>
			// show dialog
			$("#dialog_overlay").show();
		<?php }else{ ?>
			uploadImages(<?php echo $_GET["galleryId"]; ?>);
		<?php } ?>
		
	});
	
	
});

function uploadToGallery( galleryId){
	// hide dialog
	$("#dialog_overlay").hide();
	uploadImages( galleryId);
}

function cancelUpload(){
	$("#dialog_overlay").hide();
	$("#dropbox-folder-loading").removeClass("dropbox-loading-upload");
	$("#dropbox-folder-loading").hide();
}
</script>


<div id="browse-actions">
	<button name="action" class="pull-left" id="folder-hierarchy-up">
		<span id="gallery-upload" class="gallery-action-icon glyphicon glyphicon-chevron-left"></span>
		<span>&nbsp Back</span>
	</button>

	<button name="action" class="pull-right" id="add-to-gallery">
		<span id="gallery-upload" class="gallery-action-icon glyphicon glyphicon-folder-open"></span>
		<span>&nbsp Add to gallery</span>
	</button>
	
	<div class="" id="current-folder-name">
		/
	</div>
</div>

<!-- 
<pre id="pseudo-console" ></pre>
 -->
<?php if( !isset( $_GET["galleryId"]) || $_GET["galleryId"] == NULL){ ?>
	<!-- Target gallery choose -->
	<div id="dialog_overlay">
		<div>
			<h4>Choose gallery</h4>
			<!-- 
			<input id="gallery-name" type="text" class="form-control" placeholder="Gallery name..">
			<input type="submit" id="create-gallery-button" class="btn btn-default" value="Create gallery" >
			 -->
			<?php foreach( $user_galleries as $k=>$v){ ?>
			<!-- <?php echo $k."->".($v->name)."<br/>" ?>  -->
				<input class="submit-button" action="upload" type="submit" name="upload-submit"
					value="<?php echo $v->name; ?>" onClick="uploadToGallery(<?php echo $k; ?>)">
			<?php } ?>
			<button id="galleryChooseCancel" type="button" class="btn btn-danger" onClick="cancelUpload()">Cancel</button>
		</div>
	</div>
<?php } ?>

 
<div id="dropbox-content" style="">
	<div id="dropbox-folder">
		<div id="dropbox-folder-folders" style="width:100%">
			<!-- place for the folders that have root in the current directory -->
		</div> 
		<hr>
		<div id="dropbox-folder-content">
			<!-- place for the folder view -->
		</div> 
	</div>

	<!-- loading screen -->
	<div id="dropbox-folder-loading">
		<div></div>
		<table>
			<tr><td>
				<img src="src/img/dots64.gif"></img><!-- TODO add alpha to image -->
			</td></tr>
		</table>
	</div>
</div>
