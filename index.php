<?php
$dcheck =  "dredix";

require("config.php");
include("inc_mainfunction.php");
//require_once('lib/ajaxCRUD/preheader.php');
require 'zebra_form/Zebra_Form.php';
require 'lib/db/Zebra_Database.php';
require 'lib/Database.php';
require_once("lib/phpmyedit/phpMyEdit.class.php");

$f_return = "";		//Used to determine is a php redirect should be done, the url is store here

$db = new Zebra_Database();
$db->debug = DODEBUG;
$db->connect(DBHOST, DBUSER, DBPASS, DBNAME);

if(DODEBUG){
	$odb = Database::obtain(DBHOST, DBUSER, DBPASS, DBNAME);
	$odb->connect();
}




//Checking route and displaying page
if(isset($_REQUEST["route"]) && loadroute($_REQUEST["route"])){}
elseif(loadroute("home")){}
else{echo "No route !!!!";}
