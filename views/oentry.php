<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
?>
	<?php if(isset($msg)){ ?>
	<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		<strong><?=$msg?></strong></p>
	</div>
    <?php } ?>
    <script>
	
	
	</script>
    <style>


	</style>
<form method="post" action="index.php?route=oentry" name="orderForm" onsubmit="return formvalid();">
	<input name="dosave" value="yes" type="hidden" /><input name="orderid" value="" type="hidden" />
    <table width="100%" border="0">
      <tr>
        <td>Order Entry Date:</td>
        <td><input type="text" class="jdate	oinput" name="orderentrydate" id="" readonly="readonly" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sales Person:</td>
        <td>
            <select class="chzn-select-deselect" name="accountmanager" style="width: 150px">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT u.`id`, concat(u.`fname`, ' ', u.`lname`) as accman FROM users u WHERE account_manager = 1 AND u.status = 1");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["accman"]."</option>";
                    }
                
                ?>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Event/Rush: </td>
        <td>
            <select name="event_rush">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `description` FROM event_rush");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["description"]."</option>";
                    }
                
                ?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Must be shipped by: </td>
        <td><input type="text" class="jdate	oinput" name="mustshipbydate" id="" readonly="readonly" /></td>
        <td>&nbsp;</td>
        <td>Order In-Hands Date: </td>
        <td><input type="text" class="jdate	oinput" name="orderinhanddate" id="" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Is a repeat order:</td>
        <td>
            <input type="radio" name="repeatorder" id="repeato1" value="1" /> <label for="repeato1">Yes</label> 
            <input type="radio" name="repeatorder" id="repeato0" value="0" /> <label for="repeato0">No</label> 
        </td>
        <td>&nbsp;</td>
        <td>Tax Code: </td>
        <td>
            <select name="taxcode">
                <option value="">Choose One</option>
                <?php
                    $db->query("SELECT `id`, `code` FROM taxcode");
                    $srecords = $db->fetch_assoc_all();
                    foreach($srecords as $srow){
                        echo "\n\t<option value=\"".$srow["id"]."\">".$srow["code"]."</option>";
                    }
                
                ?>
            </select>
        </td>
      </tr>
    </table>
    
    <h3 class="sechead">Customer Information</h3>
    <table width="100%" border="0">
      <tr>
        <td>Customer PO#: <input type="text" class="oinput" name="cust_po" id="cust_po" /></td>
        <td>&nbsp;</td>
        <td colspan="3">Ordered By:  	
            <input type="text" id="custname" name="custname" /><input id="customerid" name="customerid" type="hidden" />
            <img src="images/add.png" class="likebtn" title="Add Customer" onclick="addcustomerdiag();"/>
            <div id="getcustbusy"></div>  
            
        </td>
      </tr>
      <tr>
        <td colspan="2">Customer Bill To: </td>
        <td>&nbsp;</td>
        <td colspan="2">Customer Shipp To Address: </td>
      </tr>
      <tr>
        <td colspan="2" class="infield">
            <input type="text" class="oinput" name="companyb" id="companyb" style="width:100%" title="Company"/>
            <input type="text" class="oinput" name="attentionb" id="attentionb" style="width:100%" title="Attention" />
            <input type="text" class="oinput" name="addressb" id="addressb" style="width:100%" title="Address" />
            <input type="text" class="oinput" name="address2b" id="address2b" style="width:100%" title="Address 2" />
            <input type="text" class="oinput" name="cityb" id="cityb" style="width:100%" title="City" />
            <select style="width:48%" class="oinput" id="stateb" name="stateb">
                <option value="">State</option>
                <?php
                    $db->query("SELECT `code`, `name` FROM state");
                    $state = $db->fetch_assoc_all();
                    foreach($state  as $srow){
                        echo "\n\t<option value=\"".$srow["code"]."\">".$srow["name"]."</option>";
                    }
                ?>
            </select>
            <input type="text" class="oinput" name="zipcodeb" id="zipcodeb" style="width:48%;float:right" title="Zipcode" />
        </td>
        <td>&nbsp;</td>
        <td colspan="2" class="infield">
            <input type="text" class="oinput" name="companys" id="companys" style="width:100%" title="Company" />
            <input type="text" class="oinput" name="attentions" id="attentions" style="width:100%" title="Attention" />
            <input type="text" class="oinput" name="addresss" id="addresss" style="width:100%" title="Address" />
            <input type="text" class="oinput" name="address2s" id="address2s" style="width:100%" title="Address 2" />
            <input type="text" class="oinput" name="citys" id="citys" style="width:100%" title="City" />
            <select style="width:48%" class="oinput" id="states" name="states">
                <option value="">State</option>
                <?php 
                    foreach($state as $srow){
                        echo "\n\t<option value=\"".$srow["code"]."\">".$srow["name"]."</option>";
                    }
                ?>
            </select>
            <input type="text" class="oinput" name="zipcodes" id="zipcodes" style="width:48%;float:right" title="Zipcode" />
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="checkbox" id="shipissame" value="0" /> <label for="shipissame">Also use as "Ship To" address</label></td>
        <td>&nbsp;</td>
        <td colspan="2"><input type="checkbox" id="shipadd" /> <label for="shipadd">Ship Multiple Address</label></td>
      </tr>
    </table>
    
    
    
    <h3 class="sechead">Product & Vendor Information</h3>
    
    <div id="products">
    
    </div>
    
    
    <div id="TempDiv" style="display:none">
    
    </div>
    <a onclick="fullcalc()" class="jbtn" style="display:none"  ><img src="images/add.png" align="absmiddle"/>Test</a> 
    <a onclick="addproduction2()" class="jbtn" ><img src="images/add.png" align="absmiddle" /> Add Product</a> 
    <br /><br />
    <table>
      <tr>
        <td colspan="2">
        Total Order: <input type="text" style="width:80px" id="totalorder" name="total_order" readonly="readonly" />  
        &nbsp;&nbsp;&nbsp;
        Gross Profit: <input type="text" style="width:80px" id="grossprofit" name="gross_profit" readonly="readonly" />
        &nbsp;&nbsp;&nbsp;
        Margin: <input type="text" style="width:80px" id="margin" name="margin" readonly="readonly" />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <br />
    Order Notes:
    <textarea style="width:99%" rows="5" name="ordernote" id="ordernote"></textarea>
    <br /><br /> 
    
    <input type="checkbox" id="iagree" />
    <label for="iagree" class="corange">I have checked quantities, imprints color &amp; time frame for the product with the vendor. I am also aware that  I am responsible personally and financially for all errors & omissions.</label>
    <br /><br />
    
    <center><input type="submit" class="jbtn" /></center>
    <input type="hidden" id="productcnt" value="0" />
