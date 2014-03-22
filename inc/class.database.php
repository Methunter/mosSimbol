<?php
require("config.php");

	class Database{
	//require_once("dbconnection.php");
	//private $host = $_SERVER["SERVER_NAME"];
	public $connection;
	public $result;
	public $tableName;
	public $phpsessid;
	
		function __construct($tableName){
			$this->open_connection();
			$this->tableName = $tableName;
			$this->phpsessid = $_COOKIE['PHPSESSID'];
		}
//		function Database($tableName){
//			$this->open_connection();
//			$this->tableName = $tableName;
//
//		}
		public function open_connection(){
			$this->connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
			if(!$this->connection){
				die("Database connection failed: ".mysql_error());
			}
			$dbSelect=mysql_select_db("msb",$this->connection);
				if(!$dbSelect){
					die("Database selection failed" . mysql_error());
				}
		}
		public function num_rows(){
			return mysql_num_rows($result);
		}
		public function mysql_prep( $value ) {
			$magic_quotes_active = get_magic_quotes_gpc();
			$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
			if( $new_enough_php ) { // PHP v4.3.0 or higher
				// undo any magic quote effects so mysql_real_escape_string can do the work
				if( $magic_quotes_active ) { $value = stripslashes( $value ); }
				$value = mysql_real_escape_string( $value );
			} else { // before PHP v4.3.0
				// if magic quotes aren't already on then add slashes manually
				if( !$magic_quotes_active ) { $value = addslashes( $value ); }
				// if magic quotes are active, then the slashes already exist
			}
			return $value;
		}
		public function sendQuery($sql){
			$this->result = mysql_query($sql, $this->connection);
			$this->confirm_query($this->result);
			return $this->result;
		}
		private function confirm_query(){
			if(!$this->result){
				die("Database query failed: " . mysql_error());
			}
		}
		static function close_connection(){
			if(isset(self::$connection)){
				self::mysql_close($this->connection);
				unset(self::$connection);
			}
		}
		
		
		function insInTbl($fields,$data){

			$fields = implode($fields, ",");
			$data = implode($data, ",");
			$result=mysql_query("INSERT INTO ".$this->tableName." (".$fields.") VALUES (".$data.");"); //"INSERT INTO ".$this->tblname." (".$fields.") VALUES (".$data." ) ;");
								//	 INSERT INTO orderTest (item, quanr, PHPSID, preview) VALUES ('Долг Честь Отечество',1488,'ME3SA','i add it late, when i\'ll make corresponding table');
			if(!$result){	
				die("Database INSERT query failed: " . mysql_error());
			}
			$raw=mysql_fetch_array($result);
//			mysql_close($this->connection);
			mysql_free_result($result);
			self::close_connection();

		}

		function selectDB($fields){
			$result=mysql_query("SELECT ".$fields." FROM ".$this->tableName) ;
			if(!$result){	
				die("Database SELECT $fields FROM < $this->tableName > query failed: " . mysql_error());
			}
			echo "<div id=\"result\">";
			while($raw=mysql_fetch_array($result)){
				echo "<div class='resultRaw'>";
				echo 	"<div class='mysqlResult number'>".$raw[0]."</div>".
						"<div class='mysqlResult text'>".$raw[1]."</div>".
						"<div class='mysqlResult number'>".$raw[2]."</div>".
						"<div class='mysqlResult text'>".$raw[3]."</div>".
						"<div class='mysqlResult number'>".$raw[4]."</div>" ;
				echo "</div>";	

			}
			echo "</div>";
			return $result;
			mysql_free_result($result);
			self::close_connection();
			
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
		function fieldTest($name){
			$result= mysql_num_rows(mysql_query("SELECT * FROM ".$this->tableName." WHERE item=".$name." AND PHPSID='".$this->phpsessid."';"));
			return  $result;
			mysql_free_result($result);
			self::close_connection();

/*
			$result= mysql_query("SELECT * FROM ".$this->tableName." WHERE item=".$name.";");
			$raw=mysql_fetch_array($result);
			return $raw;
*/
		}
		function getRawCount(){
			$result= mysql_num_rows(mysql_query("SELECT * FROM ".$this->tableName.";"));
			return  ++$result;
			mysql_free_result($result);
			self::close_connection();

		}
		function deleteRaw($name){
			$result=mysql_query("DELETE  FROM ".$this->tableName . " WHERE item='".$name."' AND PHPSID= '".$this->phpsessid."' ;") ;//mysql> orderTestЗа Верность Отечеству
			mysql_free_result($result);
			self::close_connection();

		}
		function __destruct(){
			self::close_connection();

		}
		public function fieldUpdate($posession, $quantity){
			$sql = "UPDATE  ".$this->tableName." SET quanr=".$quantity." WHERE item=".$posession." AND PHPSID='".$this->phpsessid."';";	// quanr=quanr+$quantity - 
			$result=mysql_query($sql) ;																								//аьтернатива, для 
			while($raw=mysql_fetch_array($result)){			return $result;}				// сложения предыдущего и нового значений
			mysql_free_result($result);
			self::close_connection();

		}
		
	}//school is out
	
	
	
	
	
	
	/*
		для проверки на наличие записей нужно: 
		
			1. сделать запрос в таблицу и посмотреть наличие записей для item AND PHPSID;
			2. если существует количество записей отличное от нуля, получить количество из запроса и ALTER TABLE MODIFY *;
			3. иначе создать новую запись в таблице.
				3.1 Добавить запись *.
	*/
	
?>