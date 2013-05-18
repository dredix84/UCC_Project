<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	if(!isset($_SESSION["userinfo"])){header("location:index.php?route=login");}
	
	$pagetitle = "Users";
	$showform = false;
	$showform_edit = false;
// include the Zebra_Form class
//require 'path/to/Zebra_Form.php';
?>


    <!-- try to load jQuery from CDN server and fallback to local source if not available -->

<?php
	
	if(isset($_REQUEST["del_uid"])){
		$db->delete('users', 'id = '.$db->escape($_REQUEST["del_uid"]));
	}
	
	if(isset($_REQUEST["uid"])){
		$db->select('*','users', "id = ".$db->escape($_REQUEST["uid"]));
        $row = $db->fetch_assoc_all();
		$showform_edit = true;
	}


    $form = new Zebra_Form('frm_saveuser', "POST", "index.php?route=users");
	$form->show_all_error_messages(true);
	$form->clientside_validation(true);


	
    //First name
    $form->add('label', 'label_firstname', 'firstname', 'First name:');
    $obj =  $form->add('text', 'firstname',checkset($row[0]["fname"]));
    $obj->set_rule(array(
        'required'  =>  array('error', 'First name is required!')
    ));

    // "last name"
    $form->add('label', 'label_lastname', 'lastname', 'Last name:');
    $obj = & $form->add('text', 'lastname',checkset($row[0]["lname"]));
    $obj->set_rule(array(
        'required' => array('error', 'Last name is required!')
    ));

	//Username
    $form->add('label', 'label_username', 'username', 'Username:');
    $obj = & $form->add('text', 'username',checkset($row[0]["username"]));
    $obj->set_rule(array(
        'required'  => array('error', 'Username is required!')
    ));
	
	//Email
    $form->add('label', 'label_email', 'email', 'Email:');
    $obj = & $form->add('text', 'email',checkset($row[0]["email"]));
    $obj->set_rule(array(
        'required'  => array('error', 'Email is required!')
    ));	


    // "Password"
    $form->add('label', 'label_password', 'password', 'Password:');
    $obj = & $form->add('password', 'password',(isset($row[0]["email"]) ? "@NO CHANGE@":""));
    $obj->set_rule(array(
        'required'  => array('error', 'Password is required!'),
        'length'    => array(4, 20, 'error', 'The password must have between 6 and 20 characters'),
    ));
    $form->add('note', 'note_password', 'password', 'Password must be have between 6 and 20 characters.');
	if(isset($row[0]["email"])){$form->add('note', 'note_password', 'password', 'A password is already set but you can change it by typing a new one.');}
	
	//User Group
	$form->add('label', 'label_user_group', 'user_group', 'User Group:');
	$obj = &$form->add('select', 'status',checkset($row[0]["status"]));
	$obj->add_options(array(
		'1' => 'Yes',
		'0' => 'No'
	));
	$form->add('note', 'note_status', 'status', 'This will determine if the user is allowed to login.');
	$obj->set_rule(array(
		'required'  => array('error', 'Select user status!')
	));	
	
	//Status
	$form->add('label', 'label_status', 'status', 'Active:');
	$obj = &$form->add('select', 'status',checkset($row[0]["status"]));
	$obj->add_options(array(
		'1' => 'Yes',
		'0' => 'No'
	));
	$form->add('note', 'note_status', 'status', 'This will determine if the user is allowed to login.');
	$obj->set_rule(array(
		'required'  => array('error', 'Select user status!')
	));	

	/*/User Group
	$form->add('label', 'label_ugroup', 'ugroup', 'User Group:');
    $obj = &$form->add('select', 'ugroup',checkset($row[0]["usergroup_id"]));
	$obj->add_options(inputarray("id", "name", "id,name", "user_group"));	//Getting dropdown list
	$form->add('note', 'note_ugroup', 'ugroup', 'The User Group will determine the permission the user will have.');
	$obj->set_rule(array(
		'required'  => array('error', 'A User Group is required!')
	));*/
	


	//ID if exist
	if(checkset($row[0]["id"]) != ""){
		$obj = &$form->add('hidden', 'id', checkset($row[0]["id"]));
	}
    // "submit"
    $form->add('submit', 'btnsubmit', 'Submit');

    
    if ($form->validate()) {

        //$nowdate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', time())));
        $dbd["fname"] 		= $_REQUEST["firstname"];
		$dbd["lname"] 		= $_REQUEST["lastname"];
		$dbd["username"] 	= $_REQUEST["username"];
		if($_REQUEST["password"] != "@NO CHANGE@"){ $dbd["password"] 	= md5($_REQUEST["password"]);}
		$dbd["email"] 		= $_REQUEST["email"];
		//$dbd["usergroup_id"]= $_REQUEST["ugroup"];
		$dbd["status"] 		= $_REQUEST["status"];
		$dbd["salesperson_id"] = $_REQUEST["salesperson_id"];
		$dbd["salesperson"] = $_REQUEST["issalesperson"];
		$dbd["account_manager"] = $_REQUEST["isaccountmanager"];
		$dbd["admin"] = $_REQUEST["isadmin"];
		$dbd["datecreated"] = mysqlnow();
		
		echo "<div class=\"user_addeditform dtoggle\" style=\"display:none\">"; 
		if(isset($_REQUEST["id"])){
			$didsave = 	$db->update('users',$dbd, "id = ".$db->escape($_REQUEST["id"]));
		}else{
			$didsave = 	$db->insert('users',$dbd);
		}
		if ($didsave){
			echo "The data has beens saved.";
			$form->render('*horizontal');
		}else{
			echo "There was an error while attempting to save data.";
			$form->render('*horizontal');
			$showform = true;
		}
		
    } else{
		echo "<div class=\"user_addeditform dtoggle\" style=\"display:none\">"; 
        $form->render('*horizontal');
		if(isset($_REQUEST["name_frm_saveuser"])){		//Checking if the user just arrived on the page
			$showform_edit = true;
		}
		
	}
	?>
	 <a onClick="editdata_toggle()" class="jbtn">Cancel</a><br>
    </div>
    
    <div class="user_datatable dtoggle">
    
    
    <div class="sm-box grid_12">
        <span>
            <h2>Actions</h2>
    			<a onClick="editdata_toggle()" class=""><button class="button green">Add New</button></a><br>

        </span>
    </div>


