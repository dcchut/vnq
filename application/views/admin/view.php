<div class="container">
<div class="arow">
    <span class="acol acol_id">id</span>
    <span class="acol acol_date">date</span>
    <span class="acol acol_up">up</span>
    <span class="acol acol_status">status</span>
    <span class="acol acol_ip">ip</span>
    <div class="aclr"></div>
</div>
    <?php foreach($quotes as $quote): ?>
        <div class="arow">
            <span class="bcol acol_id"><?php echo $quote->id; ?></span>
            <span class="bcol acol_date"><?php echo date("H:i:s d/m/Y", $quote->date); ?></span>
            <span class="bcol acol_up"><?php echo $quote->up; ?></span>
            <span class="bcol acol_status"><?php if ($quote->status == 1) echo 'accepted';
                                             elseif ($quote->status == 3) echo 'rejected';
                                             else                         echo 'unmoderated'; ?></span>
            <span class="bcol acol_ip lcol"><?php echo $quote->ip; ?></span>
            <div class="aclr"></div>
        </div>
    <?php endforeach; ?>
</div>