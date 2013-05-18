<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	
	header("HTTP/1.0 404 Not Found");
	$pagetitle = "Page Not Found";
?>


<center>

	<h1 id="error-heading">404</h1>
	<p id="error-desc">The file you are looking for was kidnapped by aliens... Seriously.</p>
    <p id="error-back">
    	<a href="dashboard.html">Go back to the dashboard</a>
    </p>
    <img src="images/404.png" style=" border-radius:80px; width: 400px" />
</center>
