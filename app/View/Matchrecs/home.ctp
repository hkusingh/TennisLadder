<!-- LEFT SIDE START -->
<div id="left">
    <div id="left1">
        <div id="member">
        <?php
           if ($first_name) {
               echo "<h2>Welcome " . $first_name . "</h2>";
               if ($pstats) {
                   echo "<label>Points:</label>" . " ". $pstats['points'];
                   echo "<br>";                   
                   echo "<label>Wins:</label>" . " " . $pstats['wins'];
                   echo "<br>";
                   echo "<label>Losses:</label>" . " " . $pstats['loss'];
                   echo "<br>";
                   echo "<label>Last Login:</label>" . " " . $llogin;
                   echo "<br>";
                   $lastplayed = $pstats['last_played'];
                   if ($lastplayed == "0000-00-00"){
                   	$lastplayed = "Never";
                   }
				   echo "<label>Last Played:</label>" . " " . $lastplayed;
                   echo "<br>";
        ?>                   
                   <br class="spacer" />
<?php if ($pactive == 'Active') {?>
                   <a href="/players/deactivate" class="actionlink">Deactivate Account</a>
                   <?php } else {?>
                   <a href="/players/reactivate" class="actionlink">Activate Account</a>
                   <?php }?>
                   <a href="/players/logout" class="css3button">Logout</a>
                   <br class="spacer" />
                   
        <?php                                      
               }
           } else {
        ?>
            <h2>Member Login</h2>
            <?php
            echo $this->Form->create('Player', array('action' => 'login'), array('name' => 'member_log_in',
                  'id' => 'member_log_in'));
            
            echo $this->Form->input('email', array('label' => array('text' => 'Email:'),
                                             'class' =>'txtBox'));
            echo $this->Form->input('password', array('label' => array('text' => 'Password:'), 'class' =>'txtBox')); 
            ?>            
	        <a href="/players/passwdreset">Forgot password?</a>
	        <input type="submit" name="Login" value="Login" class="go" />
            <br class="spacer" />
            </form>
            <?php } ?>
        </div> <!-- End of Member -->
        
        <br class="spacer" />
    </div><!-- end of left1 -->
    <div id="left2">    
        <?php echo $this->element('matches', array('cache' => '+6 hour'));  ?>
        <br /><br />
        <br class="spacer" />
        
        <img src="../img/arrow_red.gif" alt="arrow" class="icon" /><a href="/matchrecs/show">More Matches</a>
    </div><!--left2 end -->

</div>
<!-- LEFT SIDE END -->
<!-- RIGHT SIDE START -->
<div id="right">
    <p class="rightTop"></p>
    <h2>Welcome</h2>
    <p class="rightTxt1">
    A new session of the tennis ladder is begining tomorrow Jan 12th and will run through March 15th. All players who 
    played in the last session are automatically reqistered for the next session, if you do not wish to participate please 
    click on the deactivate link on the right panel after you login. If your account had been deactived in one of the previous session 
    and you wish participate, then please click on the activate link after you login. Wish everyone luck hope you enjoy this session.
    </p>
    <p class="rightTxt2"><span>Junior Ladder</span>
    This session we are introducing the Junior Ladder. Junior can join the ladder either in the under-12 or the under-16 categories. 
    The scoring and the point system will remain the same as the adult ladder. Please refer to the FAQ and Rules for details.
    </p>
    <p class="rightPic"></p>
    <p class="notice"><span>Last Session Results</span>
    A total of 36 matches were completed with 20 players participating. Congratulations to the winners and a big thank you to everyone for playing. We have completed one year of the ladder at Mission Hills. A total of 333 matches have been played, so again a big thanks to everyone.<br><br>
    <b>Men's Winner</b> - Bob Frey</br>
    <b>Men's Most Dedicated</b> - Alberto Malaga </br>
    <b>Women's Winner</b> -  Lisa Childers</br>
    <b>Women's Most Dedicated</b> - Lisa Chen</br>
    </p>
    <p class="rightTxt2"><span>Support</span> 
    If you have any technical difficulty using this website please contact admin@missionhillstennisladder.com.
    </p>
    <p class="rightBottom"></p>
</div>
<br class="spacer" />
<!-- RIGHT SIDE END -->
</div><!-- B. BODY END -->
<!--bodyBottom start -->
<div id="bodyBottom">
<!--news start -->
<div id="news">
<h2>Player Availability</h2>
<h3>As of <?php date_default_timezone_set('America/Los_Angeles'); echo date("D M j G:i Y");?></h3>
<p><span>Curently there no players who have declared their availability</span></p>
<br class="spacer" />
</div>
<!--news end -->
<!--services start -->
<div id="service">
<h2>Latest Weather</h2>
<a href="http://www.findlocalweather.com/forecast/ca/fremont.html" target="_blank">
<img src="http://www.findlocalweather.net/forecast.php?forecast=zandh&pands=fremont+ca&config=png&alt=hwizonenew" 
border="0"  alt="Click for the latest Fremont weather forecast."></a>
<br class="spacer" />
</div>
<!--services end -->
<br class="spacer" />
</div>
<!--bodyBottom end -->

