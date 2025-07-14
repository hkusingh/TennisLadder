<p>Hello, <?php echo($user['first_name'] . ' ' . $user['last_name']); ?></p>
<p><?php echo $html->link('knownusers', array('action' => 'knownusers')); ?>
</p>
<?php echo $html->link('logout', array('action' => 'logout')); ?>