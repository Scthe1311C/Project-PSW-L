<?php 
/*
TODO template mechanism
	declare-css(src/css/"a.css") // lazy buffer instantiate, write to buffer
	declare-js(src/js/"a.js")
TODO 'back' when in root reloads content
TODO if (selectedPhotosCount > 0) {
TODO when back from folder previously selected images should be visibly selected
TODO when quickly switching folders old async. response updates new content ( unique ids should do the work)
*/
?> 
 
 
<script>

$('document').ready(function(){
	// 'Back' button handler
	$("#folder-hierarchy-up").click(function(){
		var return_path = current_folder.substr( 0,  current_folder.lastIndexOf("/"));
		document.getElementById("pseudo-console").innerHTML += "up pressed, current path: '"+current_folder+"' back to: '"+return_path+"'";
		go_to_folder(return_path);
	});	
	
	// place itself in root
	go_to_folder("/");
	
	
	// add to gallery button
	$("#add-to-gallery").click(function(){
		if( selectedImages.length <1)
			return;
		
		// add white overlay
		$("#dropbox-folder-loading").addClass("dropbox-loading-upload");
		
		// get images
		var arr = new Array();
		$.each( selectedImages, function( i,v){
			document.getElementById("pseudo-console").innerHTML += "<br/>"+i+" -> " + v+"  -> "+($("#"+v).data("path") );
			arr.splice( 0, 0, $("#"+v).data("path"));
		});
		
		// send download request
		var imgs = JSON.stringify(arr);
		$.ajax({
			type: "GET",
			async: true,
			url: base_uri,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Method', "addToGallery");
			},
// !!!
			data:{ "Images":imgs, "GalleryId":3}, // TODO hardcoded gallery id
			success: function(data){
				log(data);
				$("#dropbox-folder-loading").removeClass("dropbox-loading-upload");
			},
			 error: function (xhr, ajaxOptions, thrownError) {
				log("add-to-gallery error");
				$("#dropbox-folder-loading").removeClass("dropbox-loading-upload");
			}
	   });
	});	
});

function log( text){
	if( typeof(text) != 'string')
		text = JSON.stringify(text);
	document.getElementById("pseudo-console").innerHTML += "<br/>"+text;
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

<pre id="pseudo-console" ></pre>
	

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
