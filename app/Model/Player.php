<?php
class Player extends AppModel
{
    var $name = 'Player';
    var $viewName = NULL;
    var $primaryKey = 'player_id';
    /* var $hasOne = array('Playerstat' => array(
                                              'className' => 'Playerstat',
                                              'foreignKey' => 'player_id',
                                              'dependent' => true)); */
    var $hasOne = 'Playerstat';
    var $validate = array(
           'fname' => 'notEmpty',
           'lname' => 'notEmpty',
           'phone' => array(
                           'phoneRule-1' => array(
                                'rule' => array('phone', null, 'us'),
					            'message' => 'Please supply a valid phone number'
					       ),
					       'phoneRule-2' => array(
					              'rule' => 'isUnique',
					              'message' => 'Member has already joined'
					       )
					 ),                    
           'email' => array(
					       'emailRule-1' => array(
					             'rule' => 'email',
					             'message' => 'Please supply a valid email address'
					        ),
					        'emailRule-2' => array(
					             'rule' => 'isUnique',
					             'message' => 'User already exists'
					        )
					 ),
		   'member_num' => array('rule' => 'numeric',
					             'message' => 'Number only'),
		   'password' => '/^.{6,40}$/',	
		   'c_passwd' => '/^.{6,40}$/'				       
    );
    
  function beforeValidate() 
  {
  	if (!$this->id && $this->viewName == 'join') {
	  	if ($this->data['Player']['password'] != 
			    $this->data['Player']['c_passwd']) {
				$this->invalidate('confirm_passwd');
				return false;
	  	}
	} else {
	    if ($this->viewName == 'update') {
			$results = $this->findByPlayerId($this->id);
			if ($this->data['Player']['o_passwd'] != $results['Player']['password']) {
				$this->invalidate('bad_passwd');
				return false;
			}
			if ($this->data['Player']['password'] != 
			    $this->data['Player']['c_passwd']) {
					$this->invalidate('confirm_passwd');
					return false;
			}
	    }
	}
	return true;
  }    
}
?>
