<?php
class Photo extends Data {

	public function allComments(){
		return DatabaseManager::getClassByConditions("Comment", "*",new Condition($this->data["id"], "=", "comments.photo_id"));
	}
}
?>
