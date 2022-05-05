
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">

<nav class="navbar navbar-main navbar-expand-lg px-0 4 shadow-none border-radius-xl" id="navbarBlurLogo" navbar-scroll="true" >
      <div class="container-fluid">

          <!-- <img src="https://sinci.com/wp-content/uploads/2019/10/logo-sinci.-servicios-de-automatizacion-y-control-de-procesos-industriales-en-mexico.png" class="navbar-brand-img h-100" alt="main_logo"> -->
          <img src="/img/Logo_Sinci.svg" class="navbar-brand-img h-100" alt="main_logo" width="80px" height="80px">
          <!-- <span class="ms-1 font-weight-bold sinciLogoName">{{ config('app.name', 'SAS SINCI') }}</span> -->

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

          <!-- <li class="nav-item">
            <a class="nav-link text-white bg-gradient-primary" href="/dashboard">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li> -->

        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-primary" href="/bitacoras/main">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">event_note</i>
            </div>
            <span class="nav-link-text ms-1">Bitácoras</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white bg-gradient-primary" href="/compras/main">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">point_of_sale</i>
            </div>
            <span class="nav-link-text ms-1">Compras</span>
          </a>
        </li>

      </ul>

        <!-- <ul class="navbar-nav">
            <li class="nav-item ps-3 d-flex align-items-center" >
                <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="iconNavbarSidenav">
                    <i class="fa fa-arrow-circle-left fa-3x" style="color: #fff; font-size: 1.5em;"></i>
                </a>
            </li>
        </ul> -->
    </div>

  </aside>
