<?php
    //	http://api.clickatell.com/http/sendmsg?user=adixon&password=PASSWORD&api_id=3424919&to=18764204881&text=Message
	$user = "adixon";
    $password = "NEEZaUgTfBDHMK";
    $api_id = "3424919";
    $baseurl ="http://api.clickatell.com";
 
    $text = urlencode("This is an example message - Clickatell");
    $to = "8764204881";
 
    // auth call
    $url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text";
	//$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
 die($url);
    // do auth call
    $ret = file($url);
 
    // explode our response. return string is on first line of the data returned
    $sess = explode(":",$ret[0]);
    if ($sess[0] == "OK") {
 
        $sess_id = trim($sess[1]); // remove any whitespace
        $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
 
        // do sendmsg call
        $ret = file($url);
        $send = explode(":",$ret[0]);
 
        if ($send[0] == "ID") {
            echo "successnmessage ID: ". $send[1];
        } else {
            echo "send message failed";
        }
    } else {
        echo "Authentication failure: ". $ret[0];
    }
?>