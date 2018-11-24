/**
 * Created by Mamdouh on 24/11/2018.
 */

$(document).ready(function () {
    // Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Show Sweetalert error
    window.swalError = function(jqXHR, exception){
        if (jqXHR.status === 0) {
            swal('Oops..', 'Not connect.n Verify Network.', 'error');
        } else if (jqXHR.status === 422) {
            const response = jqXHR.responseJSON;
            const firstError = response.errors;
            swal(response.message, JSON.stringify(firstError[Object.keys(firstError)[0]][0]), 'error');
        } else if (jqXHR.status === 404) {
            swal('Oops..', 'Requested page not found. [404]', 'error');
        } else if (jqXHR.status === 403) {
            swal('Forbidden', 'You are not authorized to do that action [403]', 'error');
        } else if (jqXHR.status === 500) {
            swal('Oops..', 'Internal Server Error [500].', 'error');
        } else if (exception === 'timeout') {
            swal('Oops..', 'Time out error, Please Refresh and try again', 'error');
        } else {
            swal('Uncaught Error..', jqXHR.responseText, 'error');
        }
    };

    // Paginate with Load more
    $(document).on('click', '.paginate', function () {
        const elem = $(this);
        const url = elem.attr('data-url');
        const container = $('#' + elem.attr('data-container-id'));
        const loader = $('#' + elem.attr('data-container-id') + ' .loader');
        elem.hide();
        loader.show();
        $.ajax({
            url: url,
            success: function (data) {
                container.append(data);
                elem.parent().remove();
            }
        })
    });
});