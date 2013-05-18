<?php
$tables = array("taxcode" => "Tax Codes", 
				"shipping_methods" => "Shipping Methods", 
				"state" => "States",
				"vendors" => "Vendors",
				"customers" => "Customers;index.php?route=customers",
				"event_rush" => "Event/Rush");
	if(isset($_REQUEST["table"])){
		$pagetitle = "Setup - ".$tables[$_REQUEST["table"]];
	}else{
		$pagetitle = "Setup";
	}
	
if(count($tables)>0){
?>
<style>
	.setupnav{
		list-style:none;
	}
	.setupnav li.selected {
		background-color: #618CA5;
		color: #FFF !important;
		display:inline;
	}
	.setupnav li{
		display:inline;	
		margin: 2px;
	}
	.setupnav li.selected {
		color: #FFF !important;
	}
	table.ajaxCRUD{
		margin:10px;
		width:96%;
	}
</style>
	<ul class="setupnav">
    	<?php
		//$pagetitle = "Setup";
		ksort($tables);
		foreach($tables as $tname => $ttitle){
			if($_REQUEST["table"] == $tname){$iclass = ' class="selected" ';}else{ $iclass = '';}
			$titlelink = explode(";",$ttitle);
			if(count($titlelink)>1){
				echo "<li $iclass><a class=\"jbtn\" href=\"$titlelink[1]\">$titlelink[0]</a></li>";
			}else{
				echo "<li $iclass><a class=\"jbtn\" href=\"?route=".$_REQUEST["route"]."&table=$tname\">$ttitle</a></li>";
			}
		}
		?>
    </ul>
    <hr style="margin-bottom:25px" />	
<?php
}else{
	echo "No tables<br />";	
}

if(isset($_REQUEST["table"])){
	switch ($_REQUEST["table"])
	{
	case "taxcode":
		$tbl = new ajaxCRUD("Tax Code", "taxcode", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		$tbl->displayAs("code", "Title");
		$tbl->displayAs("taxrate", "Tax %");
		$tbl->showTable();
		break;
	case "shipping_methods":
		$tbl = new ajaxCRUD("Shipping Method", "shipping_methods", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		$tbl->displayAs("title", "Title");
		$tbl->showTable();
		break;
	case "state":
		$tbl = new ajaxCRUD("State", "state", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		//$tbl->addAjaxFilterBox('name', 20);
		$tbl->setLimit(100);
		$tbl->displayAs("code", "Code");
		$tbl->displayAs("name", "Name");
		$tbl->showTable();
		break;
	case "event_rush":
		$tbl = new ajaxCRUD("Event/Rush", "event_rush", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		//$tbl->setLimit(20);
		$tbl->displayAs("description", "Description");
		$tbl->displayAs("rate", "Rate");
		$tbl->showTable();
		break;
	case "vendors":
		$tbl = new ajaxCRUD("Vendor", "vendors", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		$tbl->omitField ("otherinfo");
		$tbl->displayAs("vname", "Vendor Name");
		$tbl->displayAs("contactperson", "Contact Person");
		$tbl->displayAs("phone", "Phone");
		$tbl->displayAs("otherinfo", "Other Info");
		//$tbl->addButtonToRow("Edit", "myOwnUpdateForm.php", "id");
		$tbl->showTable();
		break;		
	case "customers":
		$tbl = new ajaxCRUD("Customer", "customers", "id");
		$tbl->displayAddFormTop();
		$tbl->omitPrimaryKey();
		$tbl->setOrientation("vertical");
		$tbl->setLimit(5);
		/*$tbl->omitField ("otherinfo");
		$tbl->displayAs("vname", "Vendor Name");
		$tbl->displayAs("contactperson", "Contact Person");
		$tbl->displayAs("phone", "Phone");
		$tbl->displayAs("otherinfo", "Other Info");
		//$tbl->addButtonToRow("Edit", "myOwnUpdateForm.php", "id");*/
		$tbl->showTable();
		break;			
	default:
		echo "<h3 style=\"text-align:center\">Click one of the buttons above to adjust options.</h3>";
	}
}else{
	
	echo "<h3 style=\"text-align:center\">Click one of the buttons above to adjust options.</h3>";	
}



?>

<script>
	$(document).ready(function() {
		$('table.ajaxCRUD').dataTable( {
			"sPaginationType": "full_numbers"
    	} );
	} );
</script>