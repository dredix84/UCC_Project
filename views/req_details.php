<?php
$query = "SELECT * FROM requisition WHERE id = ".$_REQUEST["req_id"];
$db->query($query);
$records = $db->fetch_assoc_all();
$req_info = $records[0];



function allow_redit($req_info){
	$outval = true;

	if(strlen($req_info["seeking_approval"]) > 0){
		//die("seeking_approval");
		$outval = false;
	}
	if(strlen($req_info["authorized_date"]) > 0){
		//die("authorized_date");
		$outval = false;
	}
	
	return $outval;
}
$query = 'SELECT *,
(SELECT title FROM items i WHERE r.item_no = i.id) as itemname,
(SELECT name FROM supplier s WHERE s.id = r.supplier_id) as supplier_name
FROM requisition_items r
WHERE req_id = '.$_REQUEST["req_id"];

		$db->query($query);
		$records = $db->fetch_assoc_all();
?>

      <div class="box grid_12" id="itbl_<?=$_REQUEST["req_id"]?>">
        <div class="box-head"><h2>Items for Requisition #: <?=$_REQUEST["req_id"]?></h2></div>
        <div class="box-content no-pad">
        <?php if(allow_redit($req_info)){ ?>
        <ul class="table-toolbar">
          <li><a class="link" onclick="open_reqitem()" ><img src="img/icons/basic/plus.png" alt=""/> Add Item</a></li>
          <?php if(count($records) > 0){ ?>
          <li><a class="link" onclick="deleted_reqi()"><img src="img/icons/basic/delete.png" alt="" /> Remove Item</a></li>
          <?php } ?>
		  <?php if(count($records) > 0 && hasright("req_seekapprv_Requisition")){ ?>
          <li><a href="index.php?route=home&id=<?=$_REQUEST["pid"]?>&req_id=<?=$_REQUEST["req_id"]?>&seek_apprv=true"><img src="img/icons/basic/save.png" alt="" /> Save & Request Approval</a></li>
          <?php } ?>
        </ul>
        <?php } ?>
        
        <?php if(strlen($req_info["seeking_approval"]) > 0 && strlen($req_info["authorized_date"]) == 0 &&  hasright("req_apprv_Requisition")){ ?>
        	<ul class="table-toolbar">
          		<li><a href="index.php?route=home&id=<?=$_REQUEST["pid"]?>&req_id=<?=$_REQUEST["req_id"]?>&req_apprv=true"><img src="images/tick_button.png" alt="" /> Approve Requisition</a></li>
          	</ul>
        <?php }?>
        
        
        <table class="display" id="req_details_table">
            <thead>
                <tr>
                    <?php if(allow_redit($req_info)){ ?><th style="max-width:35px"></th> <?php } ?>
                    <th style="max-width:35px">#</th>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Order #</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
		

		$rcnt = 1;
		
		foreach($records as $row){
			
			?>
       
                <tr>
                	<?php if(allow_redit($req_info)){ ?>
                    <td class="reqi_chk">
                    	<input type="checkbox" name="req_i[]" value="<?=$row["id"]?>" />
                        <img src="images/edit_16.png" />
                    </td>
                    <?php } ?>
                    <td><?=($rcnt++)?></td>
                    <td><?=$row["qty"]?></td>
                    <td><?=$row["itemname"]?></td>
                    <td><?=$row["cost"]?></td>
                    <td class="center">--</td>
                    <td><?=$row["supplier_name"]?></td>
                </tr>
            <?php
		}
			?>
            </tbody>
      </table>
        </div>
      </div>
