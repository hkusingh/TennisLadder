<div id="oneframe">
<div id="joinform">
<?php if (!$active) { ?>
<?php 
echo $this->Form->create('Player', array('action' => 'activate')); 
echo "<h2>Activate Accont</h2><br>";
echo $this->Form->input('activation_code', array('label' => array('text' => 'Activation Code'),
		                                 'after' => $this->Form->error('bad_code','Incorrect activation code')));
    echo "<br>";
?> 
<br>
<input type="submit" name="Join" value="Activate" class="go" />
</div>
<?php } else { ?>
<p> Your account has been activated. Please visit the FAQ to find out more about the ladder.</p>
<?php      } ?>
</div>
</div>