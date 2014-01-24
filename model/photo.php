<?php
class Photo extends Data {

	public function allComments(){
		return getObjectsByConditions("Comment", new Condition($this->data["id"], "=", "comments.photo_id"));
	}
	
	public function getThumbnail(){
		return $this->thumbnail_link==NULL ? $this->link : $this->thumbnail_link;
	}
}
?>
