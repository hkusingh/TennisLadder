<!-- LEFT SIDE START -->
<div id="left">
    <div id="left1">
        <?php echo $this->element('matches', array('numrows' => "10"));  ?>
        <br /><br />
        <br class="spacer" />        
        <img src="/img/arrow_red.gif" alt="arrow" class="icon" /><a href="/matchrecs/show">More Matches</a>
    </div><!-- end of left1 -->
</div><!-- LEFT SIDE END -->
<div id="right">
<div id="standing">
       <h2><?php echo $ladder; ?>'s Singles</h2>
<div id="standing-table">
       <table border="1" cellpadding="0" cellspacing="0"
            style="border-collapse: collapse" bordercolor="#09c"
    width="600">
      <tr>
        <th width="8%" class="theader">Rank</th>
        <th width="30%" class="theader">Name</th>
        <th width="12%" class="theader">Points</th>
        <th width="10%" class="theader">W</th>
        <th width="9%" class="theader">L</th>
        <th width="11%" class="theader">Win pct.</th>
        <th width="20%" class="theader">Last Played</th>
      </tr>
<?php
    $rank = 0;
    $lp = 'Never';
    $pp = 0;
    if($ranking) {
        $alternate = false;
        foreach ($ranking as $curr_rank) {
            //if ($curr_rank['Playerstat']['points'] == 0) {
			/* Everyone beyond this 0 so no need to rank them */
            	//break;
			//}		  
            if ($curr_rank['Playerstat']['last_played'] == '0000-00-00') {
               $lp = 'Never';
               continue;
            } else {
               $lp = $curr_rank['Playerstat']['last_played'];
            }
            if ($curr_rank['Playerstat']['points']  != $pp) {
               $rank++;
            }
            $fullname = $curr_rank['Player']['fname'] . " " .
                        $curr_rank['Player']['lname'];
             if ($alternate) {
                  echo "<tr class=\"mrow\">";
                  $alternate = false;
             }
             else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
            }
            $win = $curr_rank['Playerstat']['wins'];
            $loss = $curr_rank['Playerstat']['loss'];
            $totalplayed = $win + $loss;
            $winpercent = $win/$totalplayed;                        
            echo "<td align=\"center\">". $rank;
            echo "<td style=\"padding-left:10px\">" . $fullname;
            echo "<td style=\"padding-left:15px\">" . number_format($curr_rank['Playerstat']['points'],
                                                                    2, ".", '');
            echo "<td style=\"padding-left:10px\">" . $curr_rank['Playerstat']['wins'];
            echo "<td style=\"padding-left:10px\">" . $curr_rank['Playerstat']['loss'];
            echo "<td class=\"datacell\">" . number_format($winpercent, 2, '.', '');
            echo "<td class=\"datacell\">" . $lp;
            echo "</tr>";
            $pp = $curr_rank['Playerstat']['points'];
        }
    }
?>
         </table>
</div>
    <p class="rightBottom"></p>
    <br class="spacer" />
</div>
</div>
<br class="spacer" />
</div>         

