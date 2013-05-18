<?php
	$blockid = rand(0,100000);
?><div id="prodblock_<?=$blockid?>" class="prodblock" style=" border: #3A6F8F 1px dashed; border-bottom:#FFFFFF 2px solid; margin-bottom: 10px; background-color: #151f24; padding: 5px; ">
	<a style="float:right" onclick="removeblock('prodblock_<?=$blockid?>')"><img src="images/delete.png" /></a>
    <table width="100%" border="0">
      <tr>
        <td width="100px">
        Shipping Method: </td><td>
            <select>
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `title` FROM shipping_methods");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["title"]."</option>";
                    }
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        Item number <input type="text" />
        &nbsp;&nbsp;&nbsp;
        Vendor: 
        	<span id="vendorctrl_<?=$blockid?>">
             <select name="vendor_id" id="vendor_id_<?=$blockid?>" class="chzn-select-deselect" style="width:200px">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT * FROM vendors ORDER BY `vname`");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["vname"]."</option>";
                    }
                ?>
            </select></span>
        <a onclick="addvendordiag('<?=$blockid?>');" class="jbtn" ><img src="images/add.png" class="likebtn" title="Add vendor"/></a>
        </td>
      </tr>
      <tr>
        <td>Quantity: </td><td><input type="text" style="width:50px" id="qty_<?=$blockid?>" onchange="calc_netprice('<?=$blockid?>')" /></td>
      </tr>
      <tr>
        <td>Retail Price: </td><td><input type="text" style="width:50px" id="retailprice_<?=$blockid?>" onchange="calc_netprice('<?=$blockid?>')" /></td>
      </tr>
      <tr>
        <td>Net Price: </td><td><input type="text" style="width:50px" id="netprice_<?=$blockid?>" /></td>
      </tr>
      <tr>
        <td colspan="2"><br />
        	Product Description:
            <textarea style="width:100%" rows="5"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        Product Colour <input type="text" />
        &nbsp;&nbsp;&nbsp;
        Imprint Location: <input type="text" />
        </td>
      </tr>
      <tr>
        <td>
        Imprint Size: </td><td><input type="text" style="width:50px" /> width x <input type="text" style="width:50px" /> height
        </td>
      </tr>
      <tr>
        <td colspan="2">
        	Imprint Color:
            <select>
            	<option value="">Choose one</option>
                <option value="Stock">Stock</option>
                <option value="PMS">PMS</option>
            </select>
            &nbsp;&nbsp;&nbsp;
            Specify Colors: <input type="text" />
            
        </td>
      </tr>
      <tr>
        <td colspan="2">
        	Vendor Setup
            <select>
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `title` FROM vendorsetup");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["title"]."</option>";
                    }
                ?>
            </select>
            
            # of Setups
            
            <select>
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `title` FROM setups");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["title"]."</option>";
                    }
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        Setup Net Price Per: <input type="text" style="width:100px" /><br />
        Specify Color(s): <input type="text" style="width:100px" /> <a class="jbtn"><img src="images/color_wheel.png" align="absmiddle" /> View PMS Chart</a>
        </td>
      </tr>	
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</div>