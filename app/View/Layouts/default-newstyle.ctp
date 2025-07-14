<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="Harsh Singh" content="Mission Hills Tennis Ladder Tennis Ladder" />
  <meta name="Harsh Singh" content="Designed by Template World /
              Modified: Harsh Singh" />
  <title>Mission Hills Tennis Ladder</title>              
<?php
   echo $this->Html->css('style');
?>
</head>
<body>
<div id="nav">
<img src="/img/mh-logo.gif" alt="tennis ball" class="icon" />
 <ul>
 <li><a href="#">Standing</a></li>
 <li><a href="/pages/faq">FAQ</a></li>
 <li><a href="/pages/rules">Rules</a></li>
 <li><a href="/pages/support">Support</a></li> 
</ul>
<?php 
	if ($this->Session->read('playerid')) {
		echo "<a href=\"/players/logout\" class=\"button\">Log Off</a>";
	} else {
		echo "<a href=\"/players/join\" class=\"button\">Sign Up</a>";
	}
?>
</div>
<?php echo $content_for_layout; ?>
<div id="footer">
<ul>
	<li><a href="/matchrecs/home">Home</a>|</li>
	<li><a href="/pages/faq">FAQ</a>|</li>
	<li><a href="/pages/support">Support</a></li>
  </ul>
<p class="design">Designed By : Harsh Singh | Copyright &copy 2014 | All rights reserved</p>  
</div>
</body>
</html>
