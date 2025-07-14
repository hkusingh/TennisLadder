<?php
if (isset($error)) {
  echo('Invalid login.');
}
?>
<p> Please log in. </p>
<?php 
echo $form->create('User', array('action' => 'login'));
?>

<?php
echo $form->input('username');
echo $form->input('password');
?>
<?php echo $form->end('Login');?>
<?php echo $html->link('Register', array('action' => 'register')); ?>