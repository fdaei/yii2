$( function () {
    "use strict";
    $(document).on('click','.language', function(){
        var lang = $(this).attr('id');
        // $.post('index.php?r=site%2Flanguage', {'lang':lang},function (data) {
        //     location.reload();
        // });
    });
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
    $(document).on('click','#suggtion', function(){
        var data = $("#globalSearch").val();
        // $.get('/index.php?r=companies%2Fsuggestion',{'data':data},function(data){});

        console.log( $.get('/index.php?r=companies%2Fsuggestion',{'data':data}));
    });
});
