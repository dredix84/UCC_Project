<?php
$query = 'SELECT *,
(SELECT title FROM items i WHERE r.item_no = i.id) as itemname,
(SELECT name FROM supplier s WHERE s.id = r.supplier_id) as supplier_name
FROM requisition_items r
WHERE req_id = '.$_REQUEST["req_id"];

?>

      <div class="box grid_12" id="itbl_<?=$_REQUEST["req_id"]?>">
        <div class="box-head"><h2>Items for Requisition #: <?=$_REQUEST["req_id"]?></h2></div>
        <div class="box-content no-pad">
        <ul class="table-toolbar">
          <li><a class="link" onclick="open_reqitem()" ><img src="img/icons/basic/plus.png" alt=""/> Add Item</a></li>
          <li><a class="link" onclick="deleted_reqi()"><img src="img/icons/basic/delete.png" alt="" /> Remove Item</a></li>
          <li><a href="#"><img src="img/icons/basic/save.png" alt="" /> Save & Request Approval</a></li>
        </ul>
        <table class="display" id="req_details_table">
            <thead>
                <tr>
                    <th style="max-width:35px"></th>
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
		
		$db->query($query);
		$records = $db->fetch_assoc_all();
		$rcnt = 1;
		
		foreach($records as $row){
			
			?>
       
                <tr>
                    <td class="reqi_chk">
                    	<input type="checkbox" name="req_i[]" value="<?=$row["id"]?>" />
                        <img src="images/edit_16.png" />
                    </td>
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
