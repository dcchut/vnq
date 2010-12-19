<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head profile="http://gmpg.org/xfn/11">
      <title><?php echo $title ?></title>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
      <?php echo HTML::script('media/jquery.js') ?>
      <?php echo HTML::script('site/vnqjs') ?>
      <?php foreach ($styles as $file) echo HTML::style($file), "\n" ?>
      <?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
    </head>
    <body>
        <div id="header">
        	<span class="huge"><a class="black" href="<?php echo URL::site(); ?>">VNQ</a></span><span class="quote"> by dcc, 2010.</span> <?php if ($is_ninwa): ?>- hi ninwa!<?php endif; ?>
        	<span id="topr"><?php
        	if (VNQ::is_logged_in())
        	    echo HTML::anchor('admin/moderate', 'moderate') . ' - ';
        	
        	echo HTML::anchor('quotes/submit', 'submit'); ?> - <?php echo HTML::anchor('quotes/top', 'top'); ?> - <?php echo HTML::anchor('quotes/recent', 'recent'); ?> - <?php echo HTML::anchor('quotes/ninwa', 'ninwa');

        	if (VNQ::is_logged_in())
        	    echo ' - ' . HTML::anchor('site/logout', 'logout');
        	?></span> 
        </div>
        <div id="content">
          <?php echo $content ?>
          	<br />
        </div>
    </body>
</html>