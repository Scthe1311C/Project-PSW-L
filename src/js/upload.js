function isBlank(str) {
	return (!str || /^\s*$/.test(str));
}

var selectedImages = new Array();
var base_uri = "api.php"; // TODO https ?
var current_folder = "/";

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
	//document.getElementById("pseudo-console").innerHTML += "\ndirectory metadata read: '"+path+"'";
	
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
			xhr.setRequestHeader('Method', "metadata");
		},
		success: function(data){
			//document.getElementById("pseudo-console").innerHTML += "\n>"+data+"<";
			var json = $.parseJSON( data );
			create_folder_content( json);
		},
		error: function(xhr, textStatus, errorThrown){
			//document.getElementById("pseudo-console").innerHTML += "\n'"+textStatus+"'  ;'"+errorThrown+"'";
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
		//return false; // debug
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
				'</div>'+
			'</div>';
}

function requestImageThumbnail( id, img_path){
	$.ajax({
		type: "GET",
		async: true,
		url: base_uri,
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Path', img_path);
			xhr.setRequestHeader('Method', "requestThumb");
		},
		success: function(data){
			// substitute stub image
			var json = $.parseJSON( data );
			if(json.status=="ok"){
				img_local_path = "" + json.path;
				$("#"+id).addClass("background-cover");
			}else // TODO could not load image - raise warning
				img_local_path = "src/img/be.png";
			$("#"+id).data("path", img_path).css("background-image", "url("+img_local_path+")" );
			//document.getElementById("pseudo-console").innerHTML += "respond(" +id+ "): '"+data+"'";
		},
		 error: function (xhr, ajaxOptions, thrownError) {
			//document.getElementById("pseudo-console").innerHTML += "\nrequestImageThumbnail() error";
		}
   });
}

function uploadImages( galleryId){
	// add white overlay
	$("#dropbox-folder-loading").addClass("dropbox-loading-upload");
	$("#dropbox-folder-loading").show();
	
	// get images
	var arr = new Array();
	$.each( selectedImages, function( i,v){
		//document.getElementById("pseudo-console").innerHTML += "<br/>"+i+" -> " + v+"  -> "+($("#"+v).data("path") );
		arr.splice( 0, 0, $("#"+v).data("path"));
	});
	selectedImages = new Array();
	
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
		data:{ "Images":imgs, "GalleryId":galleryId},
		success: function(data){
			//log(data);
			$("#dropbox-folder-loading").removeClass("dropbox-loading-upload");
			go_to_folder( current_folder);
		},
		 error: function (xhr, ajaxOptions, thrownError) {
			//log("add-to-gallery error");
			$("#dropbox-folder-loading").removeClass("dropbox-loading-upload");
			go_to_folder( current_folder);
		}
   });
}
