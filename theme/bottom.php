  </div>

<div class="footer">
  <!--<p>Powered by Adminity Administration Interface</p> -->
</div>

<script> /* SCRIPTS */
  $(function () {
      var sin = [], cos = [];
      for (var i = 0; i < 14; i += 0.5) {
          sin.push([i, Math.sin(i)]);
          cos.push([i, Math.cos(i)]);
      }
	  /*
      var plot = $.plot($("#flot-demo"),
             [ { data: sin, label: "Green", color: "#71a100"}, { data: cos, label: "Blue", color: "#308eef" } ], {
                 series: {
                     lines: { show: true },
                     points: { show: true }
                 },
                 grid: { hoverable: true },
                 yaxis: { min: -1.2, max: 1.2 }
               });
      var previousPoint = null;
      $("#flot-demo").bind("plothover", function (event, pos, item) {
          if ($("#enablePosition:checked").length > 0) {
              var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
              $("#hoverdata").text(str);
          }
      });*/
  });/* for the flot chart demo */

  $('#example').dataTable( {
      "bJQueryUI": true
  }); /* For the data tables */
</script>

<script>
	$(".datepicker").datepicker({
		dateFormat: 'yy-mm-dd'
		/*changeMonth: true,
		changeYear: true*/
	});
	//$('.iphone-check').iphoneStyle();
	
	$('.pme-main').dataTable( {
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"   
    }); /* For the data tables */
	
	$('.ttip-top').tipTip({attribute: "title", delay: "100", defaultPosition: "top"});
</script>



<?php if(DODEBUG == true){ ?>
<br />
<a style="margin:10px;" class="button blue" href="http://localhost/conproj/lib/phpmyedit/phpMyEditSetup.php?hn=<?=DBHOST?>&db=<?=DBNAME?>&un=<?=DBUSER?>&pw=<?=DBPASS?>&submit=Submit&tb=" target="_blank">Code Generator</a>
<br /><br />

<pre style="background-color:#FFFFFF; border:2px solid #999; margin: 10px; font-size:11px; padding:10px">
REQUEST ============================
<?php print_r($_REQUEST) ?>


SESSION=============================
<?php print_r($_SESSION) ?>
</pre>
<?php } ?>

</body>


</html>