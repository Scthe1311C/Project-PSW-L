<?php
class Gallery extends Data {
	public function allPhotos(){
		$data = DAO::select(["photos_galleries", "photos"], "photos.*", [new Condition("gallery_id", "=", $this->data["id"]),
																		 new Condition("photo_id", "=", "photos.id")]);
		return getAllClassArray("Photo", $data);
	}  

	public function getDesignerSignature(){
		$designer = getClassByConditions("User",["id","login", "name", "surname"], new Condition("id", "=", $this->data["user_id"]))[$this->user_id];
		return $designer->getSignature();
	}
}

class Popular extends Gallery{
	public function __construct($data) {
		parent::__construct($data);
	}

	public function allPhotos() {
		return getClassByConditions("Photo", "*", TRUE_CONDITION, ["ORDER BY favorites desc", "Limit 0,30"]);
	}

	public function getDesignerSignature() {
		return null;
	}
}
?>


