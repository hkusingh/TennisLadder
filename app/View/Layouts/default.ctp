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
<!-- A. HEADER START -->
<div id="header">
<div id="navbar">
<ul>
<li><a href="/matchrecs/home">Home</a></li>
<li><a href="#">Standings</a>
   <ul>
      <li><a href="/players/standing/Men">Men's Singles</a></li>
      <li><a href="/players/standing/Women">Women's Singles</a></li>
      <li><a href="/players/standing/Junior">Juniors</a></li>
   </ul>
</li>
<li><a href="#">Contact Players</a>
   <ul>
      <li><a href="/players/contact/Men">Men</a></li>
      <li><a href="/players/contact/Women">Women</a></li>
      <li><a href="/players/contact/Junior">Juniors</a></li>
   </ul>
</li>
<li><a href="#">Profile</a>
   <ul>
      <li><a href="/players/view">View</a></li>
      <li><a href="/players/update">Update</a></li>
   </ul>
</li>
<li><a href="#">Scores</a>
   <ul>
      <li><a href="/matchrecs/show">Match Records</a></li>
      <li><a href="/matchrecs/submit">Submit Scores</a></li>
   </ul>
</li>
<!--  <li><a href="/availabilities/">Availability</a></li>
-->
<li><a href="/pages/faq">FAQ</a></li>
<li><a href="/pages/rules">Rules</a></li>
<?php 
	if ($this->Session->read('playerid')) {
		echo "<li><a href=\"/players/logout\">Log Off</a></li>";
	}
?>
</ul>
</div>
<h1 class="topText">Mission Hills Tennis Ladder</h1>
<img src="/img/mh-logo.gif" alt="tennis ball" class="icon" />
<?php 
	if ($this->Session->read('playerid')) {
?>
<a href="/players/logout" class="css3button">Logout</a>
<?php } else { ?>
<p class="topText">Join and get in your game today ... </p>
<a href="/players/join" class="css3button">Join</a>
<?php } ?>
</div>
<!-- A. HEADER END -->
<!-- B. BODY START -->
<div id="body">
<?php echo $content_for_layout; ?>
<!--footer start -->
<div id="footer">
<ul>
	<li><a href="/matchrecs/home">Home</a>|</li>
	<li><a href="/pages/faq">FAQ</a>|</li>
	<li><a href="/pages/support">Support</a></li>
  </ul>
   <p class="design">Designed By : <a href="http://www.templateworld.com">Template World</a> and modified by Harsh Singh | 
   Copyright &copy 2013 | All rights reserved</p>
</div>
<!--footer end -->
</body>
</html>
