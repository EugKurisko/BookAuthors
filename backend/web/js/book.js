var bookModal = $('#book-modal');

$('#book_save').on('click', function (e) {
    e.preventDefault();
    // console.log($('#BookModel').serialize());
    // let data = {
    //     book: $('#book').serializeArray(),
    //     title: $('#title_id').val(),
    //     description: $('#desc_id').val(),
    //     date: $('#date_id').val(),
    //     image: $('#image_id').val(),//$('#image_id').val().split("\\")[2],
    //     authors: $('#dropDown_id').val()
    // }
    let data = $('#BookModel').serialize();
    // let data = {
        // img: img
    // };
            //
            // img: $('#image_id').val()



    // console.log($('#title_id').val());
    // console.log($('#desc_id').val());
    // console.log($('#date_id').val());
    // console.log($('#image_id').val());

    let url = window.location.href + '/create';
    Ajax('POST', data, url, function () {
        console.log(1);
    })
    console.log(url);

})