<?php
class Playerstat extends AppModel
{
    var $name = 'Playerstat';
    var $primaryKey = 'player_id';
    var $belongsTo = array('Player' => array(
                           'className' => 'Player',
                           'foreignKey' => 'player_id'));
}
?>