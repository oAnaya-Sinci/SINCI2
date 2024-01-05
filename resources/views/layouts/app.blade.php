
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <!-- <link rel="icon" type="image/png" href="/img/favicon.png"> -->
    <link rel="icon" type="image/png" href="/img/sinci.ico" sizes="32x32">
    <title>{{ config('app.name', 'SAS SINCI') }}</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lora%3A400%2C400italic%2C700%2C700italic%7CPoppins%3A400%2C500%2C600%2C700&ver=1.1.3" />
    <!-- Nucleo Icons -->
    <link href="/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    <link href='../css/datepicker.min.css' rel='stylesheet' media='print' />
    <link href="/css/bootstrap-select.css" rel="stylesheet" />
    <link href="/css/sinciStyles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="dropdown-scroll.css"> -->
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script> -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('cssSection')

</head>
<style>
/* Google Fonts Import Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.wrapper{
  display: flex;
  min-height: 100%;
}
.sidebar{
  display: flex;
  flex-direction: column;
  margin-bottom: 0;
  min-height: 100vh;
  width: 260px;
  background: #8A1F03;
  background-size: cover;
  z-index: 100;
  transition: all 0.5s ease;
  box-shadow: 5px 5px 5px #aaaaaa;
}
.sidebar.close{
  width: 78px;
}
.sidebar .logo-details{
  height: 60px;
  width: 100%;
  display: flex;
  align-items: center;
}
.sidebar .logo-details i{
  font-size: 30px;
  color: #fff;
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
}
.sidebar .logo-details .logo_name{
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  transition: 0.3s ease;
  transition-delay: 0.1s;
}
.sidebar.close .logo-details .logo_name{
  transition-delay: 0s;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links{
  height: 100%;
  padding: 30px 0 100px 0;
  overflow: auto;
}
.sidebar.close .nav-links{
  overflow: visible;
}
.sidebar .nav-links::-webkit-scrollbar{
  display: none;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  transition: all 0.4s ease;
}
.sidebar .nav-links li:hover{
  background: #D9531E;
  opacity: 0.5;
}
.sidebar .nav-links li .icon-link{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sidebar.close .nav-links li .icon-link{
  display: block
}
.sidebar .nav-links li i{
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}
.sidebar .nav-links li.showMenu i.arrow{
  transform: rotate(-180deg);
}
.sidebar.close .nav-links i.arrow{
  display: none;
}
.sidebar .nav-links li a{
  display: flex;
  align-items: center;
  text-decoration: none;
}
.sidebar .nav-links li a .link_name{
  font-size: 18px;
  font-weight: 400;
  color: #fff;
  transition: all 0.4s ease;
}
.sidebar.close .nav-links li a .link_name{
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li .sub-menu{
  padding: 6px 6px 14px 80px;
  margin-top: -10px;
  background: #8A1F03;
  display: none;
}
.sidebar .nav-links li.showMenu .sub-menu{
  display: block;
}
.sidebar .nav-links li .sub-menu a{
  color: #fff;
  font-size: 15px;
  padding: 5px 0;
  white-space: nowrap;
  opacity: 0.6;
  transition: all 0.3s ease;
}
.sidebar .nav-links li .sub-menu a:hover{
  opacity: 1;
}
.sidebar.close .nav-links li .sub-menu{
  position: absolute;
  left: 100%;
  top: -10px;
  margin-top: 0;
  padding: 10px 20px;
  border-radius: 0 6px 6px 0;
  opacity: 0;
  display: block;
  pointer-events: none;
  transition: 0s;
}
.sidebar.close .nav-links li:hover .sub-menu{
  top: 0;
  opacity: 1;
  pointer-events: auto;
  transition: all 0.4s ease;
}
.sidebar .nav-links li .sub-menu .link_name{
  display: none;
}
.sidebar.close .nav-links li .sub-menu .link_name{
  font-size: 18px;
  opacity: 1;
  display: block;
}
.sidebar .nav-links li .sub-menu.blank{
  opacity: 1;
  pointer-events: auto;
  padding: 3px 20px 6px 16px;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li:hover .sub-menu.blank{
  top: 50%;
  transform: translateY(-50%);
}
.sidebar .profile-details{
  position: fixed;
  bottom: 0;
  width: 260px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #D9531E;
  padding: 12px 0;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details{
  background: none;
}
.sidebar.close .profile-details{
  width: 78px;
}
.sidebar .profile-details .profile-content{
  display: flex;
  align-items: center;
}
.sidebar .profile-details img{
  height: 52px;
  width: 52px;
  object-fit: cover;
  border-radius: 16px;
  margin: 0 14px 0 12px;
  background: #D9531E;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details img{
  padding: 10px;
}
.sidebar .profile-details .profile_name,
.sidebar .profile-details .job{
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  white-space: nowrap;
}
.sidebar.close .profile-details i,
.sidebar.close .profile-details .profile_name,
.sidebar.close .profile-details .job{
  display: none;
}
.sidebar .profile-details .job{
  font-size: 12px;
}
.home-section{
  position: relative;
  background: #E4E9F7;
  min-height: 100%;
  left: 0px;
  width: calc(100% - 260px);
  transition: all 0.5s ease;
}
.sidebar.close ~ .home-section{
  left: 0px;
  width: calc(100% - 78px);
}
.home-section .home-content{
  height: 60px;
  display: flex;
  align-items: center;
}
.home-section .home-content .bx-menu,
.home-section .home-content .text{
  color: #8A1F03;
  font-size: 35px;
}
.home-section .home-content .bx-menu{
  margin: 0 15px;
  cursor: pointer;
}
.home-section .home-content .text{
  font-size: 26px;
  font-weight: 600;
}
@media (max-width: 400px) {

  .sidebar.close.small-screen{
    width: 0;
  }

  .sidebar.close.small-screen ~ .home-section{
    width: 100%;
    left: 0;
    z-index: 100;
  }
}

.inactive{
    display: none;
}

</style>
<body>
<div class="loader"></div>
  <div class="wrapper">
    <div class="sidebar">
      <div class="logo-details">
        <i class=''></i>
        <span class="logo_name">WEB SASS</span>
      </div>
      <ul class="nav-links">
        <li class="bitacora inactive">
          <a href="/bitacoras/main">
            <i class='bx bx-calendar'></i>
            <span class="link_name">Bitacora</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="/bitacoras/main">Bitacora</a></li>
          </ul>
        </li>
        <li class="onlyAdmin inactive">
          <a href="/users">
            <i class='bx bx-user'></i>
            <span class="link_name">Usuarios</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="/users">Usuarios</a></li>
          </ul>
        </li>
        <li class="onlyAdmin inactive">
          <a href="/settings">
            <i class='bx bx-file'></i>
            <span class="link_name">Configuración</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="/settings">Configuración</a></li>
          </ul>
        </li>
        <li  class="onlyAdmin reports inactive">
          <a href="/reports">
            <i class='bx bx-line-chart'></i>
            <span class="link_name">Reportes</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="/reports">Reportes</a></li>
          </ul>
        </li>
        <li>
          <div class="profile-details">
            <div class="profile-content">

            </div>
            <div class="name-job">
              <div class="profile_name">Cerrar sesión</div>
            </div>
            <a href="#" id="logout">
                    <i class='bx bx-log-out'></i>
                </a>
          </div>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu'></i>
        {{ $titulo ?? '' }}
        <br />
      </div>
      <div class="container-fluid">
      @yield('pageContent')
      </div>
    </section>
  </div>
    <input type="hidden" class="form-control" id="userData" value="">

        @include('layouts.modals')



    <!--   Core JS Files   -->
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/js/plugins/chartjs.min.js"></script>

    <!-- <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
            damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script> -->

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/material-dashboard.min.js?v=3.0.0"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script> -->


    <script src='/js/momentjs/momentJS.js' type="text/javascript"></script>
    <script src='/js/momentjs/moment-timezone.js' type="text/javascript"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> -->

    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

    <script src='/js/datepicker.min.js' type="text/javascript"></script>
    <script src='/js/bootstrap-select.js' type="text/javascript"></script>

    <!-- <script src='../js/login.js' type="text/javascript"></script> -->
    <script src='/js/main.js' type="text/javascript"></script>

    <!-- <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->

    <!-- Html2Pdf -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js" integrity="sha512vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A==" crossorigin="anonymous"></script> -->
    <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");

    $(function () {


      resizeScreen();
      $(window).resize(function(){
        resizeScreen();
      });
      $('.bx-menu').click(function(){


        if(document.body.clientWidth > 400){
          $('.sidebar').toggleClass('close');
        }else{
          $('.sidebar').toggleClass('small-screen');
        }
      });

      function resizeScreen() {

        if(document.body.clientWidth < 400){
          $('.sidebar').addClass('close');
        }else{
          $('.sidebar').removeClass('close');
        }
      }
    });
  </script>
    @yield('jsSection')

</body>

</html>
