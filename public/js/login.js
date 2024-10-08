// HTTPS
// var urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443
// HTTP
// var urlData = "http://10.10.100.34:1880"; // PRODUCTION SERVER WITHOUT SECURE PROTOCOL 80

// var URL to my Local UBUTBU Server for the update
// var urlData = "https://192.168.0.102:1880";
// var urlData = "http://localhost:1880";
// var urlData = "https://10.10.100.34:1880";

var currenUrl = location.href.split("/")[2];
currenUrl = currenUrl.split(":");

var urlData = "https://websas.sinci.com:1880";

var timeOut;

$(document).ready(function() {

    $('.input-group-outline').removeClass('is-filled');
    $('.input-group-outline').removeClass('is-focused');

    fetch(urlData + "/openconn");
    IsLogedIn();
    outLoader();
});

$(document).keyup(function(key) {

    if (key.keyCode == 13)
        $('#btnLogin').click();
});

$('#btnLogin').click(async function() {

    var formData = $('#loginForm').serializeArray();

    let userData = { "usuario": formData[1], "clave": formData[2], "token": formData[0] }

    if (!checkInputs()) {

        timeOut = setTimeout(() => {
            $(".invalid-feedback").css("display", "none");
        }, 6000);

        return false;
    }

    inLoader();

    await $.ajax({
        type: "POST",
        url: urlData + "/authenticate/login",
        data: userData,
        success: function(response) {

            response = JSON.parse(response)[0];
            // response = response[0];

            if (response.sessionAuth == 'No Access Granted') {

                outLoader();

                $("#noAccessModal .modal-header h4").text(response.sessionAuth);
                $("#noAccessModal").modal('show');

                modalConfirm(function(confirm) {
                    if (confirm) {

                    } else {
                        console.log(confirm);
                    }
                });
            } else if (response.sessionAuth != 'false') {
                localStorage.setItem('sasIsLogedIn', response.sessionAuth);
                localStorage.setItem('isAdmin', response.isAdmin);
                localStorage.setItem('seeReports', response.seeReports);
                localStorage.setItem('encuestador', response.encuestador);
                localStorage.setItem('userEmail', formData[1].value+'@sinci.com')

                location.href = "/dashboard";
                // location.href = "/bitacoras/main";
            } else {
                // localStorage.setItem('sasIsLogedIn', false);
                localStorage.removeItem('sasIsLogedIn');

                outLoader();

                showMessage('danger', 'Error', "el correo o la contraseña introducidos son erroneos");
                // $(".invalid-feedback.login").css("display", "block");

                // setTimeout(() => {
                //     $(".invalid-feedback").css("display", "none");
                // }, 7000);
            }
        },
        error: function(exception) {

            outLoader();
            showMessage('danger', 'Error', "Trate de iniciar sesion de nuevo");
            // console.log(exception.statusCode + " - " + exception.statusText);

            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    });
});

function checkInputs() {

    let dataValid = true;

    let nickName = $('#loginEmail').val();
    let password = $('#loginPassword').val();

    if (nickName == "" && password == "") {
        dataValid = false;
        $(".invalid-feedback.nickname").css("display", "block");
        $(".invalid-feedback.password").css("display", "block");
    } else if (nickName == "") {
        dataValid = false;
        $(".invalid-feedback.nickname").css("display", "block");
    } else if (password == "") {
        dataValid = false;
        $(".invalid-feedback.password").css("display", "block");
    }

    return dataValid;
}

async function IsLogedIn() {

    await $.ajax({
        type: "POST",
        url: urlData + "/authenticate/isLogedIn",
        data: { "isLogedIn": localStorage.getItem('sasIsLogedIn') },
        success: function(response) {

            response = JSON.parse(response)[0];

            if (response.sessionAuth != 'false') {
                localStorage.setItem('sasIsLogedIn', response.sessionAuth);
                // location.href = "/dashboard";
                location.href = "/bitacoras/main";
            } else {
                localStorage.setItem('sasIsLogedIn', 'false');
            }
        },
        error: function(exception) {

            console.log(exception);
            outLoader();
            showMessage('danger', 'Error', "Error, trate de iniciar sesion de nuevo");
            // location.reload();
        }
    });
}

var inLoader = () => {
    $(".loader").fadeIn("slow");
}

var outLoader = () => {
    $(".loader").fadeOut("slow");
}

/**
 * javascript comment
 * @Author: flydreame
 * @Date: 2022-02-04 22:08:25
 * @Desc: this function show the messaes in the system abouts the tasks
 */

function showMessage(type, header = "Mensaje del sistema", message = "") {

    switch (type.toLowerCase()) {

        case 'success':
            $('#successToast .mssgHeader').text(header);
            $('#successToast .toast-body').text(message);
            $('.bg-gradient-success').click();
            break;

        case 'warning':
            $('#warningToast .mssgHeader').text(header);
            $('#warningToast .toast-body').text(message);
            $('.bg-gradient-warning').click();
            break;

        case 'info':
            $('#infoToast .mssgHeader').text(header);
            $('#infoToast .toast-body').text(message);
            $('.bg-gradient-info').click();
            break;

        case 'danger':
            $('#dangerToast .mssgHeader').text(header);
            $('#dangerToast .toast-body').text(message);
            $('.bg-gradient-danger').click();
            break;
    }
}

$('.form-control').blur(function() {

    $('.input-group-outline').removeClass('is-filled');
    $('.input-group-outline').removeClass('is-focused');
});

$('.form-control').focus(function() {

    $('.input-group-outline').removeClass('is-filled');
    $('.input-group-outline').removeClass('is-focused');
});
