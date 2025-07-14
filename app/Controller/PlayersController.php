<?php

define('PLAYER_ACTIVE',   1);
define('PLAYER_INACTIVE', 2);
define('PLAYER_INJ',      3);
define('PLAYER_WAIT'    , 4);

define('MEN_LADDER_ID'  , 'MEN');
define('WOMEN_LADDER_ID','WOMEN');
define ('JUNIORU16_ID', 'JUNIOR_U16');
define ('JUNIORU12_ID', 'JUNIOR_U12');


class PlayersController extends AppController
{
    var $name   = 'Players';
    var $helper = array('Html', 'Form');
    var $components = array('Email');
    var $uses = array('Player','Playerstat');
    
    function join()
    {   
    	if ($this->Session->read('playerid')){
    		$this->redirect('/players/update');
    	} 	
        if (!empty($this->request->data)) {
      	    $this->request->data['Player']['join_date'] = date("Y-m-d");
            $this->request->data['Player']['active'] = PLAYER_WAIT;
            $this->request->data['Player']['activation_code'] = time();
            if ($this->request->data['Player']['playertype'] == 'Men') {
            	$this->request->data['Player']['playertype'] = MEN_LADDER_ID;
            } elseif ($this->request->data['Player']['playertype'] == 'Women'){
            	$this->request->data['Player']['playertype'] = WOMEN_LADDER_ID;
            } elseif ($this->request->data['Player']['playertype'] == 'Junior12'){
            	$this->request->data['Player']['playertype'] = JUNIORU12_ID;
            } else {
            	$this->request->data['Player']['playertype'] = JUNIORU16_ID;
            }
            $this->request->data['Player']['contact'] = true;
            if ($this->Player->save($this->data)) {
               $acode = $this->data['Player']['activation_code'] . "-" .
                        $this->Player->id;
			   $subject = 'Mission Hills Tennis Ladder Activation Code';                        
			   $this->sendEmail($this->data['Player']['email'], 
			                              $acode, null, 'welcome',
			                              $subject);
               $this->set('joined', 'true');			                              
            } else {
            	$this->set('joined', 'false');
            }
        } else {
        	$this->set('joined', 'false');
        }
    }
    
    function login()
    {
        $lfail = false;
        $pdata = array();
        $this->set('player_active', true);
        $this->Player->viewName = 'login';
        if (!empty($this->data)) {
            $results = $this->Player->findByEmail(
                       $this->data['Player']['email']);
            if ($results) {
                $this->Session->write('last_login',
                                      $results['Player']['last_login']);
               if ($results['Player']['active'] == PLAYER_WAIT) {
                   $this->set('player_active', false);
                   $lfail = true;
			    } else {
		           if ($results['Player']['password'] ) {
                   /* Password is set check it */
                       if ($results['Player']['password'] !=
			               $this->data['Player']['password']) {
						 /* Wrong password */
			              $this->Player->invalidate('password','Invalid Email or Password');
			              $lfail = true;
		               }
			       }
			    }
			    if (!$lfail) {
 	                $this->Session->write('pname', $results['Player']['fname']);
               	    $this->Session->write('playerid', $results['Player']['player_id']);
               	    $this->Session->write('pactive', $results['Player']['active']);
               	    $lastPage = $this->Session->read('last_page');
               	    $this->Session->delete('last_page');
               	    /* Save the last login date and time */
               	    $pdata['Player']['last_login'] = date('Y-m-d h:i:s');
               	    $this->Player->id = $results['Player']['player_id'];
               	    $this->Player->save($pdata);
               	   
               	    if ($lastPage) {
               	       $this->redirect($lastPage);
               	    } else {
                       $this->redirect('/matchrecs/home');
                    }
                }
            } else {
               $this->Player->invalidate('email', 'Incorrect Email or Password');
            }
        }
    }
    
    function logout ()
    {
    	$this->Session->delete('pname');
    	$this->Session->delete('playerid');
    	$this->redirect('/matchrecs/home');
    }
    