</form> 

 
 
 
<div id="blankProd">
<?php 	$blockid = "blank"; ?>
    <div id="prodblock_<?=$blockid?>" class="prodblock" style=" border: #3A6F8F 1px dashed; border-bottom:#FFFFFF 2px solid; margin-bottom: 10px; background-color: #151f24; padding: 5px; display:none">
        <a style="float:right;" onclick="removeblock('prodblock_<?=$blockid?>')" class="jbtn" title="Remove this product"><img src="images/delete.png" /></a>
        <input type="hidden" name="blockid[]" value="<?=$blockid?>101" />
        <table width="100%" border="0">
          <tr>
            <td width="100px">
            Shipping Method: </td><td>
                <select name="shipping_method[]" class="vshipping_method" id="shipping_method<?=$blockid?>101">
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
            Item number <input type="text" name="item_number[]" class="vitem_number" id="item_number<?=$blockid?>101" />
            &nbsp;&nbsp;&nbsp;
            Vendor: 
                <span id="vendorctrl_<?=$blockid?>101">
                 <select name="vendor_id[]" id="vendor_id_<?=$blockid?>101" class="chzn-select-deselect vvendor_id" style="width:200px">
                    <option value="">Choose One</option>
                    <?php
                        $db->query("SELECT * FROM vendors ORDER BY `vname`");
                        $srecords = $db->fetch_assoc_all();
                        foreach($srecords as $srow){
                            echo "\n\t<option value=\"".$srow["id"]."\">".$srow["vname"]."</option>";
                        }
                    ?>
                </select></span>
            <img src="images/add.png" class="likebtn" title="Add vendor" onclick="addvendordiag('<?=$blockid?>101');"/>
            </td>
          </tr>
          <tr>
            <td>Quantity: </td><td><input type="text" style="width:50px" id="qty_<?=$blockid?>101" onchange="fullcalc()" name="quantity[]" class="vquantity" /></td>
          </tr>
          <tr>
            <td>Retail Price: </td><td><input type="text" style="width:50px" id="retailprice_<?=$blockid?>101" onchange="fullcalc()" name="retail_price[]" class="vretail_price" /></td>
          </tr>
          <tr>
            <td>Net Price: </td><td><input type="text" style="width:50px" id="netprice_<?=$blockid?>101" class="netprice vnet_price" onchange="fullcalc()" name="net_price[]"  /></td>
          </tr>
          <tr>
            <td colspan="2"><br />
                Product Description:
                <textarea style="width:99%" rows="5" name="product_description[]"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            Product Colour <input type="text" name="product_color[]" />
            &nbsp;&nbsp;&nbsp;
            Imprint Location: <input type="text" name="imprint_location[]" />
            </td>
          </tr>
          <tr>
            <td>
            Imprint Size: </td><td><input type="text" style="width:50px" name="imprint_width[]" /> width x <input type="text" style="width:50px" name="imprint_height[]" /> height
            </td>
          </tr>
          <tr>
            <td colspan="2">
                Imprint Color:
                <select name="imprint_color_type[]">
                    <option value="">Choose one</option>
                    <option value="Stock">Stock</option>
                    <option value="PMS">PMS</option>
                </select>
                &nbsp;&nbsp;
                Specify Colors: <input type="text" name="specified_color[]" style="width: 95px;" /> <a class="likebtn" href="http://www.pantone.com/pages/pantone/colorfinder.aspx" target="_blank"><img src="images/color_wheel.png" align="absmiddle" /> View PMS Chart</a>
                
            </td>
          </tr>
          <tr>
            <td colspan="2">
                <div id="vsetuptemp" class="vsetupdiv vsetupdiv_top">
                <a onclick="domorevsetup(<?=$blockid?>101);"><img src="images/add.png" class="likebtn" title="Add another" style="float:right" /></a>
                Vendor Setup <input type="text" name="vsetup[]" id="vsetup_<?=$blockid?>101" class="vsetup" />
                # of Setups <input type="number" name="vsetupqty[]" id="vsetupqty_<?=$blockid?>101" class="vsetupqty" min="1" onchange="fullcalc()"/><br />
                Setup Net Price Per: <input type="text" style="width:100px" name="setup_net_price_per[]" id="setup_net_price_per<?=$blockid?>101" onchange="fullcalc()" />  
                &nbsp;&nbsp;&nbsp;
                Setup Retail Price Per:  
                <input type="text" style="width:100px" name="setup_retail_price_per[]" id="setup_retail_price_per<?=$blockid?>101" onchange="fullcalc()" />
                <input id="vsetupid_<?=$blockid?>101" value="<?=$blockid?>101" type="hidden"  class="vsetupid" />
                <input name="vsetup_prodid[]" id="vsetup_prodid_<?=$blockid?>101" value="<?=$blockid?>101" type="hidden" />
                </div>
                <div id="morevsetup<?=$blockid?>101"></div>
            </td>
          </tr>
 <!--         <tr>
            <td colspan="2">
            Setup Net Price Per: <input type="text" style="width:100px" name="setup_net_price_per[]" />  
            &nbsp;&nbsp;&nbsp;
            Setup Retail Price Per:  
            <input type="text" style="width:100px" name="setup_retail_price_per[]" />
            </td>
          </tr>	 -->
        </table>
    </div>
