<?php

	if(isset($_REQUEST["action"])){
		if($_REQUEST["action"] == "Create Project"){
			$savedata = $_REQUEST["proj"];	//Getting form data
			$savedata["created_by"] = $_SESSION["userinfo"]["id"];
			$savedata["date_created"] = mysqlnow();
			
			if($db->insert('project',$savedata)){
				$projectid = $db->insert_id();
				calevent($projectid , "Project created", "The project '".$savedata["title"]."' was created.");
			}else{
				//Failed to create project
			}
		}
	
		
		if($_REQUEST["action"] == "Create Requisition"){
			$savedata = $_REQUEST["req"];	//Getting form data

			if($db->insert('requisition',$savedata)){
				calevent($savedata["project_id"] , "Requisition created", "A requisition was created for project # ".$savedata["project_id"]);
			}else{
				//Failed to create project
			}
		}
		
		
		if($_REQUEST["action"] == "Save Item"){
			$savedata = $_REQUEST["reqi"];	//Getting form data
			$savedata["date_created"] = mysqlnow();
			
			if($db->insert('requisition_items',$savedata)){
				$f_return = $_REQUEST["f_return"]."&req_id=".$_REQUEST["reqi"]["req_id"];
			}else{
				//Failed to create project
			}
		}
		
		if($_REQUEST["action"] == "Confirm Deletion"){
			//$savedata = $_REQUEST["reqi"];	//Getting form data
			
			$db->delete('requisition_items', "id IN (".implode(",",$_REQUEST["req_i"]).")");
			$f_return = $_REQUEST["f_return"]."&req_id=".$_REQUEST["req_id"];
		}		
	}

	