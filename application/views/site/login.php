<?php echo Form::open('site/login2/'); ?>
Username: <?php echo Form::input('username') ?><br />
Password: <?php echo Form::password('password') ?><br />
<br />
<?php echo Form::submit('submit', 'Login'); ?>
<?php echo Form::close(); ?>