// var urlData = "//localhost:1880";
var urlData = "http://192.168.0.103:1880"; // DEVELOPMENT SERVER VMWARE HTTPS 80
// var urlData = "https://192.168.0.103:1880"; // DEVELOPMENT SERVER VMWARE HTTPS 443


// var urlData = "http://10.10.103.206:1880"; // Servidor de Pruebas

// HTTPS
// var urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443
// HTTP
// var urlData = "http://10.10.100.34:1880"; // PRODUCTION SERVER WITHOUT SECURE PROTOCOL 80

$(document).ready(function() {

    window.localStorage.getItem('isLogedIn') == 'true' ? window.location.href = "/dashboard" : null;
});

$('#btnLogin').click(function() {

    var formData = $('#loginForm').serializeArray();

    let userData = { "usuario": formData[1], "clave": formData[2], "token": formData[0] }

    $.ajax({
        type: "POST",
        url: urlData + "/authenticate/login",
        data: userData,
        success: function(response) {

            response = JSON.parse(response)[0];

            if (response != null) {
                window.localStorage.setItem('isLogedIn', true);
                window.localStorage.setItem('isAdmin', response.ADMINISTRADOR);
                window.localStorage.setItem('idUser', response.ID_USUARIO);
                window.location.href = "/dashboard";
            } else {
                window.localStorage.setItem('isLogedIn', false);

                $(".invalid-feedback").css("display", "block");

                setTimeout(() => {
                    $(".invalid-feedback").css("display", "none");
                }, 5000);
            }
        },
        error: function(exception) {

            console.log(exception);
        }
    });
});