<?php echo Form::open('site/login2/'); ?>
username: <?php echo Form::input('username') ?><br />
password: <?php echo Form::password('password') ?><br />
<br />
<?php echo Form::submit('submit', 'Login'); ?>
<?php echo Form::close(); ?>