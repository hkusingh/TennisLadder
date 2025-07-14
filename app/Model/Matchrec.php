<?php
class Matchrec extends AppModel
{
    var $name = 'Matchrec';
    var $validate = array(
    	'lplayer1' => array (
    		'rule' => 'checkSamePlayer',
    		'message' => 'You can not play your self')    
    );
    function  afterSave ()
    {
    	@unlink(CACHE.'views'.DS.'element_cache_matches');
    }
    
    /* Validate all the data being submitted */
    function checkSamePlayer()
    {
    	if ($this->data['Matchrec']['wplayer1'] == $this->data['Matchrec']['lplayer1']) {
    		/* A player can not play him/her self */
    		return false;
    	}
    	return true;
    }
}

?>
