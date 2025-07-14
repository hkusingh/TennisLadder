<div id="submitform">

<?php echo $this->Form->create('Matchrec', array('action' => 'submit'));
?>
    <h3><span>Submit Scores</span></h3>
    
    <?php if($this->validationErrors['Matchrec']) echo $this->validationErrors['Matchrec']['lplayer1'][0]; ?>
    <div id="setrow">
    <label>Set 1</label><label>Set 2</label><label>Set 3</label>
    </div>
    <div id="scorerow">
<?php
    $this->Form->inputDefaults (array('label' => false, 'div' => false, 'class' => false));
    /* Input for winner */
    echo $this->Form->input('wplayer1', array('label' => array('text' => 'Winner'),
                            'options' => $plist));
    echo "<div id=\"setscore\">";
	echo $this->Form->input('wset1', array('label' => false,
                                           'options' => array(0,1,2,3,4,5,6,7)));
	echo $this->Form->input('wtb1', array('class' => 'tiebreak', 'type' => 'text'));
	echo "</div><div id=\"setscore\">";
	echo $this->Form->input('wset2', array('label' => false,
			'options' => array(0,1,2,3,4,5,6,7)));
	echo $this->Form->input('wtb2', array('class' => 'tiebreak','type' => 'text'));
	echo "</div><div id=\"setscore\">";
	echo $this->Form->input('wset3', array('label' => false,
			'options' => array(0,1,2,3,4,5,6,7)));
	echo $this->Form->input('wtb3', array('class' => 'tiebreak','type' => 'text'));
	echo "</div>";
?>
	</div><div id="scorerow">
<?php 
		/* input for opponent */
    echo $this->Form->input('lplayer1', array('label' => array('text' => 'Opponent'),
		'options' => $plist, 'error' => false));
    echo "<div id=\"setscore\">";
    echo $this->Form->input('lset1', array('label' => false,
    		'options' => array(0,1,2,3,4,5,6,7)));
    echo $this->Form->input('ltb1', array('class' => 'tiebreak','type' => 'text'));
    echo "</div><div id=\"setscore\">";
    echo $this->Form->input('lset2', array('label' => false,
    		'options' => array(0,1,2,3,4,5,6,7)));
    echo $this->Form->input('ltb2', array('class' => 'tiebreak','type' => 'text'));
    echo "</div><div id=\"setscore\">";
    echo $this->Form->input('lset3', array('label' => false,
    		'options' => array(0,1,2,3,4,5,6,7)));
    echo $this->Form->input('ltb3', array('class' => 'tiebreak','type' => 'text'));
    echo "</div>";
?>
    </div><div id="scorerow">
    
<?php 
/* Date entry */
    /*echo $this->Form->input('month', array('label' => array('text' => 'Match Date'),
    		'options' => $mth));
    echo $this->Form->input('day', array('label' => false, 
                                         'options' => $day));
    
    echo $this->Form->input('year', array('label' => false,'options' => $year));*/
    echo $this->Form->input('date', array('label' => array('text' => 'Match Date'),'minYear' => date('Y') - 1, 'maxYear' => date('Y')));
    ?><p> <br><?php 
    echo $this->Form->checkbox('default');
?>
 Won by default</p>
 <p>* Please enter tie break scores in the text box next to the game scores.</p>
</div>
<input type="submit" name="update" value="Submit" class="button" />
<br class="spacer" />
</form>
</div>

