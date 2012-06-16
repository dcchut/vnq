<div class="container">
    <span class="acol acol_id">id</span>
    <span class="acol adate_id">date</span>
    <span class="acol aquote_id">quote</span>
    <span class="acol aup_id">up</span>
    <span class="acol astatus_id">status</span>
    <span class="acol aip_id">ip</span>
    <br />
</div>

<table>
<tr>
<td>id</td>
<td>date</td>
<td>quote</td>
<td>up</td>
<td>status</td>
<td>ip</td>
</tr>
<?php foreach($quotes as $quote): ?>
<tr>
<td><?php echo $quote->id; ?></td>
<td><?php echo $quote->date; ?></td>
<td><?php echo substr($quote->quote, 0, 20); ?></td>
<td><?php echo $quote->up; ?></td>
<td><?php echo $quote->status; ?></td>
<td><?php echo $quote->ip; ?></td>
</tr>
<?php endforeach; ?>
</table>