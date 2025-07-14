<div class="top-banner">
	<img src="/img/mission-hills.jpg"></img>
</div>
<div id="mainframe"> <!-- Main frame containing everything except the footer -->
<div class="top-text">
<p>
Meet new people, stay fit and challenge  yourself to reach the top. 
Come join the fun, schedule a match today.
</p>
</div>
<div id="mid-section"> <!--  Mid Section containing left and right sides -->
<div id="left-container"> <!-- Left side -->
<h2>Challenge someone today!</h2>
<ul class="reasonlist">
	<li>Schedule your match</li>
	<li>Play your match</li>
	<li>Submit your scores</li>
</ul>
<a href="/matchrecs/submit" class="long-button">Submit Scores >></a>
</div> <!-- End left side -->
<div id="right-container"> <!-- Right side -->
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
   </div>   <!-- Login form -->
</div> <!--  Right side  -->
</div> <!-- mid section end -->
<div class="top-text">
<p>
The current session of the ladder runs through March 31st.
</p>
</div>
<div id="bottom-section">
<div id="stats">
	<div id="block"><span><?php echo $total_matches; ?></span> <p>Matches Played</p></div>
	<div id="block"><a href="http://www.findlocalweather.com/forecast/ca/fremont.html" target="_blank">
<img src="http://www.findlocalweather.net/forecast.php?forecast=zandh&pands=fremont+ca&config=png&alt=hwizonenew" 
border="0"  alt="Click for the latest Fremont weather forecast."></a></div>
</div> <!--  Stats and Weather -->
</div> <!-- Bottom Section -->
</div>