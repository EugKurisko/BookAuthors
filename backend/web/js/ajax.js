function Ajax(method, data, url, successFunction)
{
    $.ajax({
        method: method,
        url: url,
        data: data,
        // processData: false,
        // contentType: false,
        dataType: 'json',
        success: function (request) {
            if (request.status) {
                successFunction(request);
            } else {
                $('.container').first().append('<span data-role="popup" class="error alert alert-danger">Error</span>');

            }
        },
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('Status: ' + xhr.status + ' ' + thrownError);
        }
    });
}