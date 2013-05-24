<?php

if(!hasright("v_User")){
	header("HTTP/1.0 403 Forbidden");
	addmsg("You do not have permission to access this page", "w");
	$routename = "403";
}