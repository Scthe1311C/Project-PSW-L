<?php
class Comment extends Data{
	
	public function getWriter(){
		return getClassById("User", $this->user_id);
	}
}
?>
