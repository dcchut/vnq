<b>quote acceptance panel:</b><br /><br />
<span id="qhead"><?php echo $panel; ?></span>
<b>quote fiddle panel:</b><br /><br />
<?php echo Form::open('admin/moderate/', array('class', 'hide')); ?>
<?php if (isset($message) && !empty($message)): ?>
<p class="np"><?php echo $message; ?></p><br />
<?php endif; ?>
<p class="np">qid:</p>
<?php echo Form::input('id', FALSE, array('class' => 'qid')); ?><br /><br />

<p class="np">action:</p>
<?php echo Form::select('action', $options); ?><br /><br />

<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?>