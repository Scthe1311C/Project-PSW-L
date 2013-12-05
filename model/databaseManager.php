<?php
$includedFiles = ["DAO", "data", "address", "comment", "gallery", "photo", "user"];
foreach ($includedFiles as $file){
	include $file.".php";
}

interface IDatabaseManager {
	public static function getAllClass($className);
	public static function getClassById($className, $id);
	public static function getClassByConditions($className,$columns,$conditions, $additions, $arrayType);
}
class DatabaseManager implements IDatabaseManager {
	const POPULAR_GALLARY_ID = 1;
	const ASOC_ARRAY = 1;
	const DEFAULT_ARRAY = 2;
	private static $class_tables = [
									"Address" => "addresses",
									"Comment" => "comments",
									"Gallery" => "galleries",
									"Popular" => "galleries",
									"Photo"   => "photos",
									"User"	  => "users"
									];
	
	public static function getAllClass($className) {
		return DatabaseManager::getClassByConditions($className, "*", new Condition("1","=","1"));
	}

	public static function getClassById($className, $id) {
		return DatabaseManager::getClassByConditions($className,"*",new Condition("id", "=", $id))[0];
	}
	
	public static function getClassByConditions($className,$columns,$conditions, $additions=[],$arrayType=DatabaseManager::DEFAULT_ARRAY){
		$data = DAO::select(DatabaseManager::$class_tables[$className], $columns, $conditions, $additions);
		if(empty($data)) return [];
		return $arrayType = DatabaseManager::DEFAULT_ARRAY?
				DatabaseManager::getAllClassArray($className, $data):
				DatabaseManager::getAllClassAssoc($className, $data);		
	}
	
	private static function getClass($className, $data){
		switch ($className){
			case "Address": return new Address($data);
			case "Comment": return new Comment($data);
			case "Gallery": if($data["id"] == DatabaseManager::POPULAR_GALLARY_ID)
								return new Popular($data);
							else
								return new Gallery($data);
			case "Popular": return new Popular($data);
			case "Photo"  :	return new Photo($data);
			case "User"   : return new User($data);
			default		  : throw  new Exception("Class not found!");
		}
	}
	
	static function getAllClassArray($className, $dataTab){
		$class = [];
		foreach ($dataTab as $data){
			$newClass = DatabaseManager::getClass($className, $data);
			$class[]=$newClass;
		}
		return $class;
	}
	
	static function getAllClassAssoc($className, $dataTab){
		$class = [];
		foreach ($dataTab as $data){
			$newClass = DatabaseManager::getClass($className, $data);
			$class[$newClass->id]=$newClass;
		}
		return $class;
	}

}
//$p1 = DatabaseManager::getClassById("Photo", "1");
//print_r($p1);
//print_r (DatabaseManager::getAllClass("Photo"));
//print_r (DatabaseManager::getClassById("Gallery", "1"));
?>
