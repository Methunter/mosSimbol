<?php
require("config.php");

class msbMysqli extends mysqli{

	private $tableName;
	public $phpsessid;
	public $nameFoDb;


	
	function __construct($tablename){
		$link = parent::mysqli_init();

		$link = parent::mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME)or die("Error " . mysqli_error($link));;
		if ($link->connect_error) {
			die('Ошибка подключения (' . $link->connect_errno . ') '.$link->connect_error);
			}
		else{
			$this->tableName = $tablename;
			$this->nameFoDb = DB_NAME;
			$this->phpsessid = $_COOKIE['PHPSESSID'];
		}
	}
	
	public function makeOrder($pathToFolder){
			echo "base name is: ".$this->nameFoDb."\n";
			$posession=end(explode("/", $pathToFolder));
 			$isThisField=self::isThisField($posession);
 			echo "
 			Path: $pathToFolder
 			Tablename: ".$this->tableName."
 			Possession: $posession
 			isThisField: ".var_dump($isThisField)."\n";
			$fields=["item","quanr","PHPSID","preview"];
			$data =[ "'".$posession."'",1, "'".$db->phpsessid."'",	"'i add it late, when i\'ll make corresponding table'"	];
			if(!$isThisField){
				self::insInTbl($fields, $data);
			}else{
				for($i=0; $i!== count($posession);$i++){
					echo "test" . $posession[$i];
					$res = $db->fieldUpdate($posession[$i], $quantity[$i]);
				
				}
			}
 		 }
	function insInTbl($fields,$data){
		$fields = implode($fields, ",");
		$data = implode($data, ",");
		$result=parent::query(parent::real_escape_string("INSERT INTO ".$this->tableName
				." (".$fields.") VALUES (".$data.");")); //"INSERT INTO ".$this->tblname." (".$fields.") VALUES (".$data." ) ;");
							//	 INSERT INTO orderTest (item, quanr, PHPSID, preview) VALUES ('Долг Честь Отечество',1488,'ME3SA','i add it late, when i\'ll make corresponding table');
		if(!$result){	
			die('Ошибка запроса (' . $result->connect_errno . ') '.$$result->connect_error);
		}
		$raw=mysql_fetch_array($result);
		//mysql_close($this->connection);
		//mysql_free_result($result);
		self::close_connection();
	 }
	public function isThisField($name){
		$query = parent::real_escape_string("SELECT * FROM ".$this->tableName.
				" WHERE item='".$name.
				"' AND PHPSID='".$this->phpsessid."';");
		/*echo "query: ".$query."\n";*/
		// $result= mysqli_affected_rows(mysql_query($query));
		return  $result==0?false:true;
		parent::query("SELECT * FROM ".$this->tableName.
		" WHERE item='".$name.
		"' AND PHPSID='".$this->phpsessid."';");
		printf("Затронутые строки (INSERT): %d\n"
			, $link->affected_rows);
		mysql_free_result($result);
		//self::close_connection();
		/*
			$result= mysql_query("SELECT * FROM ".$this->tableName." WHERE item=".$name.";");
			$raw=mysql_fetch_array($result);
			return $raw;
		*/
	 }
	function showPurchases(){
			$result=mysql_query("select item, quanr from orderTest orderTest where PHPSID='".$this->phpsessid."';") ;
			if(!$result){	
				die("Database SELECT $fields FROM < $this->tableName > query failed: " . mysql_error());
			}
			while($raw=mysql_fetch_array($result)){
					echo 	"<ul class=\"position\">
								<li class = \"purchItem\">
									$raw[0]
								</li>
								<li class=\"lessPurch\">
								</li>
								
								<li class=\"purchQuant\" contenteditable=\"true\">
									$raw[1]
									
								</li>
								<li class=\"morePurch\">
								</li>
								</li>
								<li class=\"cancelPurch\">
								</li>
							</ul>";	
			}
			return $raw;
			echo gettype($raw);
		 }
}




?>