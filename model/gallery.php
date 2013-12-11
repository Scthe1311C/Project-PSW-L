<?php
	class Gallery extends Data {

	public function allPhotos(){
		$data = DAO::select(["photos_galleries", "photos"], "photos.*", [new Condition("gallery_id", "=", $this->data["id"]),
																		 new Condition("photo_id", "=", "photos.id")]);
		return getAllClassAssoc("Photo", $data);
	}  

	public function getDesignerSignature(){
		$designer = getClassByConditions("User",["login", "name", "surname"], new Condition("id", "=", $this->data["user_id"]))[0];
		return $designer->getSignature();
	}
}

class Popular extends Gallery{
	public function __construct($data) {
		parent::__construct($data);
	}

	public function allPhotos() {
		return getClassByConditions("Photo", "*", new Condition(1,"=",1), ["ORDER BY favorites desc", "Limit 0,30"], ASOC_ARRAY);
	}

	public function getDesignerSignature() {
		return null;
	}
}
?>


