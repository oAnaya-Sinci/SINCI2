@extends('layouts.app')

@section('cssSection')
@endsection

@section('pageContent')

    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="pt-1">
                        <div id='wrap'>
                            <div id='exceptions'>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn--large btn-outline-primary btn-block btn-create-exception" type="button" style="padding: 0.35rem 0.65rem;">Nueva Excepción</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="fecha"> Fecha Ingreso </span></th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="noti_email">Notificación Email </span></th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="noti_telegram">Notificación Telegram </span></th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="admin">Administrador </span></th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="ver_reporte">Ver Reportes </span></th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
                                                    <tr>
                                                        <td>2022-03-14</td>
                                                        <td>10:00</td>
                                                        <td>Horas de puesta en servicio</td>
                                                        <td>Descripción</td>
                                                        <td>Descripción</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('jsSection')
<script src='../js/calendar/jquery-ui.custom.min.js' type="text/javascript"></script>
<script>
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/exception-dates/main"]').addClass('bg-gradient-primary');

    document.querySelector('.btn-create-exception').addEventListener('click', function () {
        window.location.href = '/exception-dates/create';
    });

    setTimeout(() => {
        outLoader();
    }, 1000);
</script>
@endsection

