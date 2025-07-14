<div id="submitform">
<?php 
	echo $this->Form->create('Pages', array('action' => 'submit'));
	echo "<h3><span>Contact Support</span><h3>";
	echo $this->Form->input('issue', array('label' => 'Issue',
    		'options' => array('Can not log in','Forgot my passwd',2,3,4,5,6,7)));
?>

</div>
