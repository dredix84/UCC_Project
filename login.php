<?php
$dcheck =  "dredix";
require("config.php");
include("inc_mainfunction.php");
require 'lib/db/Zebra_Database.php';


$db = new Zebra_Database();
$db->debug = DODEBUG;
$db->connect(DBHOST, DBUSER, DBPASS, DBNAME);


if(isset($_POST["name"]) && isset($_POST["pass"])){
	$db->query("SELECT * FROM users WHERE username = '".$db->escape($_POST["name"])."' AND password = md5('".$db->escape($_POST["pass"])."')");
	$records = $db->fetch_assoc_all();
	if(count($records)){
		session_checkstart();
		$_SESSION["userinfo"] = $records[0];
		//die(print_r($_SESSION["userinfo"],true));
		session_write_close();
		header("location:index.php?route=home");
	}else{
		$status = "failed";
	}
	
}
?><!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Adminity - Login</title>
  <link rel="shortcut icon" href="favicon.gif">
  <!---CSS Files-->
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/login.css">
  <!---jQuery Files-->
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.spinner.js"></script>
  <script type="text/javascript" src="js/forms/jquery.validate.min.js"></script>
  <!---Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
    <!---FadeIn Effect, Validation and Spinner-->
  <script>
    $(document).ready(function () {
       $('div.wrapper').hide();
        $('div.wrapper').fadeIn(1200);
        $('#lg-form').validate();
        $('.submit').click(function() {
        var $this = $(this);
        $this.spinner();
        setTimeout(function() {
                $this.spinner('remove');
        }, 1000);
       });
    });
  </script>
</head>
<body>
	
	<div class="wrapper">
		<div class="logo">
	 	<h1>LOGIN PAGE</h1>
	 </div>
   <div class="lg-body">
     <div class="inner">
       <div id="lg-head">
         <p><span class="font-bold">Adminity</span>: Please login to access the control panel.</p>
         <div class="separator"></div>
       </div>
       <div class="login">
         <form id="lg-form" method="post" >
           <fieldset>
              <ul>
                 <li id="usr-field">
                  <input class="input required" name="name" type="text" size="26" minlength ="1" placeholder="Username..." />
                 </li>
                 <li id="psw-field">
                  <input class="input required" name="pass" type="password" size="26" minlength="1" placeholder="Password..." />
                 </li>
                 <li class="checkbox">
                  <input class="checkbox" type="checkbox" id="remember-me" value="remember" /> 
                  <label for="remember-me" class="checkbox-text">Remeber Me</label>
                 </li>
                 <li>
                  <input class="submit" type="submit" value=""/>
                 </li>
              </ul>
           </fieldset>
          </form>
        
          <span id="lost-psw">
           <!--<a href="#">I forgot my password</a> -->
          </span>
        </div>
        
     </div>
     
    </div>
<?php if(isset($status) && $status == "failed"){ ?>
<div class="ad-notif-error grid_12 small-mg" style="width:97%; margin-top: 10px">
<p><strong>Login failed:</strong> Please check your username and password</p>
</div>  
<?php } ?>
	</div>
    
</body>

</html>