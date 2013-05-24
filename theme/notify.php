<?php
	if(isset($_SESSION["notify"]["g"])){
		foreach($_SESSION["notify"]["g"] as $nmsg){
			?>
<div class="ad-notif-success grid_12 small-mg"><p><?=$nmsg?></p></div>            
            <?php
		}
	}
 
	if(isset($_SESSION["notify"]["e"])){
		foreach($_SESSION["notify"]["e"] as $nmsg){
			?>
<div class="ad-notif-error grid_12 small-mg"><p><?=$nmsg?></p></div>
            <?php
		}
	}
 
	if(isset($_SESSION["notify"]["w"])){
		foreach($_SESSION["notify"]["w"] as $nmsg){
			?>
<div class="ad-notif-warn grid_12 small-mg"><p><?=$nmsg?></p></div>
            <?php
		}
	}

	if(isset($_SESSION["notify"]["i"])){
		foreach($_SESSION["notify"]["i"] as $nmsg){
			?>
<div class="ad-notif-info grid_12"><p><?=$nmsg?></p></div>            
            <?php
		}
	}
	//print_r($_SESSION["notify"]);
	unset($_SESSION["notify"]);		//Clear all messages
?>





