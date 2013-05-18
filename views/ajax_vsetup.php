<?php
	$blockid = rand(0,100000);
	if(isset($_REQUEST["rand"])){$blockid .= $_REQUEST["rand"];}
?>

<div id="vsetuptemp_<?=$blockid?>" class="vsetupdiv">
<a onclick="$('#vsetuptemp_<?=$blockid?>').remove();"><img src="images/delete.png" /></a>
Vendor Setup <input type="text" name="vsetup[]" id="vsetup_<?=$blockid?>" class="vsetup" />
# of Setups <input type="number" name="vsetupqty[]" id="vsetupqty_<?=$blockid?>" class="vsetupqty" min="1" value="1" onchange="fullcalc()"/><br />

Setup Net Price Per: <input type="text" style="width:100px" name="setup_net_price_per[]" id="setup_net_price_per<?=$blockid?>" onchange="fullcalc()" />  
&nbsp;&nbsp;&nbsp;
Setup Retail Price Per:  
<input type="text" style="width:100px" name="setup_retail_price_per[]" id="setup_retail_price_per<?=$blockid?>" onchange="fullcalc()" />
<input id="vsetupid_<?=$blockid?>" value="<?=$blockid?>" type="hidden" class="vsetupid" />
<input name="vsetup_prodid[]" id="vsetup_prodid_<?=$blockid?>" value="blockid101" type="hidden" /> 
</div>