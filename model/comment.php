<?php
class Comment extends Data{
	
	public function getWriter(){
		return getObjectById("User", $this->user_id);
	}
}
?>
