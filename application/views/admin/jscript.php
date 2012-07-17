$(document).ready(function(){
    $(".accept").click(function(e){
        e.preventDefault();
        qtf = "#qt" + $(this).attr('id');
        if ($(qtf).attr('edit') == 1) {
            // replace with what we have moderated to
            post_status($(this).attr('id'), 1, $(qtf).val());
        } else {
            post_status($(this).attr('id'), 1, '');
        }
    });

    $(".decline").click(function(e){
        e.preventDefault();
        post_status($(this).attr('id'), 3, '');
    });

    // click on a quote, it becomes editable
    $(".quote").click(function(e){
        textarea = $("<textarea>");
        textarea.html($.trim($(this).text()));
        textarea.attr('id', $(this).attr('id'));
        textarea.attr('edit', 1);
        $(this).replaceWith(textarea);
    });
    
    // enter a quote id, load the quote text
    $(".qid").blur(function(){
        $.post('<?php echo URL::site('admin/moderate3'); ?>', {'id' : $(this).val()}, function(data){
            $("#quote").text(data);
        });
    });
    
    var uhide = false;
    var rfloat = $("#rfloat");
    $(".urow").mouseenter(function(){
        // position of this row
        var position = $(this).offset();
        // quote id we are currently moused over
        var id = $(this).children('.acol_id').children('a').text().substring(1);
        
        var width = $(this).width() + 25;
        uhide = false;
        
        $.post('<?php echo URL::site('admin/moderate3'); ?>', {'id' : id}, function(data){
            if (!uhide) {
                var text = $('<div />').text(data).html();
                $(rfloat).html(text.replace(/\n/g,'<br/>')).css({top: position.top,
                                                                 left: position.left + width}).show('slow');
            }
        });
    }).mouseleave(function(){
        $("#rfloat").hide();
        uhide = true;
    });
});

function post_status(id, status, t){
    $.post('<?php echo URL::site('admin/moderate2'); ?>', {'id' : id, 'status' : status, 't' : t}, function(data){
        if (data == 1){
            $("#q" + id).hide("slow", function(){
                // show the number of quotes still to be moderated
                $("#unquotes").text($(".qmain:visible").size());
                
                // if we've moderated everything, show a nice message
                if ($(".qmain:visible").size() == 0)
                    location.reload();
            });
        } else {
            alert('something bad happened!');
            alert(data);
        }
    });
};
