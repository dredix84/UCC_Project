<?php
	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	logincheck();
	

	
	if(!isset($_REQUEST["id"])){
		
	}else{
		$clientid = $_REQUEST["id"];
		$db->query('SELECT *,
(SELECT t.report_date FROM client_tickets t WHERE t.client_id = c.id ORDER BY t.report_date DESC LIMIT 1) as last_ticket,
(SELECT count(t2.id) FROM client_tickets t2 WHERE t2.client_id = c.id) as ticket_count
FROM `client` c WHERE c.id = '.$db->escape($clientid));
		$cinfo = $db->fetch_assoc();	
	}
	
	//Prevent double submission of data
	if(isset($_REQUEST["PME_sys_saveadd"])){
		header("Location: index.php?route=clientticket&id=".$clientid);
	}
	
	$pagetitle = "Client Tickets";
	$opts['page_name'] = 'index.php?route=clientticket&id='.$clientid;
?>
	<style>
		dl{
			font-size: 12px;
		}
		dt{
			font-weight: bold;
			width: 120px;
			float: left;
			margin-bottom: 5px;
		}
		dd{
			margin-bottom: 5px;
		}
		.ad-stats ul h3{
			font-size: 13px;
		}
	</style>

    <div class="sm-box grid_12">
        <span>
            <h2>Actions</h2>
            <a href="index.php?PME_sys_operation=PME_op_Change&PME_sys_rec=<?=$cinfo["id"]?>"><button class="button green">Update Client Data</button></a>
            <a href="<?=$opts['page_name']?>&PME_sys_operation=Add#Add"><button class="button green">Add Ticket</button></a>

        </span>
    </div>

    <div class="box grid_3">
        <div class="box-head"><span class="box-icon-24 fugue-24 card-address"></span><h2>General Information</h2></div>
        <div class="box-content">
        
            <dl>
                <dt>Provider Type</dt><dd><?=$cinfo["provider_type"]?></dd>
            	<dt>Provider Name</dt><dd><?=$cinfo["provider_name"]?></dd>
                <dt>Company Name</dt><dd><?=$cinfo["company_name"]?></dd>
                <dt>Sign on Date</dt><dd><?=$cinfo["sign_on_date"]?></dd>
                <dt>Status</dt><dd><?=($cinfo["status"]==1?"<span style=\"color:green\">Active<span>":"Inactive")?></dd>
            </dl>
        </div>
    </div>
    
    <div class="box grid_3">
        <div class="box-head"><span class="box-icon-24 fugue-24 card-address"></span><h2>Contact Details</h2></div>
        <div class="box-content">
        
            <dl>
                <dt>Email</dt><dd><?=$cinfo["email"]?></dd>
            	<dt>Telephone</dt><dd><?=$cinfo["telephone"]?></dd>
                <dt>Fax</dt><dd><?=$cinfo["fax"]?></dd>
                <dt>Address</dt><dd><?=$cinfo["address"]?></dd>
            </dl>
        </div>
    </div>
    
    <div class="box grid_3">
        <div class="box-head"><span class="box-icon-24 fugue-24 card-address"></span><h2>Other Details</h2></div>
        <div class="box-content">
        
            <dl>
                <dt>SAG Prov #</dt><dd><?=$cinfo["sag_prov_no"]?></dd>
            	<dt>MED Prov #</dt><dd><?=$cinfo["med_prov_no"]?></dd>
                <dt>Prov Name</dt><dd><?=$cinfo["prov_name"]?></dd>
                <dt>Date Added</dt><dd><?=$cinfo["date_added"]?></dd>
            </dl>
        </div>
    </div>
    
    <div class="box grid_3">
        <div class="box-head"><span class="box-icon-24 fugue-24 inbox-document"></span><h2>Documents</h2></div>
        <div class="box-content ad-stats">
            <ul>
                <li><h3><?=($cinfo["last_ticket"] != ""?$cinfo["last_ticket"]:"None")?></h3> Last Ticket</li>
                <li><h3><?=$cinfo["ticket_count"]?></h3> Ticket Count</li>
            </ul>
        </div>
    </div>
    

      
      
 
 
 
<?php

$opts['hn'] = DBHOST;
$opts['un'] = DBUSER;
$opts['pw'] = DBPASS;
$opts['db'] = DBNAME;
$opts['tb'] = 'client_tickets';



// Name of field which is the unique key
$opts['key'] = 'id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
$opts['sort_field'] = array('id');

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 15;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'ACPVD';

// Number of lines to display on multiple selection filters
$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'DG';
$opts['buttons']['L']['up'] = array(/*'<<','<','add','view','change','copy','delete', '>','>>','goto','goto_combo'*/);
$opts['buttons']['L']['down'] = $opts['buttons']['L']['up'];

// Display special page elements
$opts['display'] = array(
	'form'  => true,
	'query' => false,
	'sort'  => false,
	'time'  => false,
	'tabs'  => false
);

// Set default prefixes for variables
$opts['js']['prefix']               = 'PME_js_';
$opts['dhtml']['prefix']            = 'PME_dhtml_';
$opts['cgi']['prefix']['operation'] = 'PME_op_';
$opts['cgi']['prefix']['sys']       = 'PME_sys_';
$opts['cgi']['prefix']['data']      = 'PME_data_';

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
$opts['language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '-UTF8';

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.

$opts['filters'] = "column1 like '%11%' AND column2<17";

$opts['filters'] = "PMEtable0.sessions_count > 200";
*/

$opts['filters'] = "client_id= ".$db->escape($clientid);

/* Field definitions
   
Fields will be displayed left to right on the screen in the order in which they
appear in generated list. Here are some most used field options documented.

['name'] is the title used for column headings, etc.;
['maxlen'] maximum length to display add/edit/search input boxes
['trimlen'] maximum length of string content to display in row listing
['width'] is an optional display width specification for the column
          e.g.  ['width'] = '100px';
['mask'] a string that is used by sprintf() to format field output
['sort'] true or false; means the users may sort the display on this column
['strip_tags'] true or false; whether to strip tags from content
['nowrap'] true or false; whether this field should get a NOWRAP
['select'] T - text, N - numeric, D - drop-down, M - multiple selection
['options'] optional parameter to control whether a field is displayed
  L - list, F - filter, A - add, C - change, P - copy, D - delete, V - view
            Another flags are:
            R - indicates that a field is read only
            W - indicates that a field is a password field
            H - indicates that a field is to be hidden and marked as hidden
['URL'] is used to make a field 'clickable' in the display
        e.g.: 'mailto:$value', 'http://$value' or '$page?stuff';
['URLtarget']  HTML target link specification (for example: _blank)
['textarea']['rows'] and/or ['textarea']['cols']
  specifies a textarea is to be used to give multi-line input
  e.g. ['textarea']['rows'] = 5; ['textarea']['cols'] = 10
['values'] restricts user input to the specified constants,
           e.g. ['values'] = array('A','B','C') or ['values'] = range(1,99)
['values']['table'] and ['values']['column'] restricts user input
  to the values found in the specified column of another table
['values']['description'] = 'desc_column'
  The optional ['values']['description'] field allows the value(s) displayed
  to the user to be different to those in the ['values']['column'] field.
  This is useful for giving more meaning to column values. Multiple
  descriptions fields are also possible. Check documentation for this.
*/

$opts['fdd']['id'] = array(
  'name'     => 'ID',
  'select'   => 'T',
  'options'  => 'DH', // auto increment
  'maxlen'   => 10,
  'default'  => '0',
  'sort'     => true
);
$opts['fdd']['client_id'] = array(
  'select'   => 'T',
  'options'  => 'APH',
  'default'	 => $clientid
);
$opts['fdd']['date_created'] = array(
  'select'   => 'T',
  'options'  => 'APH',
  'default'	 => mysqlnow("Y-m-d")
);
$opts['fdd']['caller'] = array(
  'name'     => 'Caller',
  'select'   => 'T',
  'maxlen'   => 45,
  'sort'     => true
);
$opts['fdd']['reported_issue'] = array(
  'name'     => 'Reported issue',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);
$opts['fdd']['outcome'] = array(
  'name'     => 'Outcome',
  'select'   => 'T',
  'maxlen'   => 100,
  'sort'     => true
);

$opts['fdd']['issue_type'] = array(
  'name'     => 'Issue type',
  'select'   => 'R',
  'maxlen'   => 10,
  'sort'     => true,
  'values'	 => array("table" => "issue_type","column" => "id", "description" => "title")
);
$opts['fdd']['agent'] = array(
  'name'     => 'Agent',
  'select'   => 'D',
  'maxlen'   => 10,
  'sort'     => true,
  'values'	 => array("table" => "users","column" => "id", "description" => "username")
);
$opts['fdd']['report_date'] = array(
  'name'     => 'Report date',
  'select'   => 'T',
  'maxlen'   => 10,
  'css'		 => array('postfix' => ' datepicker'),
  'sort'     => true,
  'default'	 => mysqlnow()
);
$opts['fdd']['status'] = array(
  'name'     => 'Status',
  'select'   => 'T',
  'maxlen'   => 10,
  'sort'     => true,
  'values2'	 => array(1 => 'Completed', 0 => 'Open')
);
$opts['fdd']['created_by'] = array(
  'name'     => 'Created by',
  'select'   => 'D',
  'maxlen'   => 10,
  'options'  => 'AVPDR',
  'sort'     => true,
  'values'	 => array("table" => "users","column" => "id", "description" => "username"),
  'default'	 => $_SERVER["user_info"]["id"]
);
$opts['fdd']['notes'] = array(
  'name'     => 'Notes',
  'select'   => 'T',
  'options'  => 'AVCPD',
  'maxlen'   => 65535,
  'textarea' => array(
    'rows' => 5,
    'cols' => 50),
  'sort'     => true
);

 ?>
 
 
 
 
 <div class="box grid_12">
    <div class="box-head">
    	<span class="box-icon-24 fugue-24 notebook"></span><h2>Ticket</h2>
    </div>
    <div class="box-content no-pad">
        <ul class="table-toolbar">
			<?php if(!isset($_REQUEST["PME_sys_operation"])){ ?>
            
            	<li><a href="<?=$opts['page_name']?>&PME_sys_operation=Add" title="Add ticket to client" class="ttip-top"><img src="images/ticket_plus.png" alt="" /> Add Ticket</a></li>
                <li><a href="index.php" title="Go back to list of clients" class="ttip-top"><img src="images/user_enabled.png" alt="" /> Select a different client</a></li>
            
            <?php }else{ ?>
            	<li><a name="Add" href="<?=$opts['page_name']?>"><img src="images/ticket.png" alt="" /> Back to tickets</a></li>
            <?php } ?>
        </ul>
    <?php new phpMyEdit($opts); ?>
    </div>
</div>
 
    <?php 
	$cnote = $cinfo["note"];
	if($cnote != ""){ ?>
    <div class="box grid_6">
        <div class="box-head"><span class="box-icon-24 fugue-24 balloon"></span><h2>Note</h2></div>
        <div class="box-content">
        	<p><?=$cinfo["note"]?></p>
        </div>
    </div>
    <?php } ?>