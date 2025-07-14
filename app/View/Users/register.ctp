<p>Please fill out the form below to register an account.</p>
<?php echo $form->create('User', array('action' => 'register'));?>

<?php
    echo $form->input('first_name');
    echo $form->input('last_name');
    echo $form->input('username', array('after' => $form->error
         ('username_unique', 'The username is taken, Please try again.')));
    echo $form->input('email');
    echo $form->input('password');
?>

<?php echo $form->end('Register');?>