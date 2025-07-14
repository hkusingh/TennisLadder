<?php
define('MATCH_MEN_S',  0);
define('MATCH_MENS_D', 1);
define('MATCH_WOMEN_S',2);
define('MATCH_WOMEN_D',3);
define('MATCH_MIXED',4);
define('VERSION_1',     1);
define('VERSION_2',     2);

class MatchrecsController extends AppController
{	var $name = 'Matchrecs';	
	var $uses = array('Matchrec', 'Playerstat', 'Player');	
	var $helpers = array("Html","Form");
	var $months = array('1' =>'January','2' =>'Febuary','3' => 'March','4' => 'April',                        
			            '5' => 'May','6' => 'June','7' => 'July','8' => 'August',
                        '9' => 'September','10' => 'October','11'=> 'November','12' => 'December');
	
    /*    
     *    Function Name: home  (/matchrecs/home)	 
     *    Description: This is the home page of the web site. If the Player is logged in
     *    his name and stats are set to be displayed in the view (home.ctp). Also the 	 
     *    recent Match list is populated to display the most resent 12 matches.
     *    View File: app/View/Matchrecs/home.ctp
     */										 
	function home()
    {        
    	$this->set('first_name', "");        
    	$this->set('pstats', null);        
    	$this->set('numrows', '9');        
    	$pname = $this->Session->read('pname');        
    	if ($pname) {           
    		$this->set('first_name', $pname);           
    		$pid = $this->Session->read('playerid');           
    		$last_login = $this->Session->read('last_login');           
    		$results = $this->Playerstat->findByPlayerId($pid);           
    		if ($results) {              
    			$this->set('pstats', $results['Playerstat']);              
    			if ($last_login) {                  
    				$this->set('llogin', $last_login);              
    			} else {                  
    				$this->set('llogin', 'Never');		      
    			}           
    		}        
    	} 	
    }
 	
 	
 	function index ($num)
 	{
        $matches = $this->Matchrec->find('all', array('order' => array('date DESC'), 'limit' => $num));
        if (isset($this->params['requested'])) {
           return $matches;
        }
        $this->set('matches', $matches);
 	}
 	/* 
 	 * Function Name: show
 	 * Description  : Show all the macthes record, this function also show records of individual player
 	 * as well head to head records.
 	 * View Name: app/View/Matchrecs/show.ctp
 	 */
 	function show()
 	{
      $this->set('displayStr', 'Match Record');
 	  /* Set the list of player for the drop down Menu */
 	  $this->__setPlayerList();
 	  $this->set('matchOnly', true);
 	  if ($this->request->data) {
 	      /* Get data for the respective players and their statistics */
 	      $player1 = $this->request->data['Matchrec']['wplayer1'];
 	      $player2 = $this->request->data['Matchrec']['wplayer2'];
		  if($player2 == 'NOTVALID') {
          /*$conditions = array("Matchrec.wplayer1 = '$player1'
                                or Matchrec.lplayer1 = '$player1'");
            $paginationParameters = array();
            $paginationParameters['controller'] = 'matchrec';
            $paginationParameters['action'] = $this->action;
            $this->paginate = array('limit' => 30,
 	                                'page' => 1,
 	                                'order' => array('Matchrec.date' => 'desc'),
 	                                'url' => array('url' => $paginationParameters)
 	                                );*/
              $pHeader = "Match Record for " . $this->request->data['Matchrec']['wplayer1'];              
              $results = $this->Matchrec->find('all', 
                                                array(
                                                'conditions' => array("Matchrec.wplayer1 = '$player1' 
                                                or Matchrec.lplayer1 = '$player1'"), 
                                                'order' => array('Matchrec.date DESC')));
              //$results = $this->paginate($conditions);
          } else {
			  /* This is the case for player vs player */
			  $pHeader = $player1 . " vs " . $player2;
			  $results = $this->Matchrec->find('all', 
			                                    array(
			                                    'conditions' => array("Matchrec.wplayer1 = '$player1'
			                                    and Matchrec.lplayer1 = '$player2' or				                                  
			                                    Matchrec.wplayer1 = '$player2' and                                                  
			                                    Matchrec.lplayer1 = '$player1'")));
          }
		  $this->set('matches', $results);
          $this->set('displayStr', $pHeader);
		  $this->set('matchOnly', false);
      } else {
          /* Display all matches */
          $this->paginate = array('limit' => 25,
	                              'page' => 1,
			                      'order' => array('Matchrec.date' => 'desc'));
          $this->set('matchOnly', true);
		  $this->set('matches', $this->paginate('Matchrec'));
      }
 	}
 	
 	function __setPlayerList()
 	{
 	  $pnames = array();
 	  $fullName;
	  $rows = $this->Player->find('all', array('conditions' => array("Player.active = 1"), 	                                           
	                              'fields' => array("Player.fname", "Player.lname"),
	              	  	          'order' => array('Player.lname ASC')));
	  foreach ($rows as $row) {
          $fullName = $row['Player']['fname'] . "," . $row['Player']['lname'];
		  $pnames["$fullName"] = $fullName;
	  }
	  $this->set('plist', $pnames);
 	}
 	/*
 	 * Function name: submit  (/matchrecs/submit)
 	 * Description: The score submit routine, this routine calculated the points
 	 * for the winner and updates stats for both the players. 
 	 * TODO: validate the scores, currently any scores can be entered.
 	 */
 	function submit()
 	{
 	    $pid = $this->Session->read('playerid');
 	    if ($pid) {
 	       if (!$this->request->data) {
 	          $this->__setPlayerList();
		      $this->set('mth', $this->months);
		   } else {
		      
		      $this->request->data['Matchrec']['version'] = VERSION_2;
		      $this->request->data['Matchrec']['submitter_id'] = $pid;
		      $mday = $this->request->data['Matchrec']['date']['day'];
		      $mmonth = $this->request->data['Matchrec']['date']['month'];
		      $myear = $this->request->data['Matchrec']['date']['year'];
		      $mtime = mktime(0,0,0, $mmonth, $mday, $myear);
		      $this->request->data['Matchrec']['date'] = date('Y-m-d', $mtime);
              /* Get the winner and loosers IDs from their names and then get their
		       * names points records and store the data there as well.
		       */
		      $splitname = explode(',', $this->request->data['Matchrec']['wplayer1']);
		      $wfname = $splitname[0];
		      $wlname = trim($splitname[1]);
		      $splitname = explode(',', $this->request->data['Matchrec']['lplayer1']);
		      $lfname = $splitname[0];
		      $llname = trim($splitname[1]);
		      $wresults = $this->Player->find('all', 
		                                       array(
		                                       'conditions' => array(
		                                          "Player.fname = '$wfname' AND
		      			                           Player.lname = '$wlname'"),
		 	                                   'order' => array('Player.player_id',
                                                       'Player.email',
		      	                                       'Player.playertype',
                                                       'Playerstat.wins',
                                                       'Playerstat.loss',
                                                       'Playerstat.last_played',
													   'Playerstat.points')));
              $winner = $wresults[0];
              if ($winner['Player']['playertype'] === 'Men') {
              	$this->request->data['Matchrec']['type'] = MATCH_MEN_S;
              } else {
              	$this->request->data['Matchrec']['type'] = MATCH_WOMEN_S;
              }
              
		      $lresults = $this->Player->find('all', array('conditions' => array("Player.fname = '$lfname' AND
		      			                                     Player.lname = '$llname'"),
		 	                                  'order' => array('Player.player_id',
                                                       'Player.email',
                                                       'Playerstat.wins',
                                                       'Playerstat.loss',
                                                       'Playerstat.last_played',
													   'Playerstat.points')));
              $looser = $lresults[0];			
		      $winner['Playerstat']['wins']++;
		      $looser['Playerstat']['loss']++;
		      $wpts = $winner['Playerstat']['points'];
		      $lpts = $looser['Playerstat']['points'];
              /* Update the winners points */
              if ($wpts >= $lpts) {
			      $winner['Playerstat']['points'] += 3;
			      $winner['Playerstat']['points_lm'] = 3;
			      $this->request->data['Matchrec']['points'] = 3;			      
                  $gamewon = $this->request->data['Matchrec']['lset1'] +
              	             $this->request->data['Matchrec']['lset2'] +
              	             $this->request->data['Matchrec']['lset3'];                  
                  $looserpoints = $gamewon * 0.1;
                  if ($looserpoints > 1.5 ) {
                  	$looserpoints = 1.5;              	
                  }                  			      
              } else {
		          $winner['Playerstat']['points_lm'] = 5;
		          $winner['Playerstat']['points'] += 5;
                  $this->request->data['Matchrec']['points'] = 5;
                  $looserpoints = 0;
              }
              
              $looser['Playerstat']['points_lm'] = $looserpoints;
              $looser['Playerstat']['points'] += $looserpoints;
              /* update last played date */
		      $wlastplayed = explode('-', $winner['Playerstat']['last_played']);
		      $wlptime = mktime(0,0,0, $wlastplayed[1], $wlastplayed[2],
		                        $wlastplayed[0]);
		      $llastplayed = explode('-', $looser['Playerstat']['last_played']);
		      $llptime = mktime(0,0,0, $llastplayed[1], $llastplayed[2],
				                  $llastplayed[0]);
              if ($mtime > $wlptime) {
				    $winner['Playerstat']['last_played'] = date('Y-m-d', $mtime);
	          }
              if ($mtime > $llptime) {
		         $looser['Playerstat']['last_played'] = date('Y-m-d', $mtime);
              }
		      if ($this->Matchrec->save($this->request->data)) {
                 $this->Playerstat->id = $winner['Player']['player_id'];
                 if($this->Playerstat->save($winner)) {
			        $this->Playerstat->id = $looser['Player']['player_id'];
				    if($this->Playerstat->save($looser)) {
				       $this->flash('Your score has been submitted.',
			          		        '/matchrecs/home');
                    } else {
			           $this->flash('Problem saving your data','/matchrecs/submit');
				    }
			     } else {
			        $this->flash('Problem saving your data', '/matchrecs/submit');
                 }
               } else {
			    // $this->flash('Problem saving your data, Matchrec', '/matchrecs/submit');
			     	$this->__setPlayerList();
		      		$this->set('mth', $this->months);
               }
           }
 	    } else {
          /* The user needs to login to view this data */
          $this->Session->write('last_page', "/" . $this->params['url']['url']);
          $this->redirect('/players/login');
        }
     }
}
?>