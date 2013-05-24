<?php
if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");

function logincheck(){
	if(!isset($_SESSION["userinfo"])){header("location:login.php");}
}

function loadroute($routename){
	//Used to manager how files are loaded for display
	global $db, $f_return;
	if(DODEBUG){global $odb;};
	
	session_checkstart();
	
	$outval = false;
	if(isset($_REQUEST["pagetype"]) && $_REQUEST["pagetype"] == "ajax"){
		//Is an AJAX page
		if(file_exists("views/".$routename.".php")){
			include("views/".$routename.".php");
			$outval = true;
		}
	}else{
		//Not an ajax page
		if(file_exists("proc/".$routename.".php")){
			include("proc/".$routename.".php");
		}
		
		if(isset($f_return) && $f_return != ""){
			
			header( 'Location: '.$f_return ) ;
			session_write_close();
			exit;
		}
		
		if(file_exists("views/".$routename.".php")){
			ob_start();
			include("theme/top.php");
			include("theme/notify.php");
			include("views/".$routename.".php");
			if ($db->debug){$db->show_debug_console();}
			include("theme/bottom.php");
			$the_page =  ob_get_contents();
			ob_end_clean();
			$outval = true;
	
			$the_page = str_replace("-@@pagetitle@@-", $pagetitle, $the_page);
			echo $the_page;
			
		}else{
			ob_start();
			include("theme/top.php");
			include("views/404.php");
			if ($db->debug){$db->show_debug_console();}
			include("theme/bottom.php");
			$the_page =  ob_get_contents();
			ob_end_clean();
			$outval = true;
	
			$the_page = str_replace("-@@pagetitle@@-", $pagetitle, $the_page);
			echo $the_page;
		}
	}
	return $outval;
}

function session_checkstart(){
	//Used to determine is session has been started and if not, start it.
	if(session_id() == '') {
		session_start();
	}
}

function show_results(){
	if(isset($_REQUEST)){
		foreach($_REQUEST as $fkey => $fvalue){
			echo "$fkey : $fvalue<br />";
		}
	}
}

function inputarray($val, $display, $fields, $table, $where = "", $order = ""){
	
	global $db;
	$db->select($fields,$table, $where,"");
	$records = $db->fetch_assoc_all();
	foreach($records as $row){
		$rdata[$row[$val]] = $row[$display];
	}
	return $rdata;
}

function checkset(&$inval, $default = ''){
	//Used to check is a variable is set and returns the vale if it is
	if(isset($inval)){
		return $inval;
	}else{
		return $default;	
	}
}

function order_informsupport($accmanagerid,$po_number){
	//Used to send  the email to the sales person.
	global $db;
	$db->query('SELECT * FROM users WHERE ID = '.$accmanagerid);
	$records = $db->fetch_assoc_all();
	if(count($records) > 0){
		if($records[0]["salesperson_id"] > 0){
			$accman_name = $records[0]["fname"]." ".$records[0]["lname"];
			$salesid = $records[0]["salesperson_id"];
			//Getting sales persons informartion
			$db->query('SELECT * FROM users WHERE ID = '.$salesid);
			$records = $db->fetch_assoc_all();
			if($records[0]["email"] != ""){
				$salesname = $records[0]["fname"]." ".$records[0]["lname"];
				//Sending email
				$to = $records[0]["email"];
				$subject = "New Order Assigned - $po_number";
				$body = "Hello $salesname,
A new order has been assigned to you.

Detail:
Account Manager: $accman_name
Customer PO #: $po_number

Please login to access the record.
				";
				if (mail($to, $subject, $body)) {
					return true;
				} else {
					return false;
				}
			}else{return false;}
		}else{return false;}
	}else{return false;}
}

