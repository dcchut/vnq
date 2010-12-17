<br /><br />
<b>moderation panel:</b><br />
<?php echo Form::open('admin/moderate/'); ?><br />

<p>qid:</p>
<?php echo Form::input('qid', FALSE, array('class' => 'qid')); ?><br />

<p>action:</p>
<?php echo Form::select('action', $options); ?><br /><br />

<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?>