<?php

	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	logincheck();
	
	if(!isset($_REQUEST["req_id"])){
		echo "<h2 style=\"text-align:center\">Bad Request!!!</h2>";
	}else{
		
	
		$db->query('SELECT *,
(SELECT username FROM users u WHERE u.id = req_init) as rinit_user,
(SELECT title from status_code s WHERE s.id = r.status_code) as status_title,
(SELECT title from delivery_code d WHERE d.id = r.delivery_code) as delivery,
(SELECT username FROM users u WHERE u.id = req_authorize_init) as rauth_user
FROM requisition r
		WHERE id = ?', array($_REQUEST["req_id"]));
		$records = $db->fetch_assoc_all();
		$req =  $records[0];
		?>
		
        <?php if($req["authorized_date"] == ""){ ?>
        	<div class="ad-notif-warn grid_12 small-mg"><p>This requisition has not been authorized as yet.</p></div>
		<?php }else{ ?>
        	<div class="ad-notif-success grid_12 small-mg"><p>This requisition was autorized on <strong><?=$req["authorized_date"]?></strong> by <strong><?=$req["rauth_user"]?></strong></p></div>
        <?php } ?>
        
        <div style="float: left; margin-right:10px; min-width: 290px">
            <div class="form-row">
                <p class="form-label">Requisition Number</p>
                <div class="form-item"><?=$req["id"]?></div>
            </div>
            <div class="form-row">
                <p class="form-label">Requisition Date</p>
                <div class="form-item"><?=$req["req_date"]?></div>
            </div>
            <div class="form-row">
                <p class="form-label">Requisitioned By</p>
                <div class="form-item"><?=$req["rinit_user"]?></div>
            </div>
        </div>
        
        <div style="float: left; margin-right:10px; min-width: 290px">
            <div class="form-row">
                <p class="form-label">Status</p>
                <div class="form-item"><?=$req["status_title"]?></div>
            </div>
        </div>
        <div style="float: left; margin-right:10px; min-width: 290px">
            <div class="form-row">
                <p class="form-label">Delivery Type</p>
                <div class="form-item"><?=$req["delivery"]?></div>
            </div>
        </div>
        
        <div style="float: left; margin-right:10px; min-width: 290px">
            <div class="form-row">
                <p class="form-label">Date Delivery Required</p>
                <div class="form-item"><?=$req["date_delivery_required"]?></div>
            </div>
        </div>
        
        
        
        <div style="float: left; margin-right:10px; min-width: 100px;">
        	<?php if(strlen($req["seeking_approval"]) > 0 && strlen($req["authorized_date"]) == 0 &&  hasright("req_apprv_Requisition")){ ?>
            <a class="button green" href="index.php?route=home&id=<?=$_REQUEST["pid"]?>&req_id=<?=$_REQUEST["req_id"]?>&req_apprc=true"><img src="img/icons/basic/tick_button.png" alt="" /> Approve Requisition</a>

            
            <?php } ?>
        </div>
        
        <div style="clear:both"></div>
        <?php
		//print_r($records);
	}
	