</div> 
    

    <div id="dialog_addvendor" title="Add Vendor">
    	<form name="vForm">
        <table width="100%" border="0">
          <tr>
            <td>Name</td>
            <td><input type="text"  id="vname" name="vname" class="vinput"/></td>
          </tr>
          <tr>
            <td>Contact Person</td>
            <td><input type="text"  id="vcontact" name="vcontact" class="vinput"/></td>
          </tr>
          <tr>
            <td>Phone</td>
            <td><input type="text"  id="vphone" name="vphone" class="vinput"/></td>
          </tr>
          <tr>
            <td>Other Info</td>
            <td><textarea name="voinfo" id="voinfo" style="width: 99%;" rows="5" class="vinput"></textarea></td>
          </tr>
          <tr>
            <td colspan="2"><center><a class="jbtn" onclick="vendorsave();">Save Vendor</a></center></td>
          </tr>
        </table>
    	</form>
    </div>
    
    <div id="dialog_addcustomer" title="Add Customer">
    	<form name="cForm">
            <table width="100%" border="0">
              <tr>
                <td colspan="1">
                	First Name
                </td>
                <td colspan="2">
                	<input type="text" class="oinput" name="cfname" id="cfname" title="First Name" />
                </td>
              </tr>
              
              <tr>  
                <td colspan="1">
                	Last Name
                </td>
                <td colspan="2">
                	<input type="text" id="clname" name="clname" title="Last Name" />
                </td>
              </tr>
              
              <tr>
              	<td></td>
                <td>Customer Bill To: </td>
                
                <td>Customer Shipp To Address: </td>
              </tr>
              
              <tr>
              	<td>Company</td>
                <td>
                  <input type="text" class="oinput" name="cs_companyb" id="cs_companyb" style="width:100%" title="Company blling name" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_companys" id="cs_companys" style="width:100%" title="Company shipping name" />
                </td>
              </tr>
              <tr>
              	<td>Attention</td>
                <td>
                  <input type="text" class="oinput" name="cs_attentionb" id="cs_attentionb" style="width:100%" title="Billing Attention" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_attentions" id="cs_attentions" style="width:100%" title="Shipping attention" />
                </td>
              </tr>
              <tr>
              	<td>Address</td>
                <td>
                  <input type="text" class="oinput" name="cs_addressb" id="cs_addressb" style="width:100%" title="Billing address" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_addresss" id="cs_addresss" style="width:100%" title="Shipping Address" />
                </td>
              </tr>
              <tr>
              	<td>Address 2</td>
                <td>
                  <input type="text" class="oinput" name="cs_address2b" id="cs_address2b" style="width:100%" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_address2b" id="cs_address2b" style="width:100%" />
                </td>
              </tr>
              <tr>
              	<td>City</td>
                <td>
                  <input type="text" class="oinput" name="cs_cityb" id="cs_cityb" style="width:100%" title="Billing City" />
                </td>
                <td>
                  <input type="text" class="oinput" name="cs_citys" id="cs_citys" style="width:100%" title="Shipping City" />
                </td>
              </tr>
              <tr>
              	<td>State/Zipcode</td>
                <td>
                    <select style="width:48%" class="oinput" id="cs_stateb" name="cs_stateb" title="Billing State">
                        <option value="">State</option>
                        <?php
                            foreach($state as $srow){
                                echo "\n\t<option value=\"".$srow["code"]."\">".$srow["name"]."</option>";
                            }
                        ?>
                    </select>
                    <input type="text" class="oinput" name="cs_zipcodeb" id="cs_zipcodeb" style="width:48%;float:right" title="Billing Zipcode" />
                </td>
                <td>
                	<select style="width:48%" class="oinput" id="cs_states" name="cs_states" title="Shipping State">
                    <option value="">State</option>
                        <?php 
                            foreach($state as $srow){
                                echo "\n\t<option value=\"".$srow["code"]."\">".$srow["name"]."</option>";
                            }
                        ?>
                    </select>
                    <input type="text" class="oinput" name="cs_zipcodes" id="cs_zipcodes" style="width:48%;float:right" title="Shipping Zipcode" />
                </td>
              </tr>
              
              <tr>
                <td colspan="3" title="Click to save data"><center><a class="jbtn" onclick="customersave();">Save Customer</a></center></td>
              </tr>
            </table>
    	</form>
    </div>    

    
         
 <script>

	
 function fullcalc(){
	var totalorder = 0;
	var ordercost  = 0;
	var worktotal_a = 0;
	var worktotal_b = 0;
	var vid = "";		//V Setup ID
	var prodid = "";		//Production id
	var vtotal = 0;		//Stores setup total
	var cnt = 0;
	
	$("#products .vsetupid").each( function(){
		vtotal = 0;		
		vid = $(this).val();
		
		if(prodid !=  $("#vsetup_prodid_"+vid).val()){
			if(worktotal_a > 0 && cnt > 0){
				totalorder += parseFloat(worktotal_a);
				ordercost  += parseFloat(worktotal_b);
			}
			
			
			prodid =  $("#vsetup_prodid_"+vid).val();
			worktotal_a = parseFloat($("#qty_"+prodid).val()) * parseFloat($("#retailprice_"+prodid).val());
			if(isNaN(worktotal_a)){worktotal_a = 0;}
			worktotal_b = parseFloat($("#qty_"+prodid).val()) * parseFloat($("#netprice_"+prodid).val());
			if(isNaN(worktotal_b)){worktotal_b = 0;}
		}
		
		//alert(worktotal_a);
		//alert(worktotal_b);
		
		if($("#vsetup_"+vid).val() != "" && 
				parseFloat($("#vsetupqty_"+vid).val()) >= 1 && 
				parseFloat($("#setup_net_price_per"+vid).val()) >= 1 && 
				parseFloat($("#setup_retail_price_per"+vid).val()) >= 1){
			vtotal = parseFloat($("#vsetupqty_"+vid).val()) * parseFloat($("#setup_retail_price_per"+vid).val());
			//alert($("#vsetup_"+vid).val() + ": " + vtotal);
			worktotal_a += parseFloat(vtotal);
			worktotal_b += parseFloat(parseFloat($("#vsetupqty_"+vid).val()) * parseFloat($("#setup_net_price_per"+vid).val()));
		}
		
		cnt++;
	});

	 
	if(worktotal_a > 0){
		totalorder += parseFloat(worktotal_a);
		ordercost  += parseFloat(worktotal_b);
	}
	//alert("Work a: " + worktotal_a);
	//alert("Order Total: " + totalorder);
	var grossprofit = totalorder - ordercost;
	var margin = trueRound(grossprofit / totalorder * 100,2);
	if(isNaN(margin)){margin = 0;}
	
	$("#totalorder").val(totalorder);
	$("#grossprofit").val(grossprofit);
	$("#margin").val(margin);
 }
 
	function trueRound(value, digits){
		return (Math.round((value*Math.pow(10,digits)).toFixed(digits-1))/Math.pow(10,digits)).toFixed(digits);
	}

 function randomnum(){
	var randomnumber = Math.floor(Math.random()*10000001);
	 return randomnumber;
 }
 
