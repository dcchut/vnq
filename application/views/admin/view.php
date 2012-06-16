<div class="container">
    <span class="acol_id">id</span>
    <span class="adate_id">date</span>
    <span class="aquote_id">quote</span>
    <span class="aup_id">up</span>
    <span class="astatus_id">status</span>
    <span class="aip_id">ip</span>
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