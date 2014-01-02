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
	
});

</script>


<div id="browse-actions">
	<button name="action" type="submit" style="text-align: left; cursor: default;" class="action-button pull-left" id="folder-hierarchy-up">
		<span style="cursor: default;">
			<img class="sprite" src="src/img/folder-up.png" style="cursor: default;"></img>
			Back
		</span>
	</button>

	<button name="action" style="cursor: default;" class="action-button pull-right">
		<span style="cursor: default;">
			<img class="sprite sprite_rainbow" src="src/img/sprite_spacer.gif" style="cursor: default;"></img>
			add to gallery
		</span>
	</button>
	
	<div class="" id="current-folder-name">
		/
	</div>
</div>

<pre id="pseudo-console" ></pre>
	
<!-- loading screen -->
<table  id="dropbox-folder-loading">
	<tr><td>
		<img src="src/img/dots64.gif"></img>
	</td></tr>
</table>
 
<div id="dropbox-folder" style="display:none">
	<div id="dropbox-folder-folders" style="width:100%">
		<!-- place for the folders that have root in the current directory -->
	</div> 
	<hr>
	<div id="dropbox-folder-content">
		<!-- place for the folder view -->
	</div> 
</div>

