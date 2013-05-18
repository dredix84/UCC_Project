<?php

	global $dcheck;
	if(!isset($dcheck)) die("<span style=\"color:red\">Restricted Access !!!!</span>");
	session_checkstart();
	logincheck();
	
	$pagetitle = "Project Events";
	
	
	$db->query('SELECT * FROM calendar_events ', array());
	$records = $db->fetch_assoc_all();
	
	sendsms(array("8764204881", "8768201940"), "This is just a test message");
	
?>
	<link rel="stylesheet" type='text/css' href="css/fullcalendar.css" />
	<script src="js/fullcalendar/fullcalendar.min.js"></script>
  <div class="content container_12">
      <div class="box grid_12">
        <div class="box-head"><h2>Calendar</h2></div>
        <div class="box-content">
          <div id="calendar"></div>
        </div>
      </div>
  </div>

<script> /* SCRIPTS */

  $(document).ready(function() {
  
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: false,
	  

      events: [
	  
		<?php
		for($r = 0; $r < count($records); $r++){
		?>
        {
			id: '<?=$records[$r]["event_id"]?>',
			title: '<?=htmlentities($records[$r]["title"])?>',
			start: '<?=$records[$r]["date_created"]?>',
			//end: new Date(y, m, d-2)
			url: 'http://google.com/'
        },
		<?php } ?>

      ]
    });
    
  });
</script>