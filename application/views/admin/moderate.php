<br />
<?php echo Form::open('admin/moderate/'); ?><br />

<div class="mod">
    <div class="modl">Quote (ID):</div>
    <div class="modr"><?php echo Form::input('qid'); ?></div>
</div>

<div class="mod">
    <div class="modl">Action:</div>
    <div class="modr"><?php echo Form::select('action', array('show', 'hide')); ?></div>
</div>

<?php echo Form::submit('submit', 'Submit'); ?>
<?php echo Form::close(); ?>