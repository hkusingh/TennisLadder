<div id="oneframe">
   <div id="joinform">
<?php
if ($newpasswd) {
	echo "<p>You password has been reset and an email sent with the new password. Once you log in please be sure 
	to update your profile</p>";
	echo "<br>";
} else {
     echo $this->Form->create('Player', array('action' => 'passwdreset'), array('name' => 'member_log_in',
                              'id' => 'member_log_in'));  
     echo "<h3>Password Reset - Please enter your email address.</h3>";          
     echo $this->Form->input('email', array('label' => array('text' => 'Email:')));
     echo "<br>";
     echo "<input type=\"submit\" name=\"reset\" value=\"Reset\" class=\"go\" />";
}
 ?>  
	 <br class="spacer" />
     </form>
   </div>   
</div>

