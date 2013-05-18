<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	$pagetitle = "Login";
	
	
	$form = new Zebra_Form('frm_saveuser', "POST", "index.php?route=login");
	$form->show_all_error_messages(true);
	$form->clientside_validation(true);
	
	
	//Username
    $form->add('label', 'label_username', 'username', 'Username:');
    $obj = & $form->add('text', 'username');
    $obj->set_rule(array(
        'required'  => array('error', 'Username is required!')
    ));
	

    // "Password"
    $form->add('label', 'label_password', 'password', 'Password:');
    $obj = & $form->add('password', 'password');
    $obj->set_rule(array(
        'required'  => array('error', 'Password is required!'),
        'length'    => array(4, 20, 'error', 'The password must have between 4 and 20 characters'),
    ));
	
	$form->add('submit', 'btnsubmit', 'Submit');
	
	if ($form->validate()) {
		$db->query("SELECT * FROM users WHERE username = '".$db->escape($_POST["username"])."' AND password = md5('".$db->escape($_POST["password"])."')");
		$records = $db->fetch_assoc_all();
		if(count($records)){
			session_checkstart();
			$_SESSION["userinfo"] = $records[0];
			//die(print_r($_SESSION["userinfo"],true));
			session_write_close();
			header("location:index.php?route=home");
		}else{
			echo '<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all">
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
					<strong>Login failed:</strong> The username and/or password you entered is invalid.</p>
				</div>';
			renderform($form->render('*horizontal',true));
		}
	}else{
		
		renderform($form->render('*horizontal',true));
	}
	
	function renderform($form){
		echo "<div style=\"width: 340px; margin: 10px auto;background-color: #FFF;padding: 10px;border-radius: 5px;\">";
		echo $form;
		echo "</div>";
	}
?>
