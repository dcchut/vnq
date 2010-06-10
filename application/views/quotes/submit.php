Please enter your quote in the field below.  Quotes must be approved by a moderator before they are publically visible.  Please remove any timestamps and unnecessary text.
<br /><br />
<?php echo Form::open('quotes/submit2/'); ?>
<?php echo Form::textarea('quote'); ?><br /><br />
<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>