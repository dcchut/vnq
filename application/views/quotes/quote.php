<span id="q<?php echo $quote->id; ?>" class="qmain">
    <span class="quotehead">
        <?php if (!$moderate): 
                  echo HTML::anchor($quote->id, '#' . $quote->id); ?>&nbsp;<a href="#" class="up">⇧</a>(+<span id="qu<?php echo $quote->id; ?>"><?php echo $quote->up; ?></span>)<?php 
              else:
                  echo '#' . $quote->id;
              endif;
        if ($moderate): ?>
         - <a href="#" id="<?php echo $quote->id; ?>" class="accept">Accept</a> - <a href="#" id="<?php echo $quote->id; ?>" class="decline">Decline</a>
        <?php endif; ?></span><br />
    <span class="quote" id="qt<?php echo $quote->id; ?>"><?php echo nl2br(trim(htmlentities($quote->quote))); ?></span><br />
    <?php if ($end_break): ?>
    <br />
    <?php endif; ?>
</span>