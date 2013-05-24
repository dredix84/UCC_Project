<?php

	if(isset($_REQUEST["action"])){
		if($_REQUEST["action"] == "save_rights"){
			$db->update(
				'user_groups',
				array(
					'rights'   =>  json_encode($_REQUEST["right"]),
				),
				'id = '.$_REQUEST["id"]
			);
			
			addmsg("User Group rights has been updated", "g");
			
			$f_return = "index.php?route=user_groups";
		}
	}