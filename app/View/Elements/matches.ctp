<?php 
$para = "/matchrecs/index/" . $numrows;
$matches = $this->requestAction($para); ?>
<div id="member">  
  <h2>Recent Matches</h2>
  <div id="match-table">
    <table border="0" cellpadding="0" cellspacing="2"
     style="border-collapse: collapse" bordercolor="#111111">
<?php
    $changedate = true;
    $prev_date = null;
    foreach ($matches as $thismatch) {
        $winner_score = null;
        $lscore = null;
        $curr_date = $thismatch['Matchrec']['date'];
        if ($prev_date != $curr_date) {
            $prev_date = $curr_date;
            $changedate = true;
        }
        $match_date = explode("-", $thismatch['Matchrec']['date']);
        $my  = $match_date[0];
        $mm  = $match_date[1];
        $md  = $match_date[2];
        if ($changedate) {
       	    echo "<tr bgcolor=#09c>";
            echo "<td colspan=3 class=date>" .
            date("l, F j, Y", mktime(0,0,0,$mm, $md, $my));
            echo "</tr>";
                $changedate = false;
        }
        $winner_score = $thismatch['Matchrec']['wset1'];
        $lscore = $thismatch['Matchrec']['lset1'];
        if ($thismatch['Matchrec']['wtb1'] || $thismatch['Matchrec']['ltb1']) {
	        $winner_score = $winner_score . "(". $thismatch['Matchrec']['wtb1'] . ")";
            $lscore = $lscore . "(". $thismatch['Matchrec']['ltb1'] . ")";
        }
        $winner_score = $winner_score . " " . $thismatch['Matchrec']['wset2'];
        $lscore = $lscore . " " . $thismatch['Matchrec']['lset2'];
        if ($thismatch['Matchrec']['wtb2'] || $thismatch['Matchrec']['ltb2']) {
	        $winner_score = $winner_score . "(". $thismatch['Matchrec']['wtb2'] . ")";
	        $lscore = $lscore . "(". $thismatch['Matchrec']['ltb2'] . ")";
        }

        if ($thismatch['Matchrec']['wset3'] || $thismatch['Matchrec']['ltb3']) {
            $winner_score = $winner_score . " " . $thismatch['Matchrec']['wset3'];
            $lscore = $lscore . " " . $thismatch['Matchrec']['lset3'];
            if ($thismatch['Matchrec']['wtb3']) {
                $winner_score = $winner_score . "(". $thismatch['Matchrec']['wtb3'] . ")";
                $lscore = $lscore . "(". $thismatch['Matchrec']['ltb3'] . ")";
            }            
        }
        echo "<tr>";
        echo "<td width=\"65%\" class=match>" . $thismatch['Matchrec']['wplayer1'];
        echo "<td width=\"35%\" class=match>" . $winner_score;
        echo "</tr><tr>";
        echo "<td width=\"65%\" class=lentry>" . $thismatch['Matchrec']['lplayer1'];
        echo "<td width=\"35%\" class=lentry>" . $lscore;
        echo "</tr>";
    }
?>
</table>
</div>
  </div>

