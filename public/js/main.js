// var urlData = "//localhost:1880";
// var urlData = "http://192.168.0.103:1880"; // DEVELOPMENT SERVER VMWARE HTTPS 80
var urlData = "https://192.168.0.103:1880"; // DEVELOPMENT SERVER VMWARE HTTPS 443

// var urlData = "http://10.10.103.206:1880"; // Servidor de Pruebas

// HTTPS
// var urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443
// HTTP
// var urlData = "http://10.10.100.34:1880"; // PRODUCTION SERVER WITHOUT SECURE PROTOCOL 80

console.log(window.location.href);

var currenUrl = window.location.href.split("/")[2];
currenUrl = currenUrl.split(":");

var urlData = "https://" + currenUrl[0] + ":1880";

console.log(urlData);

$(document).ready(function() {

    setTimeout(() => {
        IsLogedIn();
    }, 360000);

    IsLogedIn();

    calendarSinci();

    $('.datetimepicker').datetimepicker({
        // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
        format: 'YYYY-MM-DD HH:mm',

        // Your Icons
        // as Bootstrap 4 is not using Glyphicons anymore
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },

    });
});

$('#logout').click(function() {

    // window.localStorage.removeItem('sasIsLogedIn');
    window.localStorage.setItem('sasIsLogedIn', 'false');

    window.location.href = "/";
});

function IsLogedIn() {

    $.ajax({
        type: "POST",
        url: urlData + "/authenticate/isLogedIn",
        data: { "isLogedIn": window.localStorage.getItem('sasIsLogedIn') },
        success: function(response) {
            // console.log(response);

            response = JSON.parse(response)[0];

            if (response.sessionAuth != 'false') {
                window.localStorage.setItem('sasIsLogedIn', response.sessionAuth);
            } else {
                window.localStorage.setItem('sasIsLogedIn', 'false');
                window.location.href = "/";
            }
        },
        error: function(exception) {

            console.log(exception);
        }
    });
}