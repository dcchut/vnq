<br /><br />
<b>moderation panel:</b><br /><br />
<?php echo Form::open('admin/moderate/'); ?><br />

qid:<br />
<?php echo Form::input('qid', FALSE, array('class' => 'qid')); ?><br /><br />

action:<br />
<?php echo Form::select('action', array('show', 'hide')); ?><br /><br />

<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>