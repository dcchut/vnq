<b>quote acceptance panel:</b><br /><br />
<?php echo $panel; ?>
<br /><br />
<b>quote fiddle panel:</b><br />
<?php echo Form::open('admin/moderate/', array('class', 'hide')); ?>
<?php if (isset($message) && !empty($message)): ?>
<p class="np"><?php echo $message; ?></p>
<?php endif; ?>
<p class="np">qid:</p>
<?php echo Form::input('id', FALSE, array('class' => 'qid')); ?><br />

<p class="np">action:</p>
<?php echo Form::select('action', $options); ?><br /><br />

<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?>