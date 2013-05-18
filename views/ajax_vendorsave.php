<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");


	if(isset($_POST["vname"])){
		$dbd["vname"] 		= $_POST["vname"];
		if(isset($_POST["vcontact"])){ $dbd["contactperson"] = $_POST["vcontact"];}
		if(isset($_POST["vphone"])){ $dbd["phone"] = $_POST["vphone"];}
		if(isset($_POST["vcontact"])){ $dbd["contactperson"] = $_POST["vcontact"];}
		if(isset($_POST["voinfo"])){ $dbd["otherinfo"] = $_POST["voinfo"];}
		$db->insert('vendors',$dbd);
	}?>
<select name="vendor_id" id="vendor_id_<?=$_POST["blockid"]?>" class="chzn-select-deselect" style="width:200px">
    <option value="">Choose One</option>
    <?php
        $db->query("SELECT * FROM vendors ORDER BY `vname`");
        $srecords = $db->fetch_assoc_all();
        foreach($srecords as $srow){
            echo "\n\t<option value=\"".$srow["id"]."\">".$srow["vname"]."</option>";
        }
    ?>
</select>