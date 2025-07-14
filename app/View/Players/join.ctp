<div class="spacer"></div>
<div id="mainframe">
<div id="joinform">

<?php
if ($joined == 'false') {
    echo $this->Form->create('Player', array('action' => 'join'));
    echo "<h3>Join the Ladder</h3>";
    echo $this->Form->input('fname', array('label' => array('text' => 'First Name')));
    echo "<br>";
    echo $this->Form->input('lname', array('label' => array('text' => 'Last Name')));
    echo "<br>";
    echo $this->Form->input('phone', array('label' => array('text' => 'Phone')));
    echo "<br>";
    echo $this->Form->input('rating', array('label' => array('text' => 'NTRP Rating'),
                                      'options' => array('3'=>'3','3.5' => '3.5','4' => '4',
														 '4.5' => '4.5','5' =>'5','NR'=>'NR')));
    echo "<br>";
    echo $this->Form->input('playertype', array('label' => array(
		                                  'text' => 'Ladder'),
                                          'options' => array('Men'=>'Men','Women' => 'Women',
                                          'Junior12' => 'Junior - 12', 'Junior16' => 'Junior - 16')));
    echo "<br>";
    
    echo $this->Form->input('member_num', array('label' => array('text' => 'Member Number'), 'type' => 'text'));
    echo "<br>";
	echo $this->Form->input('email', array('label' => array('text' => 'Email')));
    echo "<br>";    
    echo $this->Form->input('password', array('label' => array('text' => 'Password')));
    echo "<br>";
    echo $this->Form->input('c_passwd', array(
                            'label' => array('text' => 'Confirm Password'), 
                            'type' => 'password',
							'after' => $this->Form->error('confirm_passwd', 
                            'The passwords do not match')));
    echo "<br>";       
?> 
<input type="submit" name="Join" value="Join" class="go" />
<?php } else if ($joined == 'true') {
	echo "<p>Thank you for joining the Mission Hills tennis Ladder. You will be receiving an email with the 
	activation code. Your account will not be active unless you activate your account with that code. The link to 
	activate your account is given below, it has also been emailed to you.</p>";
	echo"<br>";
	echo "<a href=\"/players/activate\">Activate your account</a>";
}?>
<br class="spacer" />
</form>
</div>
</div>


