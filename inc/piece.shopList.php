<?php

include("class.database.php");
	$user=new Database("users");
	$currentUser =$_COOKIE[PHPSESSID];
	$purchase=$user->sendQuery("select * from orderTest where PHPSID = \"".$currentUser."\";");
		echo "<div id=shopList>";	
			while($raw=mysql_fetch_array($purchase)){
				echo "
					<span id=\"".$raw['item']."\" class=\"position\">"
						.$raw['item']."
					 </span>	
					 <input value=\"".$raw['quanr']."\"  rows=\"1\" name=\"quantity\" maxlength=\"7\" cols=\"4\" type=\"number\" name=\"quantity\" id=\"quantity\" pattern=\"d\[0-9999]\"  required>
	"."<br />" ;
			}
		echo "</div>";
?>