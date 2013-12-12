<?php

define("TRUE_CONDITION", new Condition("1","=","1"));

interface IDAO {
	public static function selectAll($tableName);
	public static function insert($tableName, $data);
	public static function select($tablesNames, $columns, $conditions, $additionals);
	public static function update($tableName, $data, $conditions);   
	public static function executeQuery($sql);
}

class DAO implements IDAO{
	public static function insert($tableName, $data) {
		 $sql    = "INSERT INTO ".$tableName." (";
		 $values = "VALUES(";
		 foreach ($data as $column => $value){
			$sql    .=$column.", ";
			$values .="'".$value."', ";
		 }
		 $sql     = substr($sql, 0, -2);
		 $values  = substr($values, 0, -2);
		 $sql    .=")";
		 $values .=")";
		 $sql    .= "\n".$values; 
		// print_r($sql);
		 return DAO::executeQuery($sql);
	} 


	public static function select($tablesNames, $columns, $conditions, $additionals=[]) {
		$tablesNames = is_array($tablesNames)? $tablesNames : [$tablesNames];
		$columns = is_array($columns)? $columns : [$columns];
		$conditions = is_array($conditions)? $conditions : [$conditions];
		$additionals = is_array($additionals)? $additionals : [$additionals];
		$sql         = "SELECT ";
		foreach ($columns as $col){
			$sql .=$col.", ";
		}
		$sql  = substr($sql, 0, -2);
		
		$sql .=" FROM ";
		foreach ($tablesNames as $tName){
			$sql .= $tName.", "; 
		}
		$sql  = substr($sql, 0, -2);
		
		$sql .= DAO::generateConditions($conditions);
		if(isset($additionals)){
			foreach ($additionals as $addition){
				$sql .= "\n".$addition;
			}
		}
	   //print_r($sql);
		$resource   = DAO::executeQuery($sql);
		$dataTable  = [];
		while($data = mysql_fetch_assoc($resource)){
			$dataTable[] = $data;
		}
		return $dataTable;
	}

	public static function selectAll($tableName) {
		return DAO::select($tableName,["*"], TRUE_CONDITION,NULL);
	}

	public static function update($tableName, $data, $conditions) {
		 $conditions = is_array($conditions)? $conditions : [$conditions];
		 $sql  = "UPDATE ".$tableName;
		 $sql .= "\nSET ";
		 foreach ($data as $column => $value){
			$sql .=$column."='".$value."', ";        
		 }
		 $sql  = substr($sql, 0, -2);
		 $sql .= DAO::generateConditions($conditions);
		// print_r($sql);
		 return DAO::executeQuery($sql);
	}
	
	public static function executeQuery($sql){
		include '/connection.php';
		return mysql_query($sql, $sql_conn);
	}

		private static function generateConditions($conditions){
			$where ="\nWHERE ";
			foreach ($conditions as $con){
				$where .=$con." and ";
			}        
			$where = substr($where, 0, -5);
			return $where;
			}
		}

class Condition{
	private $left;
	private $oper;
	private $right;
	
	public function __construct($left="1", $oper="=", $right="1") {
		$this->left  = $left;
		$this->oper  = $oper;
		$this->right = $right;
	}

	public function __toString() {
		return $this->left." ".$this->oper." ".$this->right;
	}	
}	
	
//*****************
//TESTS
//******************
//print_r(DAO::selectAll("Users"));
//print_r(DAO::select(["photos"],["id"], [new Condition("id",">=","1"),new Condition("id","<","3")]));
//print_r(DAO::select(["photos", "photos_galleries"],["photos.name"], [new Condition("gallery_id","=","2"),new Condition("photos.id","=","photo_id")]));
// $data = [
//     "user_ida" =>1, 
//     "photo_id" =>2,
//     "title"=>"Test_ins", 
//     "text"=>"AAAAAA",
//     "date_and_time"=>date('Y-m-d h:i:s', time())
//     ];
// print_r($data);
// print_r("dddd".DAO::insert("comments", $data));

// $data2 = [
//     "text"=>"ABC",
//     "date_and_time"=>date('Y-m-d h:i:s', time())
//     ];
// 
//     print_r(DAO::update("comments", $data2, [new Condition("id","=","6")]))
?>