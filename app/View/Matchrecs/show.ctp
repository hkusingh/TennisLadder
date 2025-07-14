<!-- Left side -->
<div id="left">
    <div id="left1">
    <div id="member">
    	<h2>Player Record</h2>
<?php
            echo $this->Form->create('Matchrec', array('action' => 'show'));
            echo $this->Form->input('Matchrec.wplayer1', 
						                   array('label' => array('text' => 'Player'),
                                      'options' => $plist));
            echo "<br>";
            echo $this->Form->input('Matchrec.wplayer2', array('type' => 'hidden',
						                                             'value' => 'NOTVALID'));																			        
?>
            <input type="submit" class="matchgo" value="Go">

    	    </form>    	
    </div> <!-- Member end --> 
    <br class="spacer" />       
    </div><!-- end of left1 -->
    <div id="left2">
    	<div id="member">
    		<h2>Head to Head</h2>
        <?php
            echo $this->Form->create('Matchrec', array('action' => 'show'));
            echo $this->Form->input('Matchrec.wplayer1', 
						                   array('label' => array('text' => 'Player-1'),
                                     'options' => $plist));
            echo "<br>";
            echo $this->Form->input('Matchrec.wplayer2', 
						                   array('label' => array('text' => 'Player-2'),
                                     'options' => $plist));
            echo "<br>";
            																			   
		?> 
            <input type="submit" class="matchgo" value="Go">
			</form>
    		
    	</div> <!-- Member end -->
    	<br class="spacer" /> 
    </div>
</div><!-- LEFT SIDE END -->
<div id="right"> 
<div id="matches">                 
	<p class="rightTop"></p>
    	<h3><?php echo $displayStr ?></h3>
        <table border="1" cellpadding="0" cellspacing="2" 
				       style="border-collapse: collapse;" bordercolor="#f0f0f0"
							 width="550">  
				  <tr bgcolor="#09c"><th class="mheader">Date</th>
					    <th class="mheader">Winner</th>
							<th class="mheader">Opponent</th>
							<th class="mheader">Score</th>   
					</tr>     
					<?php
			  $alternate = false;
          	  foreach ($matches as $thismatch) {
              $winner_score = null;
              $lscore = null;
              $curr_date = $thismatch['Matchrec']['date'];
              $match_date = explode("-", $thismatch['Matchrec']['date']);
              $my  = $match_date[0];
              $mm  = $match_date[1];
              $md  = $match_date[2];
              if ($alternate) {
                  echo "<tr class=\"mrow\">";
                  $alternate = false;
              }
              else {
                  echo "<tr class=\"marow\">";
                  $alternate = true;
              }
              echo "<td style=\"padding-left:5px;\">" . date("M j, Y", mktime(0,0,0,$mm, $md, $my));
              echo "</td><td style=\"padding-left:5px;\">";
              echo $thismatch['Matchrec']['wplayer1'];
              echo "</td><td style=\"padding-left:5px;\">";
              echo $thismatch['Matchrec']['lplayer1'];
              echo "</td><td style=\"padding-left:5px;\">";
              
							$score = $thismatch['Matchrec']['wset1'] . "-";
							$score = $score . $thismatch['Matchrec']['lset1'];
							
							if ($thismatch['Matchrec']['wtb1']) {
							   $score = $score . "(". 
								                 $thismatch['Matchrec']['ltb1'] . ") "; 
							} 
							 
							$score = $score . ", " . $thismatch['Matchrec']['wset2'] . "-";
							$score = $score . $thismatch['Matchrec']['lset2'];
							
							if ($thismatch['Matchrec']['wtb2']) {
							   $score = $score . "(". 
								                 $thismatch['Matchrec']['ltb2'] . ") "; 
							}
							
							if ($thismatch['Matchrec']['wset3']) {
							    $score = $score . ", " . $thismatch['Matchrec']['wset3'] . "-";
							    $score = $score . $thismatch['Matchrec']['lset3'];
							    if ($thismatch['Matchrec']['wtb3']) {
							         $score = $score . "(". 
								                      $thismatch['Matchrec']['ltb3'] . ")"; 
							    }
							}
							echo $score;
							echo "</td>";
							echo "</tr>";
          }
          ?>
          </table>
          
          <hr>
        	<?php if ($matchOnly) { ?>
          	<p>Showing <b> 
          	<?php echo $this->Paginator->counter(array('format' => 
					                       '%start% - %end% of %count%')); ?> 
			</b>Matches 
			<?php echo $this->Paginator->prev(); ?>
			
          	<?php echo $this->Paginator->numbers(); ?>
            <?php echo $this->Paginator->next();
			} ?>          
		<p class="rightBottom"></p>
		</div>         
           </div>
           <br class="spacer" />          
        </div>