    function sendEmail($emailaddr, $code=null, $msg=null, $template=null, $subject=null)
    {
    	$this->Email->to = $emailaddr;
    	$this->Email->subject = $subject;
    	$this->Email->replyTo = 'admin@missionhillstennisladder.com';
    	$this->Email->from    = 'Mission Hills Tennis <admin@missionhillstennisladder.com>';
    	$this->Email->template = $template;
    	$this->set('code', $code);
    	$this->Email->send();
    }
    /* Function to activate a player */
    function activate()
    {
    	$this->set('active', false);
        if (!empty($this->data)) {
			$code = explode('-',$this->data['Player']['activation_code']);
        	$acode = $code[0];
        	$pid   = $code[1];
           	$pdata = array();
           	$results = $this->Player->findByPlayerId($pid);
           	if ($results) {
            	if ($results['Player']['activation_code'] == $acode) {
            		/* valid activation entered, activate the account */
                 	$this->Player->id = $results['Player']['player_id'];
                 	$pdata['Player']['active'] = PLAYER_ACTIVE;
                 	$this->Player->save($pdata);
                 	$pdata['Playerstat']['player_id'] = 
                    				   		$results['Player']['player_id'];
                 	$pdata['Playerstat']['wins'] = 0;
                 	$pdata['Playerstat']['loss'] = 0;
                 	$pdata['Playerstat']['points_lm'] = 0;
                 	$pdata['Playerstat']['last_played'] = '0000-00-00';
                 	$pdata['Playerstat']['points'] = 0;
					$this->Playerstat->save($pdata);
					$this->set('active', true);    
				} else {
					$this->Player->invalidate('bad_code');
				}
		    } else {
				$this->Player->invalidate('bad_code');
	    	}	
     	}
    }
    
