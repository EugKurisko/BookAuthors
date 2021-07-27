var bookModal = $('#book-modal');

// $('#book_save').on('click', function (e) {
//     e.preventDefault();
//     // $(document).ready(function () {
//
//
//     // });
//     // console.log($('#BookModel').serialize());
//     // let data = {
//     //     book: $('#book').serializeArray(),
//     //     title: $('#title_id').val(),
//     //     description: $('#desc_id').val(),
//     //     date: $('#date_id').val(),
//     //     image: $('#image_id').val(),//$('#image_id').val().split("\\")[2],
//     //     authors: $('#dropDown_id').val()
//     // }
//     let data = $('#BookModel').serialize();
//     // let data = {
//     // img: img
//     // };
//     //
//     // img: $('#image_id').val()
//
//
//
//     // console.log($('#title_id').val());
//     // console.log($('#desc_id').val());
//     // console.log($('#date_id').val());
//     // console.log($('#image_id').val());
//
//     let url = window.location.href + '/create';
//     Ajax('POST', data, url, function () {
//         console.log(1);
//     })
//     console.log(url);
//
// })

// $('#book_save').on('click', function (e) {
// e.preventDefault();
//     var data = new FormData();
//     var file = $('#image_id')[0].files;
// console.log(file);
//     // Check file selected or not
//     if (file.length > 0) {
//
//         console.log(data);
//         let book = $('#BookModel').serialize();
//         // data.append('Book', book);
//
//         // data.append('file', file[0]);
//         // data.append('book', $('#BookModel').serialize());
//         // data.append('title', $('#title_id').val());
//         // data.append('description', $('#date_id').val());
//         // data.append('date', $('#date_id').val());
//         // data.append('authors', $('#dropDown_id').val());
//         console.log(1);
//         $.ajax({
//             url: window.location.href + '/create',
//             type: 'POST',
//             data: data,
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function (response) {
//                 if (response != 0) {
//                     $("#img").attr("src", response);
//                     $(".preview img").show(); // Display image element
//                 } else {
//                     alert('file not uploaded');
//                 }
//             },
//         });
//     } else {
//         alert("Please select a file.");
//     }
// });