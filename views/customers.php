<?php

	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	logincheck();
	
	$pagetitle = "Customers";

$opts['hn'] = DBHOST;
$opts['un'] = DBUSER;
$opts['pw'] = DBPASS;
$opts['db'] = DBNAME;
$opts['tb'] = 'customers';

// Name of field which is the unique key
$opts['key'] = 'id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
$opts['sort_field'] = array('id');
$opts['page_name'] = 'index.php?route=customers';

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = -1;

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
$opts['filters'] = "section_id = 9";
$opts['filters'] = "PMEtable0.sessions_count > 200";
*/

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
  'options'  => 'AVCPDH', // auto increment
  'maxlen'   => 10,
  'default'  => '0',
  'sort'     => true
);
$opts['fdd']['name'] = array(
  'name'     => 'Name',
  'select'   => 'T',
  'maxlen'   => 50,
  'sort'     => true
);
$opts['fdd']['telephone'] = array(
  'name'     => 'Telephone',
  'select'   => 'T',
  'maxlen'   => 16,
  'sort'     => true
);
$opts['fdd']['fax'] = array(
  'name'     => 'Fax',
  'select'   => 'T',
  'options'  => 'ACPD',
  'maxlen'   => 16,
  'sort'     => true
);
$opts['fdd']['contact'] = array(
  'name'     => 'Contact',
  'select'   => 'T',
  'maxlen'   => 30,
  'sort'     => true
);
$opts['fdd']['cellphone'] = array(
  'name'     => 'Cellphone',
  'select'   => 'T',
  'maxlen'   => 16,
  'sort'     => true
);
$opts['fdd']['other_tel'] = array(
  'name'     => 'Other tel',
  'select'   => 'T',
  'options'  => 'ACPD',
  'maxlen'   => 16,
  'sort'     => true
);
$opts['fdd']['alt_contact'] = array(
  'name'     => 'Alt contact',
  'select'   => 'T',
  'options'  => 'ACPD',
  'maxlen'   => 30,
  'sort'     => true
);
$opts['fdd']['alt_tel'] = array(
  'name'     => 'Alt tel',
  'select'   => 'T',
  'options'  => 'ACPD',
  'maxlen'   => 16,
  'sort'     => true
);


?>
<div class="box grid_12">
    <div class="box-head">
    	<span class="box-icon-24 fugue-24 card-address"></span><h2><?=(isset($pagetitle)?$pagetitle:"")?></h2>
    </div>
    <div class="box-content no-pad">
          <ul class="table-toolbar">
            <?php if(!mode_addedit()){ ?><li><a href="index.php?route=<?=(isset($_REQUEST["route"])?$_REQUEST["route"]:"")?>&PME_sys_operation=Add" title="Add <?=(isset($pagetitle)?$pagetitle:"")?>" class="ttip-top"><img src="images/add.png" alt="" /> Add</a></li><?php } ?>
          </ul>
    <?php
    new phpMyEdit($opts);
    ?>
    </div>
</div>

<div id='uimodal-output' title=""></div>

<script>
/*
$('a.rights_diag').bind('click', function() {
   var $this = $(this);
   var outputHolder = $("#uimodal-output");//$("<div id='.uimodal-output'></div>");
   //$("body").append(outputHolder);
   outputHolder.load($this.attr("href"), null, function() {
		outputHolder.dialog({
			height: 400,
			modal: true,
			collapsible: true
		});
		$( "#accordion" ).accordion();
   });
   return false;
});*/

$('a.view_img').bind('click', function() {
   var $this = $(this);
   var outputHolder = $("#uimodal-output");//$("<div id='.uimodal-output'></div>");
   //$("body").append(outputHolder);
   outputHolder.load($this.attr("href")+"&pagetype=ajax&notoken=1", null, function() {
		outputHolder.dialog({
			height: 400,
			modal: true,
			collapsible: true
		});
		$( "#accordion" ).accordion();
   });
   return false;
});
</script>

