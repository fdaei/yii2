$( function () {
    "use strict";
    $('#modalButton').click( function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});
