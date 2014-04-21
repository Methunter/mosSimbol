<?php
	require("config.php");
	class msbMysqli {

		private $tableName;
		public $phpsessid;
		public $nameFoDb;
		public $mysqli;
		public $mas=array();
		public $dbh;

		// function __construct($tablename){
		// 	try {
		// 		$this->dbh = new PDO(PDO_DSN, DB_USER, DB_PASS);
		// 	} catch (PDOException $e) {
		// 		echo 'Подключение не удалось: ' . $e->getMessage();
		// 	 }
		// 	 $this->phpsessid = $_COOKIE['PHPSESSID'];
		// 	 $this->tableName = $tablename;
		//  }

		public function makeOrder($pathToFolder){
				echo "I AM in order!!!!!!";
				$fields = array();
				$data=array();
				$posession= /*basename($pathToFolder)/*/end(explode("/", $pathToFolder));
	 			$isThisField=self::isThisField($posession);
	 			// echo $isThisField;
	 			    echo "
		 			Path: $pathToFolder
		 			Tablename: ".$this->tableName."
		 			Possession: $posession
		 			isThisField: ".print_r($isThisField)."\n";
	 			 
				$fields=["item","quantity","PHPSID","preview"];
				$data =[ "'".$posession."'",1, "'".$this->phpsessid."'",
				"'i add it late, when i\'ll make corresponding table'"	];
				if($isThisField){
					echo "insert in table: ";
					self::insInTbl($fields, $data);
				}else{
					for($i=0; $i!== count($posession);$i++){
						$res = $this->fieldUpdate( $posession[$i] , $quantity[$i]);
					}
						echo "TEST" ;
				}
	 	 }
		function insInTbl($fields,$data){
			echo "I'M IN TAbLE";
			$fields = implode($fields, ",");
			$data = implode($data, ",");
			$query = "INSERT INTO ".$this->tableName." (".$fields.") VALUES (".$data.");";
			try{
			$result=$this->dbh->exec($query); 			
			}
			catch(PDOException $e) {
				echo 'Внесение данных не удалось:  ' . $e->getMessage();
			 }
			// $result->execute($query); 
			if(!$result){	
				echo "NOT RESULT";
				die('Ошибка запроса на добавление записи (' . $this->mysqli->connect_errno . ') '.$this->mysqli->connect_error);
			}else{	
				echo "just fine!";
			}
			$raw=$result->affected_rows;
		 }
		public function isThisField($name){
		  	$query  = "SELECT * FROM "
				.$this->tableName.
				" WHERE item='".$name.
				"' AND PHPSID='".$this->phpsessid."';";
			$sth = $this->dbh->prepare($query);
			 $sth->execute();
			$result = $sth->rowCount();
			echo $result;
			if (!$result) {
				echo "не result";
				return true;
			}else{
				echo " result";
				return false;
			}
		 }
		/*function showPurchases(){
			$result =$this->mysqli->query("SELECT item, quantity FROM orderTest  WHERE PHPSID='".$this->phpsessid."';");
				$result=mysqli_query($this->mysqli,"select item, quantity from orderTest orderTest where PHPSID='".$this->phpsessid."';") ;
				if(!$result){	
					die("Database SELECT $fields FROM < $this->tableName > query failed: " . mysql_error());
				}
				while($raw=$mysqli->affected_rows){
						echo 	
						"<ul class=\"position\">
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

							<li class=\"cancelPurch\">
							 </li>
						</ul>";	
				 }
				 return $raw;
			 // echo gettype($raw);
		 }
		 */
		function showPurchases() {
			$sql = "SELECT item, quantity FROM 
				orderTest  WHERE PHPSID=
				'".$this->phpsessid."';";
			try {
				$stmt = $this->dbh->prepare($sql);
				$stmt->execute();
				/* Связывание по номеру столбца */
				$stmt->bindColumn(1, $item);
				/* Связывание по имени столбца */
				$stmt->bindColumn('quantity', $quontity);
				while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
					$data ="<ul class=\"position\">
								<li class = \"purchItem\">
									$item
								 </li>
								<li class=\"lessPurch\">
								 </li>
								<li class=\"purchQuant\" contenteditable=\"true\">
									$quontity
								 </li>
								<li class=\"morePurch\">
								 </li>

								<li class=\"cancelPurch\">
								 </li>
							</ul>";	/* "item: ".$item . "\t" . $quontity . "\n"*/
					// print $data;
				 }
			 }
			catch (PDOException $e) {
				print ($e->getMessage());
			 }
		 }
		public function fieldUpdate($posession, $quantity){
				$query = "UPDATE  ".$this->tableName.
					" SET quantity=".$quantity.
					" WHERE item=".$posession."
					 AND PHPSID='".$this->phpsessid."';";	// quanr=quanr+$quantity - 
				/*if ($stmt = $this->dbh->prepare($query)) {
					
				 }*/
					/* close statement */
					/*$stmt->close();*/
				$result=$this->dbh->prepare($query) ;xdebug_break(); //TODO: убрать дебаг	
				$result->execute();
		 }
		public function deleteRaw($name){
			
			$this->dbh->exec("DELETE  FROM ".
			$this->tableName . " WHERE item='".
			$name."' AND PHPSID= '".
			$this->phpsessid."' ;");
			print("Удалено $count строк.\n");

		 }
	}
?>