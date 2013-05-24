<?php
	session_checkstart();
?><!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>-@@pagetitle@@-</title>
  <link rel="shortcut icon" href="favicon.gif">
  <!---CSS Files-->
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/tables.css">
  <!---jQuery Files-->
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery-ui-1.8.17.min.js"></script>
  <script src="js/styler.js"></script>
  <script src="js/jquery.tipTip.js"></script>
  <script src="js/colorpicker.js"></script>
  <script src="js/sticky.full.js"></script>
  <script src="js/global.js"></script>

  <script src="js/yav.js"></script>
  <script src="js/yav-config.js"></script>

  <script src="js/jquery.dataTables.min.js"></script>
  <!---Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!--[if lte IE 8]>
  <script language="javascript" type="text/javascript" src="js/flot/excanvas.min.js"></script>
  <![endif]-->
        <?php if ($db->debug){ ?>
        <link href="css/db/database.css" rel="stylesheet">
        <script src="js/database.js"></script>
        <?php } ?>
        <script src="js/yav-config.js"></script>
        <script src="js/yav.js"></script>
        
</head>
<body>

  <!--- HEADER -->

	<div class="header">
   <a href="dashboard.html"><img src="img/logo.png" alt="Logo" /></a> 
   <div class="styler">
     <ul class="styler-show">
       <li><div id="colorSelector-top-bar"></div></li>
       <li><div id="colorSelector-box-head"></div></li>
     </ul>
   </div>
  </div>

  <div class="top-bar">
      <ul id="nav">
        <li id="user-panel">
          <img src="img/nav/usr-avatar.jpg" id="usr-avatar" alt="" />
          <div id="usr-info">
            <p id="usr-name">Welcome back, <?=$_SESSION["userinfo"]["fname"]?>.</p>
            <p id="usr-notif">You have 0 notifications. <a href="#">View</a></p>
            <p><a href="#">Preferences</a><a href="index.php?route=users&uid=<?=$_SESSION["userinfo"]["id"]?>">Profile</a><a href="?route=logout">Log out</a></p>
          </div>
        </li>
        <li>
        <ul id="top-nav">
         <li class="nav-item">
           <a href="index.php"><img src="img/nav/dashboard.png" alt="" /><p>Dashboard</p></a>
         </li>
         
         <?php if(hasright("v_User") && hasright("v_User Group")){ ?>
         <li class="nav-item">
           <a href="index.php?route=users"><img src="img/nav/user_male.png" alt="" /><p>Users</p></a>
           <ul class="sub-nav">
            <li><a href="index.php?route=users">Users</a></li>
            <li><a href="index.php?route=user_groups">User Groups</a></li>
          </ul>
         </li>
         <?php } ?>
         
         <li class="nav-item">
            <a href="#"><img src="img/nav/settings.png" alt="" /><p>Setups</p></a>
            <ul class="sub-nav">
                <li><a href="index.php?route=customers">Customers</a></li>
                <li><a href="index.php?route=location">Locations</a></li>
                <li><a href="index.php?route=country">Countries</a></li>
            </ul>
         </li>
         <li class="nav-item">
           <a href="index.php?route=calendar_log"><img src="img/nav/calendar.png" alt="" /><p>Calendar</p></a>
         </li>
         <li class="nav-item">
           <a href="widgets.html"><img src="img/nav/widgets.png" alt="" /><p>Widgets</p></a>
         </li>
         <li class="nav-item">
           <a href="grid.html"><img src="img/nav/grid.png" alt="" /><p>Grid</p></a>
           <ul class="sub-nav">
            <li><a href="#">12 Columns</a></li>
            <li><a href="#">16 Columns</a></li>
          </ul>
         </li>
         <li class="nav-item">
           <a href="filemanager.html"><img src="img/nav/flm.png" alt="" /><p>File Manager</p></a>
         </li>
         <li class="nav-item">
           <a href="gallery.html"><img src="img/nav/gal.png" alt="" /><p>Gallery</p></a>
         </li>
         <li class="nav-item">
           <a href="icons.html"><img src="img/nav/icn.png" alt="" /><p>Icons</p></a>
         </li>
         <li class="nav-item">
           <a href="#"><img src="img/nav/err.png" alt="" /><p>Error Pages</p></a>
           <ul class="sub-nav">
            <li><a href="403.html">403 Page</a></li>
            <li><a href="404.html">404 Page</a></li>
            <li><a href="503.html">503 Page</a></li>
          </ul>
         </li>
         <li class="nav-item">
           <a href="typography.html"><img src="img/nav/typ.png" alt="" /><p>Typography</p></a>
         </li>
       </ul>
      </li>
     </ul>
  </div>

  <!--- CONTENT AREA -->

  <div class="content container_12">

<?php 
session_checkstart();
if(isset($_SESSION["userinfo"])){ 
?>

<?php } ?>