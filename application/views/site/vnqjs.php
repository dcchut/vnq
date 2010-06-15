$(document).ready(function(){
	$(".up").click(function(e){
		e.preventDefault();
		vote(true, $(this));
	});
	
	$(".down").click(function(e){
		e.preventDefault();
		vote(false, $(this));
	});
});

function vote(upvoted, clicked){
	quote_id = clicked.parent().parent().attr('id').substring(1);
	
	up   = $("#qu" + quote_id);
	down = $("#qd" + quote_id);
		
	$.post('<?php echo URL::site('quotes/vote'); ?>', {'id' : quote_id, 'up' : upvoted}, function(data){
		if (data == '1'){
			if (upvoted){
				up.text(parseInt(up.text(), 10) + 1);
			} else {
				down.text(parseInt(down.text(), 10) + 1);
			}
		}
	});
}