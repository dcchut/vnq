please enter your quote in the field below.  quotes must be approved by a moderator before they are publically visible.  please remove any timestamps and unnecessary text.
<br /><br />
<?php echo Form::open('quotes/submit2/'); ?>
<?php echo Form::textarea('quote'); ?><br /><br />
<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>