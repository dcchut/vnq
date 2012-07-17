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