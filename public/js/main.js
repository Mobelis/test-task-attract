$(document).ready(function(){
    $('.com-del').click(function(){
        var id = $(this).attr('data-id');
        var token = $(this).attr('data-token');
        if(id) {
            $.ajax({
                url: '/comment/delete',
                type: "post",
                data: {'id': id,'_token':token},
                success: function (data) {
                    if(data['success']===true) {
                        $('#com-' + id).hide('slow', function(){ $('#com-' + id).remove(); });
                    }
                }
            });
        }
    });
});