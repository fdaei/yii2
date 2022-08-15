$( function () {
    "use strict";
    $(document).on('click','.fc-day',function(){
        var date = $(this).attr('data-date');
        $.get('/index.php?r=events%2Fcreate',{'date':date},function(data){
            $('#modal').removeClass("fade")
                .modal('show')
                .find('#modalContent')
                .html(data);
        });
    });
    $('#modalButton').click( function () {
        $('#modal').removeClass("fade")
            .modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});
