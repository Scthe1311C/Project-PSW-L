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

function isBlank(str) {
	return (!str || /^\s*$/.test(str));
}

var selectedImages = new Array();
var base_uri = "api.php"; // TODO https ?
var current_folder = "/";



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

function image_click( id){
	//document.getElementById("pseudo-console").innerHTML += "   ("+id+")_["+selectedImages+"]_";
	if( $.inArray( id, selectedImages) != -1){
		//document.getElementById("pseudo-console").innerHTML +="r";
		selectedImages.splice( selectedImages.indexOf( id), 1); // remove
		// visual indicators
		$( "#"+id+" .glyphicon").removeClass("gallery-image-glyphicon-active");
		$( "#"+id+" div").removeClass("gallery-image-darken-active");
	}else{
		//document.getElementById("pseudo-console").innerHTML +="a";
		selectedImages.splice( 0, 0, id); // add
		// visual indicators
		$( "#"+id+" .glyphicon").addClass("gallery-image-glyphicon-active");
		$( "#"+id+" div").addClass("gallery-image-darken-active");
	}
}

function go_to_folder( path){
	if( isBlank(path))
		path = "/";
	document.getElementById("pseudo-console").innerHTML += "\ndirectory metadata read: '"+path+"'";
	
	current_folder = path;
	write_folder_name();
	$("#dropbox-folder-loading").show();
	$("#dropbox-folder").hide();
	
	// call for folder content
	$.ajax({
		type: "GET",
		url: base_uri,
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Path', path);
			xhr.setRequestHeader('Method', "metadata"); // TODO handle by uri not header
		},
		success: function(data){
			var json = $.parseJSON( data );
			create_folder_content( json);
		}
	});
}

function write_folder_name(){
	// TODO add dropbox icon when path != "/" ?
	var split_ = current_folder.substring(1).split("/");
	var result = "";
	var path = "";
	for (var i = 0; i < split_.length; i++) {
		var name = "/" + split_[i];
		path += name;
		result += "/<span onClick=\"go_to_folder('" + path + "');\" >" + split_[i] + "</span>";
	}
	document.getElementById("current-folder-name").innerHTML = result;
}

function create_folder_content( dropbox_dir_json){
	// all directories
	var dirsHTML = "";
	$.each( dropbox_dir_json.contents, function(i, file){
		if( file.is_dir){
			dirsHTML += createFolderItem( file.path, file.path.substr( file.path.lastIndexOf("/")+1));
		}
	});
	
	// all images
	var imgsHTML = "";
	var max_display_name_len = 15;
	$.each( dropbox_dir_json.contents, function(i, file){
		if( !file.is_dir && file.mime_type.indexOf("image") == 0 && file.thumb_exists){
			var ext = file.path.substring( file.path.lastIndexOf("."));
			var file_name = file.path.substring( file.path.lastIndexOf("/")+1, file.path.lastIndexOf("."));
			var display_file_name = file_name.length < max_display_name_len ?
				(file_name + ext) : (file_name.substr(0, max_display_name_len-1) + "~" + ext);
			
			// TODO base id on image spec. data
			imgsHTML += createImageItem( "gallery_item_"+i, file.path, display_file_name);
		}
	});
	
	// swap
	$("#dropbox-folder-loading").hide();
	$("#dropbox-folder").show();
	document.getElementById("dropbox-folder-folders").innerHTML = dirsHTML;
	document.getElementById("dropbox-folder-content").innerHTML = imgsHTML;
}

function createFolderItem( target_path, name){ 
	var img =  "src/img/folder-img.png";
	var on_click = "go_to_folder( \'" + target_path + "\' )";
	return '<div class="gallery-item-wrapper gallery-item-wrapper-folder">'+
				'<div class="folder-item">'+
					'<img src="' + img + '" onclick="' + on_click + '"/>' +
				'</div><br/>'+ 
				'<span valign="bottom">' + name + '<span>' +
			'</div>';
}

function createImageItem( id, img_path, name){
	requestImageThumbnail(id, img_path);
	
	var on_click = "image_click(\'" + id + "\')";
	return '<div class="gallery-item-wrapper gallery-item-wrapper-image" onclick="'+on_click+'" >'+
				'<div class="gallery-image" id="'+id+'" >'+
				'<div><label>'+name+'</label></div>'+
				'<span class="glyphicon glyphicon-ok"></span>'+
			'</div></div>';
}

function requestImageThumbnail( id, img_path){
	$.ajax({
		type: "GET",
		url: base_uri,
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Path', img_path);
			xhr.setRequestHeader('Method', "requestThumb"); // TODO handle by uri not header
		},
		success: function(data){
			// substitute stub image
			var json = $.parseJSON( data );
			if(json.status=="ok"){
				img_path = "" + json.path;
				$("#"+id).addClass("background-cover");
			}else // TODO could not load image - raise warning
				img_path = "src/img/be.png";
			$("#"+id).css("background-image", "url("+img_path+")" );
			//document.getElementById("pseudo-console").innerHTML += "respond(" +id+ "): '"+data+"'";
		}
   });
}

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
	
<!-- loading screeen -->
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