/**
 * ReplaceAll by Fagner Brack (MIT Licensed)
 * Replaces all occurrences of a substring in a string
 */
String.prototype.replaceAll = function( token, newToken, ignoreCase ) {
    var _token;
    var str = this + "";
    var i = -1;

    if ( typeof token === "string" ) {
        if ( ignoreCase ) {
            _token = token.toLowerCase();
            while( (
                i = str.toLowerCase().indexOf(
                    token, i >= 0 ? i + newToken.length : 0
                ) ) !== -1
            ) {
                str = str.substring( 0, i ) +
                    newToken +
                    str.substring( i + token.length );
            }
        } else {
            return this.split( token ).join( newToken );
        }
    }
return str;
};

 
	$(function() {
		$( ".jdate" ).datepicker();
		$( ".jdate" ).datepicker( "option", "dateFormat", "yy-mm-dd");
		//$(".chzn-select-deselect").chosen({allow_single_deselect:true});
		//$(".chzn-select-deselect").combobox();
	});
	
	function makeniceselect(){
		$(".chzn-select-deselect").chosen({allow_single_deselect:true});
	}
	
function addproduction(){
	//Used to get a product with JSON
	var ajax_load = "<img src='img/load.gif' alt='loading...' />";
	var loadUrl = "index.php?route=json_product&pagetype=ajax";
	//$("#products").append(ajax_load).load(loadUrl);
	$('#TempDiv').load(loadUrl, function(){
		$('#products').append($('#TempDiv').html());
		$(".chzn-select-deselect").chosen({allow_single_deselect:true});
		$( ".jbtn" ).button();
		$('#TempDiv').html("");
	});
}
function addproduction2(){
	var newid = randomnum();
	var bprod = $('#blankProd').html();
	bprod = bprod.replaceAll("prodblock_blank", "prodblock_"+newid);
	bprod = bprod.replaceAll("blank101", newid);
	$('#products').append(bprod);
	$("#prodblock_"+newid).show("slow");
	//vendor_autocomplete(newid);		//Settting up jquery auto complete
	$("#vendor_id_"+newid).chosen({allow_single_deselect:true});
	
	$("#productcnt").val(parseFloat($("#productcnt").val()) + 1);
}

