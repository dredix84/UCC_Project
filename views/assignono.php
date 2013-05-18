<?php

	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	if(!isset($_SESSION["userinfo"])){header("location:index.php?route=login");}
	
	$pagetitle = "Order Information";
	
	//Assigning rder
	if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "assignono"){
		$dbd["order_stamped"] = 1;
		$dbd["stamp_date"] = mysqlnow();
		$didsave = 	$db->update('orders',$dbd, "id = ".$db->escape($_REQUEST["oid"]));
		if ($didsave){
			order_informsales($_REQUEST["oid"]);
			header('Location: index.php?route=assignono&oid='.$_REQUEST["oid"]);
		}else{
			?>
	<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
		<strong>Alert:</strong> There was an error while atteping to save the data.</p>
	</div			
			><?php
		}
	}	
	
	
	if(!isset($_REQUEST["oid"])){

	?>

	<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
		<strong>Alert:</strong> No order number has been set.</p>
	</div>
    
    <?php
		
	}else{
		
		// Queries for select input data	  
	  	$db->query("SELECT id, `cost`, `title` FROM vendorsetup");
		$srecords_vs = $db->fetch_assoc_all();
		$db->query("SELECT `title`, `title` FROM setups");
        $srecords_sup = $db->fetch_assoc_all();
		
		//Main data query
		$db->query("SELECT *, (SELECT concat(c.fname, ' ', c.lname) FROM customers c WHERE c.id = o.customer_id) as custname FROM orders o WHERE id = " . $db->escape($_REQUEST["oid"]));
        $records = $db->fetch_assoc_all();
		$orow = $records[0];
	?>
	<script>
		$(function() {
			$( "#tabs" ).tabs();
		});
    </script>

	
    <div style="margin-top: 10px; padding: 1em;" class="ui-state-highlight ui-corner-all">
    	<a href="index.php" class="jbtn" style="float:right">Back to Dashboard</a>
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		<strong>Order Information!</strong> See Order Details Below.</p>
        <p><strong>Customer PO #:</strong> <?=$orow["cust_po"]?></p>
        <p><strong>Customer Name:</strong> <?=$orow["custname"]?></p>
	</div>
	
    <?php if($orow["supportperson_id"] == $_SESSION["userinfo"]["id"] && $orow["order_stamped"] == 0){ ?>
    <div style="margin-top: 10px; padding: 1em;" class="ui-state-highlight ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		<strong>Assign Order Number!</strong><br />
		The button below will assign an order number to the order and the Account Manager will be alerted via email.</p>
        <a href="index.php?route=assignono&oid=<?=$_REQUEST["oid"]?>&action=assignono" class="jbtn">Click here to assign order number.</a>
	</div>
    <?php }elseif($orow["order_stamped"] == 1){ ?>
    <div style="margin-top: 10px; padding: 1em;" class="ui-state-highlight ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		<strong>Order Number!</strong> See details below</p>
		<p><strong>Order Number#:</strong> <?=$orow["id"]?></p>
        <p><strong>Date Stamped:</strong> <?=$orow["stamp_date"]?></p>
	</div>
    
	<?php }else{ ?>
    <div style="margin-top: 10px;padding: 1em;" class="ui-state-error ui-corner-all">
        <p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
        <strong>Alert:</strong> This order has not been assigned an order number by the support person.</p>
    </div>
    
    <?php } ?>
    <br />

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">General</a></li>
            <li><a href="#tabs-2">Address</a></li>
            <li><a href="#tabs-3">Products</a></li>
        </ul>
        <div id="tabs-1">
            
    <table width="100%" border="0" class="viewdata">
      <tr>
        <td>Order Entry Date:</td>
        <td><input type="text" class="jdate	oinput" name="orderentrydate" id="" readonly="readonly" value="<?=$orow["orderentrydate"]?>" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sales Person:</td>
        <td>
            <select class="chzn-select-deselect" name="accountmanager" style="width: 150px" disabled="disabled">
                <?php
                    $db->query("SELECT u.`id`, concat(u.`fname`, ' ', u.`lname`) as accman FROM users u WHERE account_manager = 1 AND u.status = 1");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
						if($srow["id"] == $orow["accountmanager"]){$sel= 'selected = "selected"';}else{$sel = "";}
                        echo "\n\t<option value=\"".$srow["id"]."\" $sel >".$srow["accman"]."</option>";
                    }
                
                ?>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Event/Rush: </td>
        <td>
            <select name="event_rush">
                <?php
                    $db->query("SELECT `id`, `description` FROM event_rush");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
						if($srow["id"] == $orow["event_rush"]){$sel= 'selected = "selected"';}else{$sel = "";}
                        echo "\n\t<option value='".$srow["id"]."' $sel >".$srow["description"]."</option>";
                    }
                
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Must be shipped by: </td>
        <td><input type="text" class="jdate	oinput" name="mustshipbydate" id="" readonly="readonly" value="<?=$orow["mustshipbydate"]?>" /></td>
        <td>&nbsp;</td>
        <td>Order In-Hands Date: </td>
        <td><input type="text" class="jdate	oinput" name="orderinhanddate" id="" readonly="readonly" value="<?=$orow["orderinhanddate"]?>" /></td>
      </tr>
      <tr>
        <td>Is a repeat order:</td>
        <td>
            <input type="radio" name="repeatorder" id="repeato1" value="1"  <?=($orow["repeatorder"] == 1 ?'checked="checked"':'')?> /> <label for="repeato1">Yes</label> 
            <input type="radio" name="repeatorder" id="repeato0" value="0"  <?=($orow["repeatorder"] == 0 ?'checked="checked"':'')?>/> <label for="repeato0">No</label> 
        </td>
        <td>&nbsp;</td>
        <td>Tax Code: </td>
        <td>
            <select name="taxcode">
                <?php
                    $db->query("SELECT `id`, `code` FROM taxcode");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
						if($srow["id"] == $orow["taxcode"]){$sel= 'selected = "selected"';}else{$sel = "";}
                        echo "\n\t<option value=\"".$srow["id"]."\" $sel >".$srow["code"]."</option>";
                    }
                
                ?>
            </select>
        </td>
      </tr>
    </table>
    
	<table>
      <tr>
        <td colspan="2">
        Total Order: <input type="text" style="width:80px" id="totalorder" name="total_order" value="<?=$orow["total_order"]?>" />  
        &nbsp;&nbsp;&nbsp;
        Gross Profit: <input type="text" style="width:80px" id="grossprofit" name="gross_profit" value="<?=$orow["gross_profit"]?>" />
        &nbsp;&nbsp;&nbsp;
        Margin: <input type="text" style="width:80px" id="totalorder" name="margin" value="<?=$orow["margin"]?>" />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
            
        </div>
        <div id="tabs-2">
        
            <table width="100%" border="0" class="viewdata">              
              <tr>
              	<td></td>
                <td>Customer Bill To: </td>
                
                <td>Customer Shipp To Address: </td>
              </tr>
              
              <tr>
              	<td>Company</td>
                <td>
                  <input type="text" class="oinput" name="cs_companyb" id="cs_companyb" style="width:100%" title="Company blling name" value="<?=$orow["companyb"]?>" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_companys" id="cs_companys" style="width:100%" title="Company shipping name" value="<?=$orow["companys"]?>" />
                </td>
              </tr>
              <tr>
              	<td>Attention</td>
                <td>
                  <input type="text" class="oinput" name="cs_attentionb" id="cs_attentionb" style="width:100%" title="Billing Attention" value="<?=$orow["attentionb"]?>" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_attentions" id="cs_attentions" style="width:100%" title="Shipping attention" value="<?=$orow["attentionb"]?>" />
                </td>
              </tr>
              <tr>
              	<td>Address</td>
                <td>
                  <input type="text" class="oinput" name="cs_addressb" id="cs_addressb" style="width:100%" title="Billing address" value="<?=$orow["addressb"]?>" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_addresss" id="cs_addresss" style="width:100%" title="Shipping Address" value="<?=$orow["addresss"]?>" />
                </td>
              </tr>
              <tr>
              	<td>Address 2</td>
                <td>
                  <input type="text" class="oinput" name="cs_address2b" id="cs_address2b" style="width:100%" value="<?=$orow["address2b"]?>" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_address2b" id="cs_address2b" style="width:100%" value="<?=$orow["address2s"]?>" />
                </td>
              </tr>
              <tr>
              	<td>City</td>
                <td>
                  <input type="text" class="oinput" name="cs_cityb" id="cs_cityb" style="width:100%" title="Billing City" value="<?=$orow["cityb"]?>" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_citys" id="cs_citys" style="width:100%" title="Shipping City" value="<?=$orow["citys"]?>" />
                </td>
              </tr>
              <tr>
              	<td>State/Zipcode</td>
                <td>
                    <select style="width:48%" class="oinput" id="cs_stateb" name="cs_stateb" title="Billing State">
                        <option value="">State</option>
                        <?php
							$db->query("SELECT `code`, `name` FROM state");
							$state = $db->fetch_assoc_all();
                            foreach($state as $srow){
								if($srow["code"] == $orow["stateb"]){$sel= 'selected = "selected"';}else{$sel = "";}
                                echo "\n\t<option value=\"".$srow["code"]."\" $sel >".$srow["name"]."</option>";
                            }
                        ?>
                    </select>
                    <input type="text" class="oinput" name="cs_zipcodeb" id="cs_zipcodeb" style="width:48%;float:right" title="Billing Zipcode" value="<?=$orow["zipcodeb"]?>" />
                </td>
                <td>
                	<select style="width:48%" class="oinput" id="cs_states" name="cs_states" title="Shipping State">
                    <option value="">State</option>
                        <?php 
                            foreach($state as $srow){
								if($srow["code"] == $orow["states"]){$sel= 'selected = "selected"';}else{$sel = "";}
                                echo "\n\t<option value=\"".$srow["code"]."\" $sel >".$srow["name"]."</option>";
                            }
                        ?>
                    </select>
                    <input type="text" class="oinput" name="cs_zipcodes" id="cs_zipcodes" style="width:48%;float:right" title="Shipping Zipcode" value="<?=$orow["zipcodes"]?>" />
                </td>
              </tr>

            </table>

         
        </div>
        <div id="tabs-3">


