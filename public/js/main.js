$(function () {
    var spans = document.getElementsByClassName('error-text');
    $("#form").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function () {

            },
            success:function (data) {
                $('#form')[0].reset();
                alert(data.msg);
                console.log(data.status);
                document.location.href = '/home';
            },
            complete:function (data) {
                if (data.status == 422) {
                    var errors = data.responseJSON.errors.name;
                    for (var i = 0; i < errors.length; i++) {
                        spans[i].innerHTML = errors[i];
                    }
                } else if (data.status == 200) {
                    $('#form')[0].reset();
                    //alert(data.msg);
                }
                console.log(data.status);
            }
        });
    });
});
