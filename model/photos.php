<?php
class Photo extends Data {

	public function allComments(){
		$data = DAO::select("comments", "*",new Condition($this->data["id"], "=", "comments.photo_id"), NULL);
		$comments = [];
		foreach ($data as $commentData){
			$comment = new Comment($commentData);
			$comments[]=$comment;
		}
		return $comments;
	}
}
?>
