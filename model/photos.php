<?php

class Photo {
	private $data;

	function __construct($data) {
		$this->data = $data;
	}

	public function __get($name) {
		return $this->data[$name];
	}

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
