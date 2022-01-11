<!--
  * Este archivo muestra la estructura que se debe de seguir para añadir mas modulos al proyecto
-->

<!-- Al inicio se añade la base de las vistas donde se incluye el sidebar, topbar y  -->
@extends('layouts.app')

<!-- Esta seccion esta reservada para añadir los archivos CSS requeridos para el modulo que se va a agregar al proyecto-->
@section('cssSection')

  <link href='../css/calendar/fullcalendar.css' rel='stylesheet' />

@endsection
<!-- END -->

<!-- Aqui se añade el codigo HTML para crear el modulo requerido  -->
@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-6 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">

            <div class=" pt-1">

              <!-- Seccion reservada para añadir codigo HTML -->

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
<!-- END -->

<!-- Esta seccion esta reservada para añadir los archivos JS requeridos para el modulo que se va a agregar al proyecto-->
@section('jsSection')

  <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script>

@endsection
<!-- END -->