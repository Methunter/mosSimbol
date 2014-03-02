<?php

	class Database{
	//require_once("dbconnection.php");
	//private $host = $_SERVER["SERVER_NAME"];
	private $username="root";
	private $password="love";
	protected $dbname;
	protected $tblname;
	
	public $connection;
	
		function setTable($dbname, $tblname){
			$this->dbname=$dbname;
			$this->tblname=$tblname;
		}
	
		function fetchDatabase($query, $vararr){
			$this->connection=mysql_connect($_SERVER["SERVER_NAME"],$this->username,$this->password);
			if(!$this->connection){
				die("no connection:( " . mysql_error()); 
			}
			$dbSelect=mysql_select_db($this->dbname,$this->connection);
			if(!$dbSelect){
				die("Database selection failed" . mysql_error());
			}
			switch($query){
				case "selectAll":
				case "select all":
				case "select All":
				case "selal":
				case "selall":
					$query="SELECT * FROM";
					break;
				case "crdb":
				case "create database":
				case "createDatabase":
					$query = "CREATE DATABASE";
					break;

			}
			$result=mysql_query($query." ".$this->tblname, $this->connection);
			if(!$result){
				die("Database query failed" . mysql_error());
			}
			while($raw=mysql_fetch_array($result)){
				foreach($vararr as $entry){
					echo $raw[$entry]." ";


				}
				echo "<br />";
			}
			mysql_close($this->connection);
		}
		function insInTbl($fields,$data){
			$this->connection=mysql_connect($_SERVER["SERVER_NAME"],$this->username,$this->password);
			if(!$this->connection){
				die("no connection:( " . mysql_error()); 
			}
			$dbSelect=mysql_select_db($this->dbname,$this->connection);
			if(!$dbSelect){
				die("Database selection failed" . mysql_error());
			}
			$i=0;
			foreach($fields as $entry){
				$result[$i]=mysql_query("INSERT INTO ".$this->dename." (".$fields.") VALUES (".$data.");");
				$i++;
			}
			
			$result=mysql_query("INSERT INTO ".$this->dename." (".$fields.") VALUES (".$data.");");
			if(!$result){
				die("Database query failed: " . mysql_error());
			}
			$raw=mysql_fetch_array($result);

				
			
			mysql_close($this->connection);
		}
	}
?>