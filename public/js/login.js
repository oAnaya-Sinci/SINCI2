// HTTPS
// var urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443
// HTTP
// var urlData = "http://10.10.100.34:1880"; // PRODUCTION SERVER WITHOUT SECURE PROTOCOL 80

var currenUrl = window.location.href.split("/")[2];
currenUrl = currenUrl.split(":");

var urlData = "https://" + currenUrl[0] + ":1880";

// urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443

var keyAccess;

$(document).ready(function() {

    IsLogedIn();
});

$('#loginPassword').keyup(function(key) {

    $('#loginPassword').focus();
});

$('#loginPassword').keyup(function(key) {

    if (key.keyCode == 13)
        $('#btnLogin').click();
});

$('#btnLogin').click(async function() {

    var formData = $('#loginForm').serializeArray();

    let userData = { "usuario": formData[1], "clave": formData[2], "token": formData[0] }

    if (!checkInputs()) {

        clearTimeout();

        setTimeout(() => {
            $(".invalid-feedback").css("display", "none");
        }, 7000);

        return false;
    }

    await $.ajax({
        type: "POST",
        url: urlData + "/authenticate/login",
        data: userData,
        success: function(response) {

            response = JSON.parse(response)[0];
            // response = response[0];

            if (response.sessionAuth == 'No Access Granted') {

                $("#noAccessModal .modal-header h4").text(response.sessionAuth);
                $("#noAccessModal").modal('show');

                modalConfirm(function(confirm) {
                    if (confirm) {

                    } else {
                        console.log(confirm);
                    }
                });
            } else if (response.sessionAuth != 'false') {
                window.localStorage.setItem('sasIsLogedIn', response.sessionAuth);
                // window.location.href = "/dashboard";
                window.location.href = "/bitacoras/main";
            } else {
                // window.localStorage.setItem('sasIsLogedIn', false);
                window.localStorage.removeItem('sasIsLogedIn');

                $(".invalid-feedback.login").css("display", "block");

                setTimeout(() => {
                    $(".invalid-feedback").css("display", "none");
                }, 7000);
            }
        },
        error: function(exception) {

            console.log(exception);
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
        data: { "isLogedIn": window.localStorage.getItem('sasIsLogedIn') },
        success: function(response) {

            response = JSON.parse(response)[0];

            if (response.sessionAuth != 'false') {
                window.localStorage.setItem('sasIsLogedIn', response.sessionAuth);
                // window.location.href = "/dashboard";
                window.location.href = "/bitacoras/main";
            } else {
                window.localStorage.setItem('sasIsLogedIn', 'false');
            }
        },
        error: function(exception) {

            console.log(exception);
        }
    });
}

var modalConfirm = function(callback) {

    // $("#modal-btn-si").on("click", function() {
    //     callback(true);
    //     $("#mi-modal").modal('hide');
    // });

    $("#modal-btn-no").on("click", function() {
        callback(false);
        $("#noAccessModal").modal('hide');
    });
};