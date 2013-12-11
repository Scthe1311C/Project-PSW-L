<?php
class Photo extends Data {

	public function allComments(){
		return getClassByConditions("Comment", "*",new Condition($this->data["id"], "=", "comments.photo_id"));
	}
}
?>
