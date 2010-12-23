<b>quote acceptance panel:</b><br /><br />
<span id="qhead"><?php echo $panel; ?></span>
<b>quote fiddle panel:</b><br /><br />
<?php echo Form::open('admin/moderate/'); ?>
<?php if (isset($message) && !empty($message)): ?>
<p class="np"><?php echo $message; ?></p><br />
<?php endif; ?>
<p class="np">qid:</p>
<?php echo Form::input('id', FALSE, array('class' => 'qid')); ?><br /><br />

<p class="np">action:</p>
<?php echo Form::select('action', $options); ?><br /><br />

<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?><br />

<!-- moderator list -->
<b>mod list:</b><br /><br />
<?php foreach($moderators as $moderator): ?>
<?php echo $moderator->username; ?><br />
<?php endforeach; ?><br />

<b>add mod:</b><br /><br />
<?php echo Form::open('admin/new_mod/'); ?>
<p class="np">username:</p>
<?php echo Form::input('username', FALSE); ?><br /><br />
<p class="np">password:</p>
<?php echo Form::password('password', FALSE); ?><br /><br />
<p class="np">secret:</p>
<?php echo Form::password('secret', FALSE); ?><br /><br />
<?php echo Form::submit('submit', 'do it'); ?>
<?php echo Form::close(); ?>