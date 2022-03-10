
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
        <!-- <link rel="icon" type="image/png" href="/img/favicon.png"> -->
        <link rel="icon" type="image/png" href="/img/sinci.ico" sizes="32x32">
        <title>{{ config('app.name', 'SAS SINCI') }}</title>
        
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- CSS Files -->
        <link id="pagestyle" href="/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

        <link href="/css/sinciStyles.css" rel="stylesheet" />
        
    </head>

    <body class="g-sidenav-show  bg-gray-200">
        
        <div class="loader"></div>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
                <span class="mask bg-gradient-dark opacity-0"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1" style="display: inline-block; width: 100%; text-align: center;">
                                        <!-- <img src="/img/white-sinci.png" class="navbar-brand-img h-100" alt="main_logo"> -->
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">SAS Login</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="loginForm">
                                        @csrf
                                        
                                        <div class="input-group input-group-outline my-4">
                                            <label class="form-label">Usuario</label>
                                            <input type="text" id="loginEmail" class="form-control @error('email') is-invalid @enderror" name="usuario" required autocomplete="email" autofocus>

                                            <span class="invalid-feedback nickname" role="alert">
                                            <strong>Campo requerido</strong>
                                        </span>
                                        </div>
                                        
                                        <div class="input-group input-group-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="loginPassword" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            <span class="invalid-feedback password" role="alert">
                                            <strong>Campo requerido</strong>
                                        </span>
                                        </div>

                                        <span class="invalid-feedback login" role="alert">
                                            <strong>El nombre de usuario o contraseña son incorrectos</strong>
                                        </span>
                                        
                                        <div class="text-center">
                                            <button type="button" id="btnLogin" class="btn bg-gradient-primary w-100 my-4 mb-2">Ingresar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        @include('layouts.modals')  

        <!--   Core JS Files   -->
        <script src="/js/core/popper.min.js"></script>
        <script src="/js/core/bootstrap.min.js"></script>
        <script src="/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="/js/plugins/chartjs.min.js"></script>
    
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="/js/material-dashboard.min.js?v=3.0.0"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
        <script src="/js/login.js" type="text/javascript"></script>

    </body>
</html>
