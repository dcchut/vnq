<div id="rfloat"></div>
<div>
<div class="arow">
    <span class="acol acol_id">id</span>
    <span class="acol acol_date">date</span>
    <span class="acol acol_up">up</span>
    <span class="acol acol_status">status</span>
    <span class="acol acol_ip lcol">ip</span>
    <div class="aclr"></div>
</div>
    <?php foreach($quotes as $quote): ?>
        <div class="arow urow">
            <span class="acol acol_id"><?php echo HTML::anchor($quote->id, '#' . $quote->id); ?></span>
            <span class="acol acol_date"><?php echo date("H:i:s, d/m/Y", $quote->date); ?></span>
            <span class="acol acol_up"><?php echo $quote->up; ?></span>
            <span class="acol acol_status"><?php if ($quote->status == 1) echo 'accepted';
                                             elseif ($quote->status == 3) echo 'rejected';
                                             else                         echo 'unmoderated'; ?></span>
            <span class="acol acol_ip lcol"><?php echo $quote->ip; ?></span>
            <div class="aclr"></div>
        </div>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var uhide = false;
    var rfloat = $("#rfloat");
    $(".urow").mouseenter(function(){
        // position of this row
        var position = $(this).offset();
        // quote id we are currently moused over
        var id = $(this).children('.acol_id').children('a').text().substring(1);
        
        uhide = false;
        
        $.post('<?php echo URL::site('admin/moderate3'); ?>', {'id' : id}, function(data){
            if (!uhide) {
                var text = $('<div />').text(data).html();
                $(rfloat).html(text.replace(/\n/g,'<br/>')).css({top: position.top}).show('slow');
            }
        });
    }).mouseleave(function(){
        $("#rfloat").hide();
        uhide = true;
    });
});
</script>