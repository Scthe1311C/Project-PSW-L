<?php
class Photo extends Data {

	public function allComments(){
		return getObjectsByConditions("Comment", new Condition($this->data["id"], "=", "comments.photo_id"));
	}
}
?>
