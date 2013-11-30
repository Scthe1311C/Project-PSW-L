<script>

$('document').ready(function(){
	go_to_folder(" ");
});

var base_uri = "api.php"; // TODO https ?

function go_to_folder( path){
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
			//document.getElementById("pseudo-console").innerHTML = "directory metadata read: '"+path+"'";
		}
   });
}


function create_folder_content( dropbox_dir_json){
	var result = "<ul>";
	
	// all directories
	if( dropbox_dir_json.path != "/"){ // back to parent directory
		var return_path = dropbox_dir_json.path.substr( 0,  dropbox_dir_json.path.lastIndexOf("/"));
		result += createFolderItem( return_path, "..");
	}
	$.each( dropbox_dir_json.contents, function(i, file){
		if( file.is_dir){
			result += createFolderItem( file.path, file.path.substr( file.path.lastIndexOf("/")+1));
		}
	});
	
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
}


 
function createFolderItem( target_path, name){ 
	return "<li>dir:"+name+"</li>";
}

function createImageItem( id, img_path, img_link, name){
	requestImageThumbnail(id, img_path);
	return '<li><img src="src/img/dropbox-logo.png" id="'+id+'"/>img:'+name+"</li>";
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


<hr>
<!-- 
<pre id="pseudo-console"></pre>
 -->
<div id="dropbox-folder-content">
	<!-- place for the folder view -->
</div> 
