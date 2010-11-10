$(document).ready(function(){
	$(".up").click(function(e){
		e.preventDefault();
		vote($(this));
	});
});

function vote(clicked){
	quote_id = clicked.parent().parent().attr('id').substring(1);
	
	up   = $("#qu" + quote_id);
		
	$.post('<?php echo URL::site('quotes/vote'); ?>', {'id' : quote_id}, function(data){
		if (data == '1'){
            up.text(parseInt(up.text(), 10) + 1);
        }
	});
}