<div class="box grid_12">
    <div class="box-head">
    	<h2>Client</h2>
    </div>
    <div class="box-content no-pad">
        <table border="0" class="dtable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
    
    <?php
        //Creating user table
        $db->select('*','users');
        $records = $db->fetch_assoc_all();
    
        foreach($records as $row){
        //while ($row = $db->fetch_assoc()) {
    ?>
                <tr>
                    <td>
                    	<a href="?route=users&uid=<?=$row["id"]?>">
                        	<strong><?=$row["fname"]." ".$row["lname"]?></strong>
                        </a>
                    </td>
                    <td><?=$row["username"]?></td>
                    <td><?=$row["email"]?></td>
                    <td><?=($row["status"]?"<img src=\"images/user_enabled.png\" title=\"Account enabled\">":"<img src=\"images/user_disabled.png\" title=\"Account disabled\">")?></td>
                    <td>
						<a href="?route=users&uid=<?=$row["id"]?>"><img src="images/document_edit_16.png"></a>
                        <a href="?route=users&del_uid=<?=$row["id"]?>"><img src="images/delete.png"></a>
                    </td>
                </tr>
    <?php
        }
    ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
    
    
    <style>
		.user_addeditform {
			/*border: 1px solid blue;*/
			margin: 10px auto;
			padding: 15px;
			width: 550px;
			background-color:#FFF;
			border-radius:5px;
		}
		.user_datatable {
			/*border: 1px solid blue;*/
			margin: 10px auto;
			padding: 5px;
			width: 96%;
		}
	</style>
    <script type="text/javascript">
		
		function editdata_toggle(){
			$(".dtoggle").toggle("slow");
			$(".control").val("");
			$("#id").val("");
			return false;
		}
		function editdata_toggle2(){
			//Does not clear fields
			$(".dtoggle").toggle("slow");
			return false;
		}
		<?=($showform ? "editdata_toggle();":"")?>
		<?=($showform_edit ? "editdata_toggle2();":"")?>
		
		$( ".jbtn" ).button();
		
		$(".dtable").dataTable();

	</script>