<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head profile="http://gmpg.org/xfn/11">
      <title><?php echo $title ?></title>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
      <?php echo HTML::script('media/jquery.js') ?>
      <?php foreach ($styles as $file) echo HTML::style($file), "\n" ?>
      <?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
    </head>
    <body>
        <div id="header">
        	<span class="huge">VNQ</span><span class="quote"> by dcc, 2010.</span>
        	<span id="topr"><?php
        	if (VNQ::is_admin())
        	    echo HTML::anchor('admin/moderate', 'Moderate') . ' - ';
        	
        	echo HTML::anchor('quotes/submit', 'Submit'); ?> - <?php echo HTML::anchor('quotes/top', 'Top'); ?> - <?php echo HTML::anchor('quotes/recent', 'Recent'); ?></span> 
        </div>
        <div id="content">
          <?php echo $content ?>
          	<br />
        </div>
    </body>
</html>