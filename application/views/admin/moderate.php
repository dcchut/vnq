<b>quote acceptance panel:</b><br /><br />
<?php echo $panel; ?>
<br /><br />
<b>quote fiddle panel:</b><br /><br />
<?php echo Form::open('admin/moderate/'); ?>
<p>qid:</p>
<?php echo Form::input('id', FALSE, array('class' => 'qid')); ?><br />

<p>action:</p>
<?php echo Form::select('action', $options); ?><br /><br />

<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?>