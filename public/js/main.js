$(document).ready(function() {

    setTimeout(() => {
        logoutFunction();
    }, 300000);

    window.localStorage.getItem('isLogedIn') == 'false' ? window.location.href = "/" : null;

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

$('#logout').click(function() { logoutFunction(); });

function logoutFunction() {

    window.localStorage.setItem('isLogedIn', false);
    window.localStorage.setItem('isAdmin', null);
    window.localStorage.setItem('idUser', null);

    window.location.href = "/";
}