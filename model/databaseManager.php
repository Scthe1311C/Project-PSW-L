<?php
	$includedFiles = ["DAO", "data", "address", "comment", "gallery", "photo", "user"];
	foreach ($includedFiles as $file) {
		include $file . ".php";
	}
	
	const POPULAR_GALLARY_ID = 1;
	const ASOC_ARRAY = 1;
	const DEFAULT_ARRAY = 2;
	
	$class_tables = [
		"Address" => "addresses",
		"Comment" => "comments",
		"Gallery" => "galleries",
		"Popular" => "galleries",
		"Photo" => "photos",
		"User" => "users"
	];

function getAllClass($className) {
	return getClassByConditions($className, "*", new Condition("1", "=", "1"));
}

function getClassById($className, $id) {
	return getClassByConditions($className, "*", new Condition("id", "=", $id))[0];
}

function getClassByConditions($className, $columns, $conditions, $additions = [], $arrayType = DEFAULT_ARRAY) {
	global $class_tables;
	$data = DAO::select($class_tables[$className], $columns, $conditions, $additions);
	if (empty($data))
		return [];
	return $arrayType = DEFAULT_ARRAY ?
			getAllClassArray($className, $data) :
			getAllClassAssoc($className, $data);
	}

	function getClass($className, $data) {
		switch ($className) {

			case "Gallery": if ($data["id"] == POPULAR_GALLARY_ID)
					return new Popular($data);
				else
					return new Gallery($data);
			default : return new $className($data);
		}
	}

	function updateClassByConditions($object, $newData, $conditions) {
		global $class_tables;
		$object->setData($newData);
		DAO::update($class_tables[get_class($object)], $newData, $conditions);
	}

	function insertClass($className, $data) {
		global $class_tables;
		$class = getClass($className, $data);
		DAO::insert($class_tables[$className], $data);
		return $class;
	}

	function getAllClassArray($className, $dataTab) {
		$class = [];
		foreach ($dataTab as $data) {
			$newClass = getClass($className, $data);
			$class[] = $newClass;
		}
		return $class;
	}

	function getAllClassAssoc($className, $dataTab) {
		$class = [];
		foreach ($dataTab as $data) {
			$newClass = getClass($className, $data);
			$class[$newClass->id] = $newClass;
		}
		return $class;
	}

//$p1 = getClassById("Photo", "1");
//print_r($p1);
//print_r (getAllClass("Photo"));
//print_r (getClassById("Gallery", "1"));
?>
