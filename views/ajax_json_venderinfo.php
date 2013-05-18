<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	
	if(isset($_GET["term"])){
		$query=$_GET["term"];
		
		$db->query("SELECT `id`, `vname` FROM vendors WHERE vname like '%".$db->escape($query)."%'");
		$srecords = $db->fetch_assoc_all();		
		echo json_encode($srecords);
	}	
?>