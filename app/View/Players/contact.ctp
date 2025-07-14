<div id="oneframe">
<div id="standing">

<?php 
	if ($ladder == 'Junior') {
?>
		<h2>Juniors - Under 12</h2>
		<div id="standing-table">
    	<table border="1" cellpadding="0" cellspacing="0"
    	style="border-collapse: collapse" bordercolor="#f0f0f0" width="730">
        <tr bgcolor="#666699">
        	<th width="3%" class="theader"></th>
        	<th width="35%" class="theader">Name</th>
        	<th width="25%" class="theader">Phone</th>
        	<th width="37%" class="theader">Email</th>
      	</tr>
<?php
		$id = 1;
		if($playera) {
        	$alternate = false;
        	foreach ($playera as $pa) {
            	$fullname = $pa['Player']['fname'] . " " .
                        $pa['Player']['lname'];
             	if ($alternate) {
               	   echo "<tr class=\"mrow\">";
                  	$alternate = false;
             	} else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
            	}                        
            	$phoneStr = "(".substr($pa['Player']['phone'], 0, 3).") "
               	         .substr($pa['Player']['phone'], 3, 3).
                        "-".substr($pa['Player']['phone'],6);
            	echo "<td align=\"center\">". $id;
            	echo "<td style=\"padding-left:10px\">" . $fullname;
            	echo "<td style=\"padding-left:10px\">" . $phoneStr;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['email'];
            		echo "</tr>";
			      $id++;
        	}
    	} 	
			if($playerb) {
?>
        </table>
        </div>
		<h2>Juniors - Under 16</h2>
		<div id="standing-table">
    	<table border="1" cellpadding="0" cellspacing="0"
    	style="border-collapse: collapse" bordercolor="#f0f0f0" width="730">
        <tr bgcolor="#666699">
        	<th width="3%" class="theader"></th>
        	<th width="35%" class="theader">Name</th>
        	<th width="25%" class="theader">Phone</th>
        	<th width="37%" class="theader">Email</th>
      	</tr>
      	<?php 			
        	$alternate = false;
        	$id = 1;
        	foreach ($playerb as $pa) {
            	$fullname = $pa['Player']['fname'] . " " .
                        $pa['Player']['lname'];
             	if ($alternate) {
               	   echo "<tr class=\"mrow\">";
                  	$alternate = false;
             	} else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
            	}                        
            	$phoneStr = "(".substr($pa['Player']['phone'], 0, 3).") "
               	         .substr($pa['Player']['phone'], 3, 3).
                        "-".substr($pa['Player']['phone'],6);
            	echo "<td align=\"center\">". $id;
            	echo "<td style=\"padding-left:10px\">" . $fullname;
            	echo "<td style=\"padding-left:10px\">" . $phoneStr;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['email'];
            		echo "</tr>";
			      $id++;
        	}
    	}    	 		
	} else {
?>

<?php		
		if($playera) {			
			$id = 1;
        	$alternate = false; ?>

			<h2><?php echo $ladder; ?> Active</h2>
			<div id="standing-table">
    		<table border="1" cellpadding="0" cellspacing="0"
    			style="border-collapse: collapse" bordercolor="#f0f0f0" width="730">
        	<tr bgcolor="#666699">
        		<th width="3%" class="theader"></th>
        		<th width="30%" class="theader">Name</th>
        		<th width="7%" class="theader">NTRP Rating</th>
        		<th width="25%" class="theader">Phone</th>
        		<th width="35%" class="theader">Email</th>
      		</tr>        	        	
        	<?php 
        	foreach ($playera as $pa) {
            	$fullname = $pa['Player']['fname'] . " " .
                        $pa['Player']['lname'];
             	if ($alternate) {
               	   echo "<tr class=\"mrow\">";
                  	$alternate = false;
             	} else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
            	}                        
            	$phoneStr = "(".substr($pa['Player']['phone'], 0, 3).") "
               	         .substr($pa['Player']['phone'], 3, 3).
                        "-".substr($pa['Player']['phone'],6);
            	echo "<td align=\"center\">". $id;
            	echo "<td style=\"padding-left:10px\">" . $fullname;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['rating'];
            	echo "<td style=\"padding-left:10px\">" . $phoneStr;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['email'];
            		echo "</tr>";
			      $id++;
        	} ?>
        	</table>
        	</div>
<?php 
    	}
    	if ($playerb) 	{
    				$id = 1;
        	$alternate = false; ?>

			<h2><?php echo $ladder; ?> Inactive</h2>
			<div id="standing-table">
    		<table border="1" cellpadding="0" cellspacing="0"
    			style="border-collapse: collapse" bordercolor="#f0f0f0" width="730">
        	<tr bgcolor="#666699">
        		<th width="3%" class="theader"></th>
        		<th width="30%" class="theader">Name</th>
        		<th width="7%" class="theader">NTRP Rating</th>
        		<th width="25%" class="theader">Phone</th>
        		<th width="35%" class="theader">Email</th>
      		</tr>        	        	
        	<?php 
        	foreach ($playerb as $pa) {
            	$fullname = $pa['Player']['fname'] . " " .
                        $pa['Player']['lname'];
             	if ($alternate) {
               	   echo "<tr class=\"mrow\">";
                  	$alternate = false;
             	} else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
            	}                        
            	$phoneStr = "(".substr($pa['Player']['phone'], 0, 3).") "
               	         .substr($pa['Player']['phone'], 3, 3).
                        "-".substr($pa['Player']['phone'],6);
            	echo "<td align=\"center\">". $id;
            	echo "<td style=\"padding-left:10px\">" . $fullname;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['rating'];
            	echo "<td style=\"padding-left:10px\">" . $phoneStr;
            	echo "<td style=\"padding-left:10px\">" . $pa['Player']['email'];
            		echo "</tr>";
			      $id++;
        	}    	
    	}	
	}
?>
</table>
</div>
    <br class="spacer" />
</div>
</div>

