<div class="spacer"></div>
<div id="mainframe">
   <div id="loginform">
<?php
     echo $this->Form->create('Player', array('action' => 'login'), array('name' => 'member_log_in',
                              'id' => 'member_log_in'));  
     echo "<h3>Member Login</h3>";
     echo $this->Form->input('email', array('label' => false, 'placeholder' => array('text' => 'Email')));
     echo $this->Form->input('password', array('label' => false, 'placeholder' => array('text' => 'Password')));
 ?>  
    <input type="submit" name="Login" value="Login" class="go" />
 	<br>        
	<a href="/players/passwdreset">Forgot password?</a>
	<br>
    </form>
   </div>   
</div>


