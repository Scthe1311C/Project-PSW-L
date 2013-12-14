<script>

function isBlank(str) {
	return (!str || /^\s*$/.test(str));
}

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

var base_uri = "api.php"; // TODO https ?
var current_folder = "/";

function go_to_folder( path){
	if( isBlank(path))
		path = "/";
	document.getElementById("pseudo-console").innerHTML += "\ndirectory metadata read: '"+path+"'";
	
	current_folder = path;
	document.getElementById("current-folder-name").innerHTML = path;
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

function create_folder_content( dropbox_dir_json){
	// all directories
	var dirsHTML = "";
	$.each( dropbox_dir_json.contents, function(i, file){
		if( file.is_dir){
			dirsHTML += createFolderItem( file.path, file.path.substr( file.path.lastIndexOf("/")+1));
		}
	});
	document.getElementById("dropbox-folder-folders").innerHTML = dirsHTML;
	
	/*
	// all images
	var max_display_name_len = 15;
	$.each( dropbox_dir_json.contents, function(i, file){
		if( !file.is_dir && file.mime_type.indexOf("image") == 0 && file.thumb_exists){
			var ext = file.path.substring( file.path.lastIndexOf("."));
			var file_name = file.path.substring( file.path.lastIndexOf("/")+1, file.path.lastIndexOf("."));
			var display_file_name = file_name.length < max_display_name_len ? file_name+ext : file_name.substr(0, max_display_name_len-1)+"~"+ext;
			
			result += createImageItem( i, file.path, "a_href=a", display_file_name);
		}
	});
	
	document.getElementById("dropbox-folder-content").innerHTML = result+"</ul>";
	*/
}

function createFolderItem( target_path, name){ 
	var class_ = "folder-item";
	var img =  "src/img/folder-img.png";
	var on_click = "go_to_folder( \'" + target_path + "\' )";// TODO update bar
	return '<div class="gallery-item-wrapper">'+
				'<div class="'+class_+'">'+
					'<img src="' + img + '" onclick="' + on_click + '"/>' +
				'</div><br/>'+ 
				'<span valign="bottom">' + name + '<span>' +
			'</div>';
}

function createImageItem( id, img_path, img_link, name){
	requestImageThumbnail(id, img_path);
	return '<li><img src="src/img/loaderb32.gif" id="'+id+'"/>img:'+name+"</li>";
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
			if(json.status=="ok") // is this string ?
				$("#"+id).attr("src", json.path);
			else // TODO could not load image - raise warning
				$("#"+id).attr("src", "src/img/be.png");
			//document.getElementById("pseudo-console").innerHTML += "<br/>respond22: '"+data+"'";
		}
   });
}

</script>

<!-- 
TODO template mechanism
	declare-css(src/css/"a.css") // lazy buffer instantiate, write to buffer
	declare-js(src/js/"a.js")
	
	
 -->

<div id="browse-actions">
	<div class="pull-left side-button" id="up-folder">
		<button name="action" type="submit" style="cursor: default;" class="action-button" id="folder-hierarchy-up">
			<span style="cursor: default;">
				<img class="sprite" src="src/img/folder-up.png" style="cursor: default;"></img>
				Back
			</span>
		</button>
	</div>
	
	<div class="pull-right side-button">
		<button name="action" style="cursor: default;" class="action-button">
			<span style="cursor: default;">
				<img class="sprite sprite_rainbow" src="src/img/sprite_spacer.gif" style="cursor: default;"></img>
				add to gallery
			</span>
		</button>
	</div>
	<div class="" id="current-folder-name">
		/
	</div>
	<div class="clearfix"></div>
</div>

<pre id="pseudo-console"></pre>

<div id="dropbox-folder-folders">
	<!-- place for the folders that have root in the current directory -->
</div> 
<hr>
<div id="dropbox-folder-content">
	<!-- place for the folder view -->
</div> 