<?php
	$db->query("SELECT * FROM orders_products WHERE order_id = " . $db->escape($_REQUEST["oid"]));
	$products = $db->fetch_assoc_all();

	foreach($products as $prow){		
?>


    <table width="100%" border="0" class="viewdata"  style="border: 1px #3A6F8F solid; margin-bottom: 10px; border-radius: 5px">
      <tr>
        <td width="100px">
        Shipping Method: </td><td>
            <select name="shipping_method">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `title` FROM shipping_methods");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
						if($srow["id"] == $prow["shipping_method"]){$sel= 'selected = "selected"';}else{$sel = "";}
                        echo "\n\t<option value=\"".$srow["id"]."\" $sel >".$srow["title"]."</option>";
                    }
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        Item number <input type="text" name="item_number" value="<?=$prow["item_number"]?>" />
        &nbsp;&nbsp;&nbsp;
        Vendor: 
        	<span id="vendorctrl_<?=$blockid?>">
             <select name="vendor_id" id="vendor_id_<?=$blockid?>" class="chzn-select-deselect" style="width:200px">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT * FROM vendors ORDER BY `vname`");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
						if($srow["id"] == $prow["vendor_id"]){$sel= 'selected = "selected"';}else{$sel = "";}
                        echo "\n\t<option value=\"".$srow["id"]."\" $sel >".$srow["vname"]."</option>";
                    }
                ?>
            </select></span>
        </td>
      </tr>
      <tr>
        <td>Quantity: </td><td><input type="text" style="width:50px" id="qty_<?=$blockid?>" name="quantity"  value="<?=$prow["quantity"]?>" /></td>
      </tr>
      <tr>
        <td>Retail Price: </td><td><input type="text" style="width:50px" id="retailprice_<?=$blockid?>" name="retail_price" value="<?=$prow["retail_price"]?>" /></td>
      </tr>
      <tr>
        <td>Net Price: </td><td><input type="text" style="width:50px" id="netprice_<?=$blockid?>" class="netprice" onchange="calc_vsetup()" name="net_price" value="<?=$prow["net_price"]?>" /></td>
      </tr>
      <tr>
        <td colspan="2"><br />
        	Product Description:
            <textarea style="width:99%" rows="5" name="product_description" readonly="readonly"><?=$prow["product_description"]?></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        Product Colour <input type="text" name="product_color" value="<?=$prow["product_color"]?>" />
        &nbsp;&nbsp;&nbsp;
        Imprint Location: <input type="text" name="imprint_location" value="<?=$prow["imprint_location"]?>" />
        </td>
      </tr>
      <tr>
        <td>
        Imprint Size: </td><td><input type="text" style="width:50px" name="imprint_width" value="<?=$prow["imprint_width"]?>" /> width x <input type="text" style="width:50px" name="imprint_height" value="<?=$prow["imprint_height"]?>" /> height
        </td>
      </tr>
      <tr>
        <td colspan="2">
        	Imprint Color:
            <select name="imprint_color_type">
                <option value="Stock" <?=($prow["imprint_color_type"]=="Stock"?"selected='selected'":"")?> >Stock</option>
                <option value="PMS" <?=($prow["imprint_color_type"]=="PMS"?"selected='selected'":"")?> >PMS</option>
            </select>
            &nbsp;&nbsp;
            Specify Colors: <input type="text" name="specified_color" value="<?=$prow["specified_color"]?>" />
            
        </td>
      </tr>
      <?php
	  	$vsetups = json_decode($orow["vendor_setup"]);
		$setupcnt = json_decode($orow["noofsetup"]);
		$vsetup_prodid = json_decode($orow["vsetup_prodid"]);
		$setup_net_price_per = json_decode($orow["setup_net_price_per"]);
		$setup_retail_price_per = json_decode($orow["setup_retail_price_per"]);

	  	
		for ($x = 0; $x < count($vsetups); $x++){
			//$sid = explode(";",$vsetups[$x])[0];
			if($vsetups[$x] != "" && $setupcnt[$x] != "" && $prow["blockid"] == $vsetup_prodid[$x]){
				
			
	  ?>      
      <tr>
        <td colspan="2">
        	<div id="vsetuptemp" class="vsetupdiv">
        	Vendor Setup <input type="text" name="vsetup[]" id="vsetup" class="vsetup" value="<?=$vsetups[$x]?>" />
            # of Setups <input type="number" name="vsetupqty[]" id="vsetupqty" class="vsetupqty" min="1" value="<?=$setupcnt[$x]?>" />
            <br />
            Setup Net Price Per: <input type="text" style="width:100px" name="setup_net_price_per[]" value="<?=$setup_net_price_per[$x]?>" />  
            &nbsp;&nbsp;&nbsp;
            Setup Retail Price Per:  
            <input type="text" style="width:100px" name="setup_retail_price_per[]" value="<?=$setup_retail_price_per[$x]?>" />
            <a onclick="domorevsetup();" style="display:none"><img src="images/add.png" class="likebtn" title="Add another" /></a>
            </div>
            <div id="morevsetup"></div>
        </td>
      </tr>

      <?php
	  			}
			}
	  ?>
      
    </table>
<?php
	}
?>
	<table>
      <tr>
        <td colspan="2">
        Total Order: <input type="text" style="width:80px" id="totalorder" name="total_order" value="<?=$orow["total_order"]?>" />  
        &nbsp;&nbsp;&nbsp;
        Gross Profit: <input type="text" style="width:80px" id="grossprofit" name="gross_profit" value="<?=$orow["gross_profit"]?>" />
        &nbsp;&nbsp;&nbsp;
        Margin: <input type="text" style="width:80px" id="totalorder" name="margin" value="<?=$orow["margin"]?>" />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
        </div>
    </div>
    
    <script>
		$(".viewdata select").prop('disabled', true);
		$(".viewdata input").attr('disabled', true);
	</script>
        
        
	<?php
	}
	?>