<br />
<?php echo Form::open('admin/moderate/'); ?><br />

Quote ID:<br />
<?php echo Form::input('qid'); ?><br /><br />

Action:<br />
<?php echo Form::select('action', array('show', 'hide')); ?><br /><br />

<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>