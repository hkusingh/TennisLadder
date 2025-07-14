<div id="oneframe">
   <div id="joinform">
<?php
     echo $this->Form->create('Player', array('action' => 'login'), array('name' => 'member_log_in',
                              'id' => 'member_log_in'));  
     echo "<h3>Member Login</h3>";          
     echo $this->Form->input('email', array('label' => array('text' => 'Email:')));
     echo "<br>";
     echo $this->Form->input('password', array('label' => array('text' => 'Password:')));
 ?>  
 	<br>        
	 <a href="#">Forgot password?</a>
	 <br>
	 <input type="submit" name="Login" value="Login" class="go" />
	 <br class="spacer" />
     </form>
   </div>   
</div>

