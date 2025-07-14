<?php
class User extends AppModel
{
  var $name = 'User';

  var $validate = array(
    'first_name'=> 'notEmpty',
    'last_name' => 'notEmpty',
    'username' => '/^.{6,40}$/',
    'password' => '/^.{6,40}$/',
    'email' => VALID_EMAIL
  );

  function beforeValidate() 
  {
	if (!$this->id) {
	  if ($this->findCount(array('User.username'
								 => $this->data['User']['username'])) >0) {
		$this->invalidate('username_unique');
		return false;
	  }
	}
	return true;
  }
}
?>