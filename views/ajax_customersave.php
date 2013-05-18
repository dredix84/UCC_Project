<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");


	if(isset($_POST["fname"])){
		if(isset($_REQUEST["fname"])) $customers_data["fname"] = $_REQUEST["fname"];
		if(isset($_REQUEST["lname"])) $customers_data["lname"] = $_REQUEST["lname"];
		if(isset($_REQUEST["companyb"])) $customers_data["companyb"] = $_REQUEST["companyb"];
		if(isset($_REQUEST["attentionb"])) $customers_data["attentionb"] = $_REQUEST["attentionb"];
		if(isset($_REQUEST["addressb"])) $customers_data["addressb"] = $_REQUEST["addressb"];
		if(isset($_REQUEST["address2b"])) $customers_data["address2b"] = $_REQUEST["address2b"];
		if(isset($_REQUEST["cityb"])) $customers_data["cityb"] = $_REQUEST["cityb"];
		if(isset($_REQUEST["zipcodeb"])) $customers_data["zipcodeb"] = $_REQUEST["zipcodeb"];
		if(isset($_REQUEST["companys"])) $customers_data["companys"] = $_REQUEST["companys"];
		if(isset($_REQUEST["attentions"])) $customers_data["attentions"] = $_REQUEST["attentions"];
		if(isset($_REQUEST["addresss"])) $customers_data["addresss"] = $_REQUEST["addresss"];
		if(isset($_REQUEST["address2s"])) $customers_data["address2s"] = $_REQUEST["address2s"];
		if(isset($_REQUEST["citys"])) $customers_data["citys"] = $_REQUEST["citys"];
		if(isset($_REQUEST["zipcodes"])) $customers_data["zipcodes"] = $_REQUEST["zipcodes"];
		if(isset($_REQUEST["stateb"])) $customers_data["stateb"] = $_REQUEST["stateb"];
		if(isset($_REQUEST["states"])) $customers_data["states"] = $_REQUEST["states"];
		
		if ($db->insert('customers',$customers_data)){
			echo "true";
		}else{
			echo "false";
		}
		
		
		
	}?>