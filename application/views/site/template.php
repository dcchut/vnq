<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head profile="http://gmpg.org/xfn/11">
      <title><?php echo $title ?></title>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
      <link href='http://fonts.googleapis.com/css?family=Kameron:400,700|Inconsolata&v1' rel='stylesheet' type='text/css'>
      <?php echo HTML::script('media/jquery.js') ?>
      <?php echo HTML::script('site/vnqjs') ?>
      <?php foreach ($styles as $file) echo HTML::style($file), "\n" ?>
      <?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <span class="huge"><a class="black" href="<?php echo URL::site(); ?>">VNQ</a></span><span class="quote"> by <a href="http://dcc.nitrated.net/">dcchut</a>, 2010.</span>
            </div>
            <div id="links"><?php
                if (VNQ::is_logged_in())
                    echo HTML::anchor('admin/moderate', 'moderate') . ' (' . $unmoderated_quotes . ') - ';
                
                echo HTML::anchor('quotes/submit', 'submit'); ?> - <?php echo HTML::anchor('quotes/top', 'top'); ?> - <?php echo HTML::anchor('quotes/recent', 'recent'); ?> - <?php echo HTML::anchor('quotes/ninwa', 'ninwa'); ?> - <?php echo HTML::anchor('quotes/cthulhu', 'cthulhu'); ?> - <?php echo HTML::anchor('quotes/username', 'username'); 
                echo '- ';
                
                if (VNQ::is_logged_in())
                    echo HTML::anchor('site/logout', 'logout');
                else
                    echo HTML::anchor('site/login', 'login');
                
                ?></span> 
            </div>
            <div id="content">
              <?php if (!empty($subtitle)): ?>
                <b><?php echo $subtitle; ?></b><br /><br />
              <?php endif; ?>
              <?php echo $content ?>
                <br />
            </div>
        </div>
    </body>
</html>