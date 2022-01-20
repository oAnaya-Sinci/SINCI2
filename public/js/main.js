$('#logout').click(function() {

    console.log("logout");

    logoutFunction();
})

function logoutFunction() {

    var data = {
        _token: $('meta[name="csrf-token"]').attr('content')
    }

    $.ajax({
        type: 'POST',
        url: '/logout',
        data: data,
        success: function(data) {

            location.href = "/";
        },
        error: function(Message) {
            showError(Message);
        }
    });
}