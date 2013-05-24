<?php
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	
	/*$db->connect('localhost', 'dredixne_eorders', 'TX^J=fpF[Mxk', 'dredixne_eorders');*/
	define('DBUSER', "root");
	define('DBPASS', "Abc12345");
	define('DBNAME', "purchord");
	define('DBHOST', "localhost");
	/*
	define('DBUSER', "dredixne_eorders");
	define('DBPASS', "TX^J=fpF[Mxk");
	define('DBNAME', "dredixne_eorders");
	define('DBHOST', "localhost");*/
	
	//Debug
	define('DODEBUG', false);
	
	$smscfg = array(
		"sid" 	=> 	"AC6ef6b066192af1171c7469968ac5c271",
		"token"	=> 	"d2d857435380021e3cf16df45b09e378",
		"from"	=>	"7542172510",
		"active"=> true,
		"debug"=> true
	);