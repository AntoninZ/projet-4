<?php

function connect(){
		
		$db = new PDO('mysql:host=localhost;dbname=projet4', 'root', '');   
		return $db;
	
}
?>