function removeblock(bid){
	$("#"+bid).hide('slow', function(){ 
		$("#"+bid).remove(); 
		$("#productcnt").val(parseFloat($("#productcnt").val()) - 1);
		fullcalc();
	});
	
}
/*
$.getJSON("index.php?route=products&pagetype=ajax",function(msg){

    alert("TotalClass : "+msg.u1);
    $.each(msg,function(k, v){
        alert(k+ " - "+v)
    });
});*/
	
	/*$("#customerid").change(function( event ) {
		getcustaddress();
	});*/
	$("#shipissame").click(function( event ) {
		sameaddress();
	});
	
function getcustaddress(){
	$("#getcustbusy").html("<img src='images/gettingd.png' alt='Busy' />");
	$.getJSON("index.php?route=json_getcustomer&pagetype=ajax&custid=" + $("#customerid").val(),function(msg){
		$.each(msg,function(k, v){
			if(v == "" || v == null){
				//alert(k+ " - "+v);
				$("#"+k).val("");
			}else{
				$("#"+k).val(v);
			}
			
		});
	});
	$("#getcustbusy").html("");	
}

function sameaddress(){	
	var istatus = true;
	if($('#shipissame').val() == 0) {
		$("#companys").val($("#companyb").val());
		$("#attentions").val($("#attentionb").val());
		$("#addresss").val($("#addressb").val());
		$("#address2s").val($("#address2b").val());
		$("#citys").val($("#cityb").val());
		$("#states").val($("#stateb").val());
		$("#zipcodes").val($("#zipcodeb").val());
		istatus = true;
		$('#shipissame').val(1);
		
		//Making readonly
		$("#companys").attr('readonly','readonly');
		$("#attentions").attr('readonly','readonly');
		$("#addresss").attr('readonly','readonly');
		$("#address2s").attr('readonly','readonly');
		$("#citys").attr('readonly','readonly');
		$("#states").attr('readonly','readonly');
		$("#zipcodes").attr('readonly','readonly');
	} else {
		istatus = false;
		$('#shipissame').val(0);
		
		//Removing readonly
		$("#companys").removeAttr('readonly');
		$("#attentions").removeAttr('readonly');
		$("#addresss").removeAttr('readonly');
		$("#address2s").removeAttr('readonly');
		$("#citys").removeAttr('readonly');
		$("#states").removeAttr('readonly');
		$("#zipcodes").removeAttr('readonly');		
	}


}

