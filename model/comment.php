<?php
class Comment extends Data{
	
	public function getWriter(){
		return DatabaseManager::getClassById("User", $this->user_id);
	}
}
?>
