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
	//setTimeout( function(){ go_to_folder("/")}, 3000);
});

var base_uri = "api.php"; // TODO https ?
var current_folder = "/";

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
			var display_file_name = file_name.length < max_display_name_len ? file_name+ext : file_name.substr(0, max_display_name_len-1)+"~"+ext;
			
			// TODO base id on image spec. data
			imgsHTML += createImageItem( "gallery_item_"+i, file.path, "a_href=a", display_file_name);
		}
	});
	
	// swap
	$("#dropbox-folder-loading").hide();
	$("#dropbox-folder").show();
	document.getElementById("dropbox-folder-folders").innerHTML = dirsHTML;
	document.getElementById("dropbox-folder-content").innerHTML = imgsHTML;
}

function createFolderItem( target_path, name){ 
	var class_ = "folder-item";
	var img =  "src/img/folder-img.png";
	var on_click = "go_to_folder( \'" + target_path + "\' )";// TODO update bar
	return '<div class="gallery-item-wrapper gallery-item-wrapper-folder">'+
				'<div class="'+class_+'">'+
					'<img src="' + img + '" onclick="' + on_click + '"/>' +
				'</div><br/>'+ 
				'<span valign="bottom">' + name + '<span>' +
			'</div>';
}

function createImageItem( id, img_path, img_link, name){
	requestImageThumbnail(id, img_path);
	var class_ = "gallery-image";
	var on_click = "";
	// TODO name shown after hover ?
	return '<div class="gallery-item-wrapper gallery-item-wrapper-image">'+
				'<div class="'+class_+'" id='+id+'>'+
			'</div></div>';;
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

<!-- style="display:none" -->
<pre id="pseudo-console" ></pre>

<table  id="dropbox-folder-loading">
	<tr><td>
		<img src="src/img/dots64.gif"></img>
	</td></tr>
</table >

<div id="dropbox-folder" style="display:none">
	<div id="dropbox-folder-folders" style="width:100%">
		<!-- place for the folders that have root in the current directory -->
	</div> 
	<hr>
	<div id="dropbox-folder-content">
		<!-- place for the folder view -->
	</div> 
</div>