//Infield text
$('.infield input[type="text"]').each(function(){
 
    this.value = $(this).attr('title');
    $(this).addClass('text-label');
 
    $(this).focus(function(){
        if(this.value == $(this).attr('title')) {
            this.value = '';
            $(this).removeClass('text-label');
        }
    });
 
    $(this).blur(function(){
        if(this.value == '') {
            this.value = $(this).attr('title');
            $(this).addClass('text-label');
        }
    });
});


	
	//Setting up dialog for adding vendors
	$( "#dialog_addvendor" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400
	});
	$( "#dialog_addcustomer" ).dialog({
		autoOpen: false,
		modal: true,
		width: 600
	});
	

	function addvendordiag($blockid){
		$("#tempwork").val($blockid);
		$( "#dialog_addvendor" ).dialog( "open" );
	}
	function addcustomerdiag(){
		$( "#dialog_addcustomer" ).dialog( "open" );
	}
	
	function vendorsave(){
		//Used to do ajax request to save vendor information
		if(yav.performCheck('vForm', vrules, 'classic')){
			$.post(  
				"index.php?route=ajax_vendorsave&pagetype=ajax",  
				{vname: $("#vname").val(), vcontact: $("#vcontact").val(), vphone: $("#vphone").val(), voinfo: $("#voinfo").val(), blockid: $("#tempwork").val()},  
				function(responseText){  
					$("#vendorctrl_" + $("#tempwork").val()).html(responseText); 
					$("#vendor_id_" + $("#tempwork").val()).chosen({allow_single_deselect:true});
					alert($("#vname").val() + " was saved.");
					$(".vinput").val("");
					$("#tempwork").val("");
					$( "#dialog_addvendor" ).dialog( "close" );
				},  
				"html"  
			);
		}
	}
	
	function customersave(){
		if(yav.performCheck('cForm', crules, 'classic')){
			$.post(  
				"index.php?route=ajax_customersave&pagetype=ajax",  
				{
					fname: $("#cfname").val(), 
					lname: $("#clname").val(),
					companyb: $("#cs_companyb").val(), 
					companys: $("#cs_companys").val(), 
					attentionb: $("#cs_attentionb").val(),
					attentions: $("#cs_attentions").val(), 
					addressb: $("#cs_addressb").val(), 
					addresss: $("#cs_addresss").val(),
					address2b: $("#cs_address2b").val(), 
					address2s: $("#cs_address2s").val(), 
					cityb: $("#cs_cityb").val(),
					citys: $("#cs_citys").val(), 
					stateb: $("#cs_stateb").val(), 
					zipcodeb: $("#cs_zipcodeb").val(),
					states: $("#cs_states").val(),
					zipcodes: $("#cs_zipcodes").val()
				},  
				function(responseText){   
					if(responseText == "true"){
						alert($("#cfname").val() + " " + $("#clname").val() +  " was saved.");
						$( "#dialog_addcustomer" ).dialog( "close" );
					}else{
						alert("Sorry but the system was unable to save this customer.\nPlease tr again and if the problem persist, inform the developer.");	
					}
					
				},  
				"html"  
			);
		}
	}
	
	function domorevsetup(block_id){
		//alert("Dredix");
		var loadUrl = "index.php?route=ajax_vsetup&pagetype=ajax&rand=" + randomnum();
		var ajax_load = "<img src=\"images/gettingd.png\" />";
		  
        $('#TempDiv').load(loadUrl, function(){
			var thedata  = $('#TempDiv').html().replaceAll("blockid101",block_id);
			$('#morevsetup'+block_id).append(thedata);
			$('#TempDiv').html("");
        });   
	}
	
	function calc_netprice(blockid){
		var netrpice = parseFloat($("#qty_"+blockid).val()) * parseFloat($("#retailprice_"+blockid).val())
		if(netrpice > 0){$("#netprice_"+blockid).val(parseFloat(netrpice));}
		else{$("#netprice_"+blockid).val(0)}
	}
	
	function calc_vsetup(){
		var total = 0;
		var worktotal = 0;

		$(".netprice").each( function(){
				  total += $(this).val() * 1;
		});
		/*if(parseFloat($(".netprice").val()) >= 1){
			total = parseFloat($(".netprice").val());
		}*/
		//alert(total);
		
		for(x = 0; x < document.getElementsByClassName("vsetup").length; x++){
			var lvals = document.getElementsByClassName("vsetup").item(x).value.split(';');	//Seperating 
			if(lvals[1] >= 1 && document.getElementsByClassName("vsetupqty").item(x).value >= 1){
				worktotal = (parseFloat(lvals[1]) * parseFloat(document.getElementsByClassName("vsetupqty").item(x).value));
				total =	 total + worktotal;
				//alert("1: " + document.getElementsByClassName("vsetup").item(x).value + " \n2: " + document.getElementsByClassName("vsetupqty").item(x).value + " \nWork: " + worktotal  + " \nTotal: " + total);
			}
			
		}
		if(total > 0){$("#totalorder").val(total);}
		else{$("#totalorder").val(0);}
	}

	function formvalid(){
		var rules=new Array();
		rules[0]='orderentrydate:Order Entry Date|required';
		rules[1]='accountmanager:Account Manager|required';
		rules[2]='event_rush:Event/Rush|required';
		rules[3]='repeatorder:Repeat Order|required';
		rules[4]='mustshipbydate:Must Ship By|required';
		rules[5]='orderinhanddate:Order in hand Date|required';
		rules[6]='taxcode:Tax Code|required';
		rules[7]='cust_po:Customer PO Number|required';
		rules[8]='custname:Customer (Ordered By)|required';
		rules[9]='addressb:Billing Addres|required';
		rules[10]='cityb:Billing City|required';
		rules[11]='stateb:Billing State|required';
		rules[12]='addresss:Shipping Address|required';
		rules[13]='citys:Shipping City|required';
		rules[14]='states:Shipping States|required';
		rules[15]='vendor_id:Vendor|required';
		
		var cnt = 16;
		$("#products .vshipping_method").each( function(){
			rules[cnt]=  $(this).attr('id') + ':Shipping Method|required';
			cnt++;
		});
		$("#products .vitem_number").each( function(){
			rules[cnt]=  $(this).attr('id') + ':Item Number|required';
			cnt++;
		});	
		$("#products .vvendor_id").each( function(){
			rules[cnt]=  $(this).attr('id') + ':Vendor|required';
			cnt++;
		});	
		$("#products .vquantity").each( function(){
			rules[cnt]=  $(this).attr('id') + ':Quantity|required';
			cnt++;
			rules[cnt]=  $(this).attr('id') + ':Quantity|double';
			cnt++;
		});		
		$("#products .vretail_price").each( function(){
			rules[cnt]=  $(this).attr('id') + ':Retail Price|required';
			cnt++;
			rules[cnt]=  $(this).attr('id') + ':Retail Price|double';
			cnt++;
		});
		
		rules[cnt]='productcnt|notequal|0|At least one product is required.';
		cnt++;
		rules[cnt]='iagree|required|You must agree to the terms before submitting.';	
		
		return yav.performCheck('orderForm', rules, 'classic');	
	}


	
	var vrules=new Array();
	vrules[0]='vname:Vendor Name|required';
	
	var crules=new Array();
	crules[0]='cfname:First Name|required';
	crules[1]='clname:Last Name|required';
	crules[2]='cs_addressb:Billing Address|required';
	crules[3]='cs_cityb:Billing City|required';
	crules[4]='cs_stateb:Billing State|required';
	crules[5]='cs_zipcodeb:Billing Zipcode|required';
	crules[6]='cs_addresss:Shipping Address|required';
	crules[7]='cs_citys:Shipping City|required';
	crules[8]='cs_states:Shipping State|required';
	crules[9]='cs_zipcodes:Shipping Zipcode|required';	
	

	$("input#custname").autocomplete({
		source: "index.php?route=ajax_json_custinfo&pagetype=ajax",
		minLength: 2,
		select: function(event, ui) { 
			$("#customerid").val(ui.item.id);
			$("#companyb").val(ui.item.companyb);
			$("#companys").val(ui.item.companys);
			$("#attentionb").val(ui.item.attentionb);
			$("#attentions").val(ui.item.attentions);
			$("#addressb").val(ui.item.addressb);
			$("#addresss").val(ui.item.addresss);
			$("#address2b").val(ui.item.addressb);
			$("#address2s").val(ui.item.addresss);
			$("#cityb").val(ui.item.cityb);
			$("#citys").val(ui.item.citys);
			$("#stateb").val(ui.item.stateb);
			$("#states").val(ui.item.states);
			$("#zipcodeb").val(ui.item.zipcodeb);
			$("#zipcodes").val(ui.item.zipcodes);
		}
	});
	

	$("input#custname").autocomplete({
		source: "index.php?route=ajax_json_custinfo&pagetype=ajax",
		minLength: 2,
		select: function(event, ui) { 
			$("#customerid").val(ui.item.id);
			$("#companyb").val(ui.item.companyb);
			$("#companys").val(ui.item.companys);
			$("#attentionb").val(ui.item.attentionb);
			$("#attentions").val(ui.item.attentions);
			$("#addressb").val(ui.item.addressb);
			$("#addresss").val(ui.item.addresss);
			$("#address2b").val(ui.item.addressb);
			$("#address2s").val(ui.item.addresss);
			$("#cityb").val(ui.item.cityb);
			$("#citys").val(ui.item.citys);
			$("#stateb").val(ui.item.stateb);
			$("#states").val(ui.item.states);
			$("#zipcodeb").val(ui.item.zipcodeb);
			$("#zipcodes").val(ui.item.zipcodes);
		}
	});	
	
	function vendor_autocomplete(blockid){
		$("#vendorname"+blockid).autocomplete({
			source: "index.php?route=ajax_json_venderinfo&pagetype=ajax",
			minLength: 2,
			select: function(event, ui) { 
				$("#vendor_id_" + blockid).val(ui.item.id);
			}
		});
	}
</script>
<input type="hidden" id="tempwork" />

