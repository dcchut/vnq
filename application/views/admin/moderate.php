<br />
<?php echo Form::open('admin/moderate/'); ?><br />

<div class="modl">Quote (ID):</div>
<div class="modr"><?php echo Form::input('qid'); ?></div>
<br />

<div class="modl">Action:</div>
<div class="modr"><?php echo <?php echo Form::select('action', array('show', 'hide')); ?></div>
<br />

<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>