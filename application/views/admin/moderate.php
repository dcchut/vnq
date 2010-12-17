<br />
<?php echo Form::open('admin/moderate/'); ?>
<?php echo Form::select('action', array('show', 'hide')); ?><br /><br />
<?php echo Form::input('qid'); ?><br />
<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>