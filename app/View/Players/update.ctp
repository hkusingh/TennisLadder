<div id="oneframe">
<div id="joinform">
<?php 
	echo $this->Form->create('Player', array('action' => 'update'));
	echo "<h3>Update Profile - ";
	echo $pinfo['Player']['fname']; echo " "; echo $pinfo['Player']['lname'];
	echo "</h3>";
    echo $this->Form->input('phone', array('label' => array('text' => 'Phone'),
		                                 'value' => $pinfo['Player']['phone']));
    echo "<br>";
    if ($pinfo['Player']['rating']) {
        $rating = $pinfo['Player']['rating'];
    } else {
        $rating = 'NR';
		}
		
    echo $this->Form->input('rating', array('label' => array('text' => 'NTRP Rating'),
                                      'options' => array('3'=>'3','3.5' => '3.5','4' => '4',
														 '4.5' => '4.5','5' =>'5','NR'=>'NR'),
														 'selected' => $rating));
    echo "<br>";
    echo $this->Form->input('email', array('label' => array('text' => 'Email'),
		                    'value' => $pinfo['Player']['email']));
    echo "<br>";
    echo $this->Form->input('o_passwd', array('label' => array('text' => 'Old Password'),
		                    'type' => 'password',
						    'after' => $this->Form->error('bad_passwd',
						    'Invalid Password')));
    echo "<br>";    
    echo $this->Form->input('password', array('label' => array('text' => 'New Password')));
    echo "<br>";
    
    echo $this->Form->input('c_passwd', array('label' => 
		                  array('text' => 'Confirm Password'), 
    		                    'type' => 'password',
								'after' => $this->Form->error('confirm_passwd', 
								'The passwords do not match')));
    echo "<br>";
?>
<input type="submit" name="update" value="Update" class="go" />
<br class="spacer" />
</form>
</div>
</div>