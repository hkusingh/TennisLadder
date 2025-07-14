<?php

define('PLAYER_ACTIVE',   1);
define('PLAYER_INJ',      2);
define('PLAYER_INACTIVE', 3);
define('PLAYER_WAIT'    , 4);

define('MEN_LADDER_ID'  , 'MEN');
define('WOMEN_LADDER_ID','WOMEN');


class PlayersController extends AppController
{
    var $name   = 'Players';
    var $helper = array('Html', 'Form');
    var $components = array('Email');
    var $uses = array('Player','Playerstat');
    
    function join()
    {
        if (!empty($this->request->data)) {
      	    $this->request->data['Player']['join_date'] = date("Y-m-d");
            $this->request->data['Player']['active'] = PLAYER_WAIT;
            $this->request->data['Player']['activation_code'] = time();
            if ($this->request->data['Player']['playertype'] = 'Men') {
            	$this->request->data['Player']['playertype'] = MEN_LADDER_ID;
            } else {
            	$this->request->data['Player']['playertype'] = WOMEN_LADDER_ID;
            }          
            $this->request->data['Player']['contact'] = true;
            if ($this->Player->save($this->data)) {
               $acode = $this->data['Player']['activation_code'] . "-" .
                        $this->Player->id;
			         /*$this->sendJoinEmail($this->data['Player']['email'], 
			                              $acode);*/
               $this->flash('Thank You for joining the Mission Hills Tennis Ladder. You will be receiving your activation code shortly',
			        		'/matchrecs/home');
            }
        }
    }
    
    function login()
    {
        $lfail = false;
        $pdata = array();
        $this->set('player_active', true);
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
			              $this->Player->invalidate('bad_passwd');
			              $lfail = true;
		               }
			       }
			    }
			    if (!$lfail) {
 	                $this->Session->write('pname', $results['Player']['fname']);
               	    $this->Session->write('playerid', $results['Player']['player_id']);
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
               $this->Session->setFlash('Your username or password was incorrect.');
               $this->redirect('/matchrecs/home');
               $this->Player->invalidate('bad_email');
            }
        }
    }
    
    function logout ()
    {
    	$this->Session->delete('pname');
    	$this->Session->delete('playerid');
    	$this->redirect('/matchrecs/home');
    }
    
    function sendJoinEmail($emailaddr, $code=null, $msg=null, $template=null)
    {
    	$this->Email->to = $emailaddr;
    	$this->Email->subject = 'Mission Hills Tennis Ladder Activation Code';
    	$this->Email->replyTo = 'admin@missionhillstennisladder.com';
    	$this->Email->from    = 'Mission Hills Tennis <admin@missionhillstennisladder.com>';
    	$this->Email->template = 'welcome';
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
    function standing($laddertype)
    {
        $status = PLAYER_ACTIVE;
        $results = $this->Player->find('all', 
                   array('conditions' => array("Player.active = '$status'     
                                               AND Player.playertype = '$laddertype'"),
				         'fields' => array("Player.fname", "Player.lname", "Playerstat.wins",
                                          "Playerstat.loss", "Playerstat.points",
                                          "Playerstat.last_played"),
				         'order' => array('Playerstat.points DESC')));
        $this->set('ranking', $results);
		$this->set('ladder', $laddertype);
    }
    
    function contact()
    {
        $status = PLAYER_ACTIVE;
        $pid = $this->Session->read('playerid');
        if ($pid) {
            $results = $this->Player->find('all', 
                        array('conditions' => array("Player.active = '$status' 
                                              AND Player.level = 'A'"),
                              'fields' => array("Player.fname", "Player.lname", "Player.email",
                                                "Player.phone"),
							  'order' => array('Player.fname ASC')));
		        $this->set('playera', $results);
            $this->set('ladder', 'A');
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
}
?>
