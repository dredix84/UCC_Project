<?php
	session_checkstart();

	if(isset($_REQUEST["rtoken"]) && isset($_SESSION["rtoken"]) && $_SESSION["rtoken"] == $_REQUEST["rtoken"]){

$nowcat = "";
$db->query("SELECT rights FROM user_groups WHERE id = ".$_REQUEST["id"]);
$grights = $db->fetch_assoc();
if(isset($grights)){
	$grights = 	json_decode($grights["rights"]);
}else{
	$grights = 	array("empty", "empty");
}
//print_r($grights);
//die();

$db->query("SELECT DISTINCT category FROM rights");
?>
<form action="index.php" method="post">
<input type="submit" value="Save Rights" />
<input type="hidden" name="id" value="<?=$_REQUEST["id"]?>" />
<input type="hidden" name="action" value="save_rights" />
<input type="hidden" name="route" value="user_groups" />
<div id="accordion">
<?php
foreach($db->fetch_assoc_all() as $rcats){
//while ($rcats = $db->fetch_assoc()) {
?>
    <h3><?=$rcats["category"]?></h3>
    <div>
		<ul>
			<?php
            $db->query("SELECT * FROM rights WHERE category = '".$rcats["category"]."'");
            while ($right = $db->fetch_assoc()) {
				$rname = $right["rname"]."_".$right["category"];
				if(is_array($grights)){
					$checked = (in_array($rname, $grights)?'checked="checked"':"");
				}else{
					$checked = "";
				}
				//$checked = (in_array($rname, $grights)?'checked="checked"':"");
            	echo "<li><input type=\"checkbox\" name=\"right[]\" value=\"".$rname."\" ".$checked." /> - ".$right["title"]."</li>";
            }
            ?>
        </ul>
    </div>
<?php
}
?>

</div>
</form>
<?php	}else{ ?>
	<h1 style="text-align:center; color:red	">Access Denied</h1>
<?php	} ?>