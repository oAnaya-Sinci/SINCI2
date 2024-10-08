// HTTPS
// var urlData = "https://10.10.100.34:1880"; // PRODUCTION SERVER WITH SECURE PROTOCOL 443
// HTTP
// var urlData = "http://10.10.100.34:1880"; // PRODUCTION SERVER WITHOUT SECURE PROTOCOL 80

var currentUrl = window.location.href.split("/")[2];
currentUrl = currentUrl.split(":");

var urlData = "https://websas.sinci.com:1880";

// var URL to my Local UBUTBU Server for the update
// var urlData = "https://192.168.0.102:1880";
// var urlData = "http://localhost:1880";
// var urlData = "https://10.10.100.34:1880";

var timeOut;

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 12:23:26
 * @Desc: Here iniciate some of the elements required for a good work of the proyect
 */
$(document).ready(function () {

  console.time('Session');

  IsLogedIn();

  let isAdmin = Number(window.localStorage.getItem('isAdmin'));
  let encuestario = Number(window.localStorage.getItem('encuestador'));
  let seeReports = Number(window.localStorage.getItem('seeReports'));

  if(encuestario != 1){
    document.querySelectorAll('.ingProyectos').forEach( elem => {
      elem.style.display = 'none';
    });
   } else{
    document.querySelectorAll('.encuestadores').forEach( elem => {
      elem.style.display = 'none';
    });
   }

  if (isAdmin) {
    // document.querySelectorAll('.nav-links .onlyAdmin').forEach((elem) => { elem.classList.add('inactive') });
    document.querySelectorAll('.nav-links .onlyAdmin').forEach((elem) => { elem.classList.toggle('inactive') });
    document.querySelectorAll('.nav-links .bitacora').forEach((elem) => { elem.classList.toggle('inactive') });
  } else {
    document.querySelectorAll('.nav-links .bitacora').forEach((elem) => { elem.classList.toggle('inactive') });
    if (seeReports)
      document.querySelectorAll('.nav-links .reports').forEach((elem) => { elem.classList.toggle('inactive') });
  }

  timeOut = setTimeout(() => { return false }, 1000);

  set_TimeOut();

  moment.updateLocale('en', {
    months: [
      "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Augosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ]
  });

  moment.updateLocale('en', {
    monthsShort: [
      "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
    ]
  });

  // $('body').addClass('g-sidenav-pinned');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 12:24:43
 * @Desc: This function set a timer, to close the proyect if the time is over
 */
function set_TimeOut() {

  // let timeSession = 305000; // 5 minutes
  // let timeSession = 605000; // 10 minutes
  let timeSession = 905000; // 15 minutes
  // let timeSession = 6005000; // 100 minutes

  clearTimeout(timeOut);

  timeOut = setTimeout(() => {
    IsLogedIn();
  }, timeSession);
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 12:22:39
 * @Desc:  This function let the user login to the proyect using the enter key
 */

$(document).click(function () {
  IsLogedIn();

  $('.g-sidenav-pinned #sidenav-main').removeClass('bg-white');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 12:22:11
 * @Desc: This function close the session of the user in the proyect
 */

$('#logout').click(function () {

  window.localStorage.setItem('sasIsLogedIn', 'false');
  window.location.href = "/";
});

async function IsLogedIn() {

  await $.ajax({
    type: "POST",
    url: urlData + "/authenticate/isLogedIn",
    data: { "isLogedIn": window.localStorage.getItem('sasIsLogedIn') },
    success: function (response) {

      response = JSON.parse(response)[0];

      if (response.sessionAuth != 'false') {
        set_TimeOut();
        window.localStorage.setItem('sasIsLogedIn', response.sessionAuth);
      } else {
        window.localStorage.setItem('sasIsLogedIn', 'false');
        console.timeEnd('Session');

        window.location.href = "/";
      }
    },
    error: function (exception) {

      console.error(exception);
      showMessage("danger", "error", exception)
      // window.location.href = "/";
    }
  });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
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

$('.btnCancelModal').click(function () {

  $('.modal').modal('hide');
});

//
var modalConfirm = function (callback) {

  // $("#btn-confirm").on("click", function() {
  //     $("#mi-modal").modal('show');
  // });

  $("#modal-btn-si").on("click", function () {
    callback(true);
    $("#mi-modal").modal('hide');
  });

  $("#modal-btn-no").on("click", function () {
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-04 10:58:32
 * @Desc: This block of code is for the load page waiter
 */

var inLoader = () => {
  $(".loader").fadeIn("slow");
}

var outLoader = () => {
  $(".loader").fadeOut("slow");
}

var dataLogin = () => {

  let keyLogin = window.localStorage.getItem('sasIsLogedIn').split("/");

  let newStr = "";
  let x = 0;
  $.each(keyLogin, function (index, value) {

    if (x < keyLogin.length - 1)
      newStr += value + "-";
    else
      newStr += value;

    x++;
  });
  keyLogin = newStr;

  keyLogin = keyLogin.split("+");

  newStr = "";
  x = 0;
  $.each(keyLogin, function (index, value) {

    if (x < keyLogin.length - 1)
      newStr += value + "_";
    else
      newStr += value;

    x++;
  });
  keyLogin = newStr;

  return keyLogin;
}

let checkIsAdmin = async (isReports = false) => {

  let userEmail = localStorage.getItem('userEmail');

  let response = await fetch(urlData + `/checkisadmin?user_email=${userEmail}`).then(json => json.json()).then(data => data);

  localStorage.setItem('isAdmin', response.isAdmin);
  localStorage.setItem('seeReports', response.seeReports);

  if (!isReports) {
    if (localStorage.getItem('isAdmin') == 0) {

      document.querySelector('.container-fluid').remove();;

      location.href = "/bitacoras/main";
    }
  } else {
    if (localStorage.getItem('isAdmin') == 0 && localStorage.getItem('seeReports') == 0) {

      document.querySelector('.container-fluid').remove();;

      location.href = "/bitacoras/main";
    }
  }
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-31 09:03:25
 * @Desc: Github Copilot
 */
