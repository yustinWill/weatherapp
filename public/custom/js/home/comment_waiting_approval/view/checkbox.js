jQuery(document).ready(function() {
    //select all checkboxes
    $("#comment_check_all").change(function(){  //"select all" change 
        $(".comment_check").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });

    //".checkbox" change 
    $('.comment_check').change(function(){ 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(false == $(this).prop("checked")){ //if this item is unchecked
            $("#comment_check_all").prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.comment_check:checked').length == $('.comment_check').length ){
            $("#comment_check_all").prop('checked', true);
        }
    });
});