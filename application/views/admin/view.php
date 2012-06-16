<div class="container">
    <span class="acol acol_id">id</span>
    <span class="acol acol_date">date</span>
    <span class="acol acol_quote">quote</span>
    <span class="acol acol_up">up</span>
    <span class="acol acol_status">status</span>
    <span class="acol acol_ip">ip</span>
    <br />
    <?php foreach($quotes as $quote): ?>
        <span class="acol acol_id"><?php echo $quote->id; ?></span>
        <span class="acol acol_date"><?php echo $quote->date; ?></span>
        <span class="acol acol_quote"><?php echo htmlentities($quote->quote); ?></span>
        <span class="acol acol_up"><?php echo $quote->up; ?></span>
        <span class="acol acol_status"><?php echo $quote->status; ?></span>
        <span class="acol acol_ip"><?php echo $quote->ip; ?></span>
        <br />
    <?php endforeach; ?>
</div>