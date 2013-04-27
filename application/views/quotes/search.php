<?php echo Form::open('quotes/search'); ?>
search: <?php 
echo Form::input('search');
echo ' ';
echo Form::submit('submit', 'search');
echo Form::close();
?>
<br />
<?php
// any quote results?
if (count($results) > 0) {
    // display them or some shit
    echo '<b>search results:</b><br />';
    foreach ($results as $q) {
        echo VNQ::render_quote($q);
        echo '<br />';
    }
}

