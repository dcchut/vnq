please enter your quote in the field below, ensuring that you remove any timestamps and unnecessary text.  quotes must be approved by a moderator before they are publically visible.
<br /><br />
<?php echo Form::open('quotes/submit2/'); ?>
<?php echo Form::hidden('csrf', Security::token()); ?>
<?php echo Form::textarea('quote'); ?><br /><br />
<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>