function order_informsales($oid){
	//Used to send  the email to the sales person.
	global $db;
	$db->query("SELECT *, (SELECT concat(fname, ' ', lname) FROM users u where u.id = o.supportperson_id) as SuppName FROM orders o WHERE id = " . $db->escape($oid));
    $orders = $db->fetch_assoc_all();		//Getting record information
	$order = $orders[0];		//Getting record information
	$db->query('SELECT * FROM users WHERE ID = '.$order["accountmanager"]);
	$records = $db->fetch_assoc_all();

	if($records[0]["email"] != ""){
		$salesname = $records[0]["fname"]." ".$records[0]["lname"];
		//Sending email
		$to = $records[0]["email"];
		$subject = "Order Number Assigned By Support - ".$order["id"];
		$body = "Hello $salesname,
Support has assigned an order number to an order you are managing.

Detail:
Customer PO #: ".$order["cust_po"]."
Order #: ".$order["id"]."
Stamp Date: ".$order["stamp_date"]."
Support Person: ".$order["SuppName"]."

Please login to access the record.
		";
		if (mail($to, $subject, $body)) {
			return true;
		} else {
			return false;
		}
	}else{return false;}
}



function get_supportperson($accmanagerid){
	global $db;
	$db->query('SELECT * FROM users WHERE ID = '.$accmanagerid);
	$records = $db->fetch_assoc_all();
	if(count($records) > 0){
		if($records[0]["salesperson_id"] > 0){
			$accman_name = $records[0]["fname"]." ".$records[0]["lname"];
			$salesid = $records[0]["salesperson_id"];
			//Getting sales persons informartion
			$db->query('SELECT * FROM users WHERE ID = '.$salesid);
			$records = $db->fetch_assoc_all();
			if(count($records)> 0){
				return $records[0];
			}
		}
	}
}

function mysqlnow($format = "Y-m-d H:i:s"){
	return date($format, strtotime(date($format, time())));
}

function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function mode_addedit(){
	if(isset($_REQUEST["PME_sys_operation"])){
		if($_REQUEST["PME_sys_operation"] == "PME_op_Change" || $_REQUEST["PME_sys_operation"] == "PME_op_View" || $_REQUEST["PME_sys_operation"] == "Add"){
			return true;	
		}else{
			return false;
		}
	}
}

function droplist($sql, $value_field, $name_field, $select_value = ""){
	global $db;
	$db->query($sql);
	$records = $db->fetch_assoc_all();
	if(is_array($records)){
		$list = "";
		for($x = 0; $x < count($records); $x++){
			$list .= "\n\t<option value='".$records[$x][$value_field]."'>".$records[$x][$name_field]."</option>";
		}
		return $list;
	}else{
		return "";	
	}
}

function sendsms($to_arr, $message){
	/* Send an SMS using Twilio.*/
	require "lib/sms/Services/Twilio.php";
	global $smscfg;
	
	if($smscfg["debug"] == true){
		$to_arr = array("8764204881");
	}
	if($smscfg["active"] == true){
		// Instantiate a new Twilio Rest Client
		$client = new Services_Twilio($smscfg["sid"], $smscfg["token"]);
		foreach ($to_arr as $to) {
			// Send a new outgoing SMS */
			$client->account->sms_messages->create($smscfg["from"], $to, $message);
			//echo "Sent message to $to";
		}	
	}
}

function calevent($project_id, $title, $description){
	global $db;
	$ce["project_id"] = $project_id;
	$ce["title"] = $title;
	$ce["description"] = $description;
	$ce["date_created"] = mysqlnow();
	$ce["created_by"] = $_SESSION["userinfo"]["id"];
	
	$db->insert('calendar_events',$ce);
}

function addmsg($message, $type = 'i'){
	$_SESSION["notify"][$type][] =  $message;
}

function hasright($rightname){
	//Used to check if the user has a specific permission
	$outval = false;
	if(isset($_SESSION["userinfo"]["user_rights"])){
		if(count($_SESSION["userinfo"]["user_rights"]) > 0){
			if(in_array($rightname,$_SESSION["userinfo"]["user_rights"])){
				$outval = true;
			}
		}
	}
	
	return $outval;
}