<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	if(isset($_REQUEST["custid"])){
		$db->query("SELECT `companyb`, `attentionb`, `addressb`, `address2b`, `cityb`, `zipcodeb`, `companys`, `attentions`, `addresss`, `address2s`, `citys`, `zipcodes`, stateb, states FROM customers WHERE id = ".$db->escape($_REQUEST["custid"]));
		$srecords = $db->fetch_assoc_all();
		echo json_encode($srecords[0]);
	}
	
	/*
	foreach($srecords as $srow){
		echo "\n\t<option value=\"".$srow["id"]."\">".$srow["title"]."</option>";
	}*/