<br />
<?php echo Form::open('admin/moderate/'); ?><br />
Quote (ID): <?php echo Form::input('qid'); ?><br />
Action: <?php echo Form::select('action', array('show', 'hide')); ?><br />
<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>