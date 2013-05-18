<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	
	if(isset($_GET["term"])){
		$query=$_GET["term"];
		
		$db->query("SELECT *, concat(fname, ' ', lname) as value FROM customers c WHERE concat(fname, ' ', lname) like '%".$db->escape($query)."%'");
		$srecords = $db->fetch_assoc_all();		
		echo json_encode($srecords);
	}	
?>