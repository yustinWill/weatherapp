$(document).ready(function () {
    $('#signup-form').on('submit', function (e) {
        var curr_this = $(this);
        $.ajax({
            url: curr_this.attr('action'),
            data: curr_this.serialize(),
            type: 'POST',
            beforeSend: function(){
                KTApp.block('#signup-form', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'primary',
                    message: 'Loading...'
                });
            },
            success: function (data) {
                Swal.fire({
                    title: 'Success!',
                    text: "Subscription success",
                    icon: 'success',
                    confirmButtonColor: '#D94148',
                }).then(function(result) {
                    if (result.value) {
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                })
            },
            error: function (data) {
                var data = data.responseJSON;
                if (Array.isArray(data.message)) {
                    var err_message = "<ol>";
                    for (let i = 0; i < data.message.length; i++) {
                        err_message += "<li>"+data.message[i]+"</li>";
                    }
                    err_message += "</ol>";
                }
                else{
                    err_message = data.message;
                }
                Swal.fire({
                    title: 'Error!',
                    width: "35%",
                    html: err_message,
                    icon: 'error',
                    confirmButtonColor: '#D94148',
                });
            },
            complete:function(data){
                KTApp.unblock('#signup-form');
            }
        });
        e.preventDefault();
    });
});