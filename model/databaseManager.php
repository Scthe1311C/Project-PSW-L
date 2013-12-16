<?php
	$includedFiles = ["DAO", "data", "address", "comment", "gallery", "photo", "user"];
	foreach ($includedFiles as $file) {
		include $file . ".php";
	}
	
	const POPULAR_GALLARY_ID = 1;
	//array map className =>DB_tableName
	$class_tables = [
		"Address" => "addresses",
		"Comment" => "comments",
		"Gallery" => "galleries",
		"Popular" => "galleries",
		"Photo"   => "photos",
		"User"    => "users",
		"Country" => "countries"
	];
	
	//Return all object from selected type ( f.e. "User")
	
	function getAllObjects($className) {
		return getObjectsByConditions($className, TRUE_CONDITION);
	}

	//Return object from selected type and id ( f.e. "Photo", 1)
	// if selected type or type with id doesnt exist return NULL	
	function getObjectById($className, $id) {
		$objectTab = getObjectsByConditions($className, new Condition("id", "=", $id));
		return empty($objectTab)?
				NULL :
				$objectTab[$id];
	}
	
	//Return array of object from selected type form DB with contains conditions and addition
	//(f.e "Photo",["id", "link"], new Condition("width",">","1024"), "Limit(0,30)")	
	function getObjectsByConditions($className, $conditions, $additions = []) {
		global $class_tables;
		$data = DAO::select($class_tables[$className], "*", $conditions, $additions);
		return empty($data)? 
				[] :
				getAllObjectsArray($className, $data);
	}
		
	//Check if new data are correct and update
	//(f.e "User", ["name" => "Piter"], new Condition("surname","=","Smith"))
	function updateObjectByConditions($className, $newData, $conditions) {
		global $class_tables;
		foreach ($newData as $name =>$value)
			$className::checkCorrect($name, $value);
		DAO::update($class_tables[$className], $newData, $conditions);
	}
	
	//Check if new data are correct and update
	//(f.e "User", ["name" => "Piter"], 1)
	function updateObjectById($className, $newData, $id){
		updateObjectByConditions($className, $newData, new Condition("id", "=",$id));
	}
	
	// if data are correct updtate insert new data in DB
	// (f.e "User", "$userData")
	
	function insertObject($className, $data) {
		global $class_tables;
		foreach ($data as $name =>$value)
			$className::checkCorrect($name, $value);
		DAO::insert($class_tables[$className], $data);
	}

	//Return instace of class construct by data
	//(f.e "Gallery", $galleryData)	
	function getInsance($className, $data) {
		switch ($className) {
			case "Gallery": if ($data["id"] == POPULAR_GALLARY_ID)
					return new Popular($data);
				else
					return new Gallery($data);
			default : return new $className($data);
		}
	}

	//array of selected type and array of data
	//if data contains id as key associative array otherwise return simple array
	// (f.e "Photo", [$photo1Data, $photo2Data, $photo3Data])	
	function getAllObjectsArray($className, $dataTab) {
		$class = [];
		foreach ($dataTab as $data) {
			$newClass = getInsance($className, $data);
			if(array_key_exists("id", $data))
				$class[$newClass->id] = $newClass;		
			else 
				$class[] = $newClass;			
		}
		return $class;
	}
	function getAllUserCreatedGalleries($userId){
		return getObjectsByConditions("Gallery", new Condition("user_id", "=",$userId));
	}
	
	function getAllPhotosFromGallery($galleryId){
		$data = DAO::select(["photos_galleries", "photos"], "photos.*", [new Condition("gallery_id", "=", $galleryId),
																		 new Condition("photo_id", "=", "photos.id")]);
		return getAllObjectsArray("Photo", $data);
	}
	
	function getAllUserFavoritePhotos($userId){
		$data = DAO::select(["favorite_photos", "photos"], "photos.*", [new Condition("user_id", "=",$userId),
																		new Condition("photos.id","=","photo_id")]);
		return getAllObjectsArray("Photo", $data);
	}
	
	function getAllUserFollowedGalleries($userId){
		$data = DAO::select(["fallowed_galleries", "gallery"], "gallery.*", [new Condition("user_id", "=",$userId),
																		new Condition("gallery.id","=","gallery_id")]);
		return getAllObjectsArray("Photo", $data);
	}
	
	function getAllUserFriends($userId){
		$data = DAO::select(["friends", "users"], "*", [new Condition("user_id", "=", $userId),
														new Condition("id", "=", "friend_id")]);
	}
	
	function addFavoritePhoto($userId, $photoId){
		return DAO::insert("favorite_photos", ["user_id" => $userId, "photo_id" => $photoId]);
	}
	
	function addFollowedGallery($userId, $galleryId){
		return DAO::insert("followed_galleries", ["user_id" => $userId, "gallery_id" =>$galleryId]);
	}
	
	function addFriend($userId, $friendId){
		return DAO::insert("friends", ["user_id" => $userId, "friend_id" =>$friendId]);
	}
//$p1 = getClassById("Photo", "1");
//print_r($p1);
//print_r (getAllClass("Photo"));
//print_r (getClassById("Gallery", "1"));
//print_r(insertClass("Gallery", ["name"=>"aaa"]));
//print_r(getAllClass("Country"));
//print_r(getClassById("User", 1)->address);
//$user = getClassById("User", 1);
//print_r($user->address->country);
?>
