
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    
<nav class="navbar navbar-main navbar-expand-lg px-0 4 shadow-none border-radius-xl" id="navbarBlurLogo" navbar-scroll="true" >
      <div class="container-fluid py-2 px-3">
      
          <img src="https://sinci.com/wp-content/uploads/2019/10/logo-sinci.-servicios-de-automatizacion-y-control-de-procesos-industriales-en-mexico.png" class="navbar-brand-img h-100" alt="main_logo">

          <span class="ms-1 font-weight-bold sinciLogoName">{{ config('app.name', 'SAS SINCI') }}</span>
    
        </div>
      </div>
    </nav>

    <div class="sidenav-header" style="display: none;">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <!-- <a class="navbar-brand m-0" href="{{ config('app.url', '/') }}"> -->
      <a class="navbar-brand m-0" href="#">
        <img src="/img/logo-sinci.png" class="navbar-brand-img h-100" alt="main_logo">
        <!-- <img src="/img/white-sinci.png" class="navbar-brand-img h-100" alt="main_logo"> -->
        <span class="ms-1 font-weight-bold text-white">{{ config('app.name', 'SAS SINCI') }}</span>
      </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 bg-gradient-dark border-radius-xl" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-primary" href="/dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-primary" href="/bitacoras/main">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">Bitacoras</span>
          </a>
        </li>

      </ul>
    </div>
    
  </aside>