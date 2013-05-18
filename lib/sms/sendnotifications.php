<?php
	/* Send an SMS using Twilio. You can run this file 3 different ways:
	 *
	 * - Save it as sendnotifications.php and at the command line, run 
	 *        php sendnotifications.php
	 *
	 * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
	 *   in a web browser.
	 * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
	 *   directory to the folder containing this file, and load 
	 *   localhost:8888/sendnotifications.php in a web browser.
	 */
	// Include the PHP Twilio library. You need to download the library from 
	// twilio.com/docs/libraries, and move it into the folder containing this 
	// file.
	require "Services/Twilio.php";
	
	// Set our AccountSid and AuthToken from twilio.com/user/account
	$AccountSid = "AC6ef6b066192af1171c7469968ac5c271";
	$AuthToken = "d2d857435380021e3cf16df45b09e378";

	// Instantiate a new Twilio Rest Client
	$client = new Services_Twilio($AccountSid, $AuthToken);

	/* Your Twilio Number or Outgoing Caller ID */
	$from = '7542172510';

	// make an associative array of server admins. Feel free to change/add your 
	// own phone number and name here.
	$people = array(
		"8764204881" => "Andre",
		/*"4158675310" => "Helen",
		"4158675311" => "Virgil",*/
	);

	// Iterate over all admins in the $people array. $to is the phone number, 
	// $name is the user's name
	foreach ($people as $to => $name) {
		// Send a new outgoing SMS */
		$body = "Bad news $name, the server is down and it needs your help";
		$client->account->sms_messages->create($from, $to, $body);
		echo "Sent message to $name";
	}
?>
