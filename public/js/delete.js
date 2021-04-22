$(function () {
    $('form.delete').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,

            success:function (data) {
                alert(data.msg);
                document.location.href = '/home';
            }
        });
    });
});
