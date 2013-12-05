<?php
	class Gallery extends Data {

	public function allPhotos(){
		$data = DAO::select(["photos_galleries", "photos"], "photos.*", [new Condition("gallery_id", "=", $this->data["id"]),
																		 new Condition("photo_id", "=", "photos.id")]);
		return DatabaseManager::getAllClassAssoc("Photo", $data);
	}  

	public function getDesignerSignature(){
		$designer = DatabaseManager::getClassByConditions("User",["login", "name", "surname"], new Condition("id", "=", $this->data["user_id"]))[0];
		return $designer->getSignature();
	}
}

class Popular extends Gallery{
	public function __construct($data) {
		parent::__construct($data);
	}

	public function allPhotos() {
		return DatabaseManager::getClassByConditions("Photo", "*", new Condition(1,"=",1), ["ORDER BY favorites desc", "Limit 0,30"], DatabaseManager::ASOC_ARRAY);
	}

	public function getDesignerSignature() {
		return null;
	}
}
?>


