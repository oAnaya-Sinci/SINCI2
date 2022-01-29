
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
        <link rel="icon" type="image/png" href="https://sinci.com/wp-content/uploads/2019/10/logo-sinci.-servicios-de-automatizacion-y-control-de-procesos-industriales-en-mexico-150x134.png" sizes="32x32">
        <title>{{ config('app.name', 'SAS SINCI') }}</title>
        
        <!-- Nucleo Icons -->
        <link href="/css/nucleo-icons.css" rel="stylesheet" />
        <link href="/css/nucleo-svg.css" rel="stylesheet" />
        
        <link id="pagestyle" href="/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
        <link href="/css/sinciStyles.css" rel="stylesheet" />
        
    </head>

    <body class="g-sidenav-show  bg-gray-200">
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
                <span class="mask bg-gradient-dark opacity-0"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">SAS Login</h4>
                                        <div class="row mt-3">
                                            <div class="col-2 text-center ms-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-facebook text-white text-lg"></i>
                                                </a>
                                            </div>
                                            <div class="col-2 text-center px-1">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-github text-white text-lg"></i>
                                                </a>
                                            </div>
                                            <div class="col-2 text-center me-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-google text-white text-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="loginForm">
                                        @csrf
                                        
                                        <div class="input-group input-group-outline my-4">
                                            <label class="form-label">Usuario</label>
                                            <input type="text" id="loginEmail" class="form-control @error('email') is-invalid @enderror" name="usuario" required autocomplete="email" autofocus>
                                        </div>
                                        
                                        <div class="input-group input-group-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="loginPassword" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        </div>

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Login pass fail</strong>
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

        <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script>
        <script src="../js/login.js" type="text/javascript"></script>

    </body>
</html>
