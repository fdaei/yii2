$( function () {
    "use strict";
    $('#modalButton').click( function () {
        $('#modal').removeClass("fade")
            .modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});