    /* This function shows the current standing of Ladder A */
    function standing($playertype)
    {
        $status = PLAYER_ACTIVE;
        if ($playertype == 'Junior') {
        /* Junior players are split in to two categories Under 16 and Under 12 */
			$resulta = $this->Player->find('all', 
                   		array('conditions' => array(
                              'AND' => array ('Player.active' => $status,
                                              'Player.playertype' => JUNIORU12_ID)),
							  'fields' => array("Player.fname", "Player.lname", "Playerstat.wins",
                                          "Playerstat.loss", "Playerstat.points",
                                          "Playerstat.last_played"),
							  'order' => array('Playerstat.points DESC')));
             $resultb = $this->Player->find('all', 
                   		array('conditions' => array(
                                'AND' => array ('Player.active' => $status,
                                                'Player.playertype' => JUNIORU16_ID)),
								'fields' => array("Player.fname", "Player.lname", "Playerstat.wins",
                                          "Playerstat.loss", "Playerstat.points",
                                          "Playerstat.last_played"),
								'order' => array('Playerstat.points DESC')));
        	$this->set('rankinga', $resulta);
        	$this->set('rankingb', $resultb);
			$this->set('ladder', $playertype);
			$this->set('numrows', '15');
        	
        } else {
        	$results = $this->Player->find('all', 
                   array('conditions' => array("Player.active = '$status'     
                                               AND Player.playertype = '$playertype'"),
				         'fields' => array("Player.fname", "Player.lname", "Playerstat.wins",
                                          "Playerstat.loss", "Playerstat.points",
                                          "Playerstat.last_played"),
				         'order' => array('Playerstat.points DESC')));
        	$this->set('ranking', $results);
			$this->set('ladder', $playertype);
			$this->set('numrows', '15');
        }
    }
    
    function contact($playertype)
    {
        $status = PLAYER_ACTIVE;
        $pid = $this->Session->read('playerid');
        if ($pid) {
        	if ($playertype == 'Junior') {
        		/* Junior players are split in to two categories Under 16 and Under 12 */
        		$resulta = $this->Player->find('all', 
                   		array('conditions' => array(
                                         'AND' => array ('Player.active' => $status,
                                                         'Player.playertype' => JUNIORU12_ID)),
								'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone", "Player.rating"),
								'order' => array('Player.fname ASC')));
                $resultb = $this->Player->find('all', 
                   		array('conditions' => array(
                                     'AND' => array ('Player.active' => $status,
                                                         'Player.playertype' => JUNIORU16_ID)),
								'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone", "Player.rating"),
								'order' => array('Player.fname ASC')));
				$this->set('ladder', $playertype);
				$this->set('playera', $resulta);
				$this->set('playerb', $resultb);
        	} else {
            	$resulta = $this->Player->find('all', 
                        array('conditions' => array("Player.active = '$status' 
                                              AND Player.playertype = '$playertype'"),
                              'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone", "Player.rating"),
							  'order' => array('Player.fname ASC')));
                $status = PLAYER_INACTIVE;        		    
            	$resultb = $this->Player->find('all', 
                        array('conditions' => array("Player.active = '$status' 
                                              AND Player.playertype = '$playertype'"),
                              'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone", "Player.rating"),
							  'order' => array('Player.fname ASC')));
            	/* TBD pagenate the user list */
           	/* $this->paginate = array('limit' => 30,
	                              'page' => 1,
			                      'order' => array('Player.fname' => 'asc'));*/
				/*$resultb = $this->Player->find('all', 
                        array('conditions' => array("Player.active = '$status' 
                                              AND Player.playertype = '$playertype'"),
                              'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone", "Player.rating"),
							  'order' => array('Player.fname ASC')));*/    
            	$this->set('ladder', $playertype);            	
            	$this->set('playera', $resulta);
            	$this->set('playerb', $resultb);
        	}
        } else {
          /* The user needs to login to view this data */
          $this->Session->write('last_page', "/" . $this->params['url']['url']);
          $this->redirect('/players/login');
		}
    }
    
    function update()
    {
        $pid = $this->Session->read('playerid');
        $pdata = array();
        $this->Player->viewName = 'update';
        if ($pid) {
            if (empty($this->data)) {
            	$results = $this->Player->findByPlayerId($pid);
		        $this->set('pinfo', $results);
		    } else {
		    	$results = $this->Player->findByPlayerId($pid);	
		    	$this->Player->id = $results['Player']['player_id'];								
		    	if ($this->Player->save($this->data)) {
                	$this->flash('Your information has been updated.',
			                     '/matchrecs/home');									
				} else {
					$this->set('pinfo', $results);
				}								
			}
        } else {
          /* The user needs to login to view this data */
          $this->Session->write('last_page', "/" . $this->params['url']['url']);
          $this->redirect('/players/login');
		}    
    }
    
    function view ()
    {
    }
    
    function deactivate (){
    	$pid = $this->Session->read('playerid');
    	$results = $this->Player->findByPlayerId($pid);
    	$results['Player']['active'] = PLAYER_INACTIVE;
    	$this->Player->save($results);
    	$this->Session->delete('pname');
    	$this->Session->delete('playerid');
    	$this->flash('Your account has been deactivated.',
			                     '/matchrecs/home');    	
    }
    
 function reactivate (){
    	$pid = $this->Session->read('playerid');
    	$results = $this->Player->findByPlayerId($pid);
    	$results['Player']['active'] = PLAYER_ACTIVE;
    	$this->Player->save($results);
    	$this->Session->write('pactive', $results['Player']['active']);
     	$this->flash('Your account has been activated.',
			                     '/matchrecs/home');    	
    }
    
    
    function passwdreset ()
    {
    	$pdata = array();
    	$this->set('newpasswd', false);
    	if (!empty($this->data)){
    		$results = $this->Player->findByEmail($this->data['Player']['email']);
    		if (!$results) {
    			$this->Player->invalidate('email', "Email address not found");
    		} else {
    			/* generate passwd and send email */
    			$newpasswd = "Fd@#1hP";
    			$subject = 'Mission Hills Tennis Ladder Password Reset';
    			$this->sendEmail($this->data['Player']['email'], $newpasswd, null, 'passwdreset', $subject);
    			$results['Player']['password'] = $newpasswd;
    			$this->Player->save($results);
    			$this->set('newpasswd', $newpasswd);
    		}
    	}
    }
    
    function support ()
    {
    }
}
?>
