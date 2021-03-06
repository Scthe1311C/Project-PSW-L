<?php
class Gallery extends Data {
	
	protected $photoCache;

	public function allPhotos(){
		if($this->photoCache == NULL)
			$this->photoCache = getAllPhotosFromGallery($this->id);
		return $this->photoCache;
	}

	public function getThumbnail(){
		return count($this->allPhotos()) > 0 ? current( $this->allPhotos())->getThumbnail() : "src/img/folder-img2.png";
	}
	
	public function getDesignerSignature(){
		$designer = getObjectsByConditions("User", new Condition("id", "=", $this->data["user_id"]))[$this->user_id];
		return $designer->getSignature();
	}
}

class Popular extends Gallery{
	public function __construct($data) {
		parent::__construct($data);
	}

	public function allPhotos() {
		return getObjectsByConditions("Photo", TRUE_CONDITION, ["ORDER BY favorites desc", "Limit 0,30"]);
	}

	public function getDesignerSignature() {
		return null;
	}
}
?>


