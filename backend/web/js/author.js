$('#author_save').on('click', function (e) {
    e.preventDefault();
    let url = window.location.href + '/create';
    console.log(url);
    let data = $('#AuthorModel').serialize();
    Ajax('POST', data, url, function()
    {
        console.log(1);
    })
})