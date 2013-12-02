<?php
	class Gallery {
	private $data;

	function __construct($data) {
		$this->data = $data;
	}

	public function __get($name) {
		return $this->data[$name];
	}

	public function allPhotos(){
		include './model/connection.php';
		
		$sql = "Select * from photos\n"
			 . "where id in\n"
			 . "(SELECT photo_id From galleries, photos_galleries\n"
			 . "where ".$this->data["id"]." = photos_galleries.gallery_id)";
		
		$resource = mysql_query($sql, $sql_conn);
		$allPhotos = [];
		while($data = mysql_fetch_assoc($resource)){
		$photo = new Photo($data);
			$allPhotos[$photo->id]=$photo;
		}
		return $allPhotos;
	}  

	public function getDesignerSignature(){
		return Users::getUserSignature($this->data["user_id"]);
	}
}

class Popular extends Gallery{
	public function __construct($data) {
		parent::__construct($data);
	}

	public function allPhotos() {
		$data = DAO::select("photos", "*", new Condition(1,"=",1), ["ORDER BY favorites desc", "Limit 0,30"]);
		$allPhotos = [];
		foreach ($data as $photoData){
			$photo = new Photo($photoData);
			$allPhotos[$photo->id]=$photo;
		}
		return $allPhotos;
	}

	public function getDesignerSignature() {
		return null;
	}
}

class Galleries{
	const POPULAR_GALLARY_ID =1;

	public static function getGallery($galleryId){    
		$data = DAO::select("galleries", "*", new Condition("id","=",$galleryId), NULL)[0];    
		if($galleryId == static::POPULAR_GALLARY_ID){
			$gallery = new Popular($data);
		}else{
			$gallery = new Gallery($data);
		}
		return $gallery;
	}

	public static function allGalleries(){
		$idTab = DAO::select("galleries", "id", new Condition("1","=","1"), NULL); 
		print_r($idTab);
		$galleries = [];
		foreach ($idTab as $key=>$arrayId){
			$galleries[] = Galleries::getGallery($arrayId["id"]);
		}
		return $galleries;
	}
}

?>


