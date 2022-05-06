
@extends('layouts.app')

@section('cssSection')

  <link href='../css/calendar/fullcalendar.css' rel='stylesheet' />
  <link href='../css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">

            <div class="pt-1">

              <div id='wrap'>

                <div id='calendar'></div>
                <div style='clear:both'></div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- In this space is deployed the modals required to the calendar plugin -->
  <!-- This modal is to save de event on the calendar -->
  <div id="createEventCalendar" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de Evento</h5>
          <!-- <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form id="dataEvent">

            <!-- <span class="invalidRequired hidden">
              <strong>Faltan elementos para guardar el registro</strong>
            </span> -->

            <div class="form-group">
              <label for="message-text" class="col-form-label">Resumen de la bitácora:</label>
              <textarea class="form-control" id="message-text" name="resumen" required></textarea>
            </div>

            <div class="form-group body-modalsSinci">
              <label for="recipient-name" class="col-form-label">Proyecto:</label>

              <!-- <input type="search" class="form-control" id="recipient-name" name="slctProyecto" list="listaProyectos">
              <datalist id="listaProyectos"></datalist> -->

              <!-- <select class="form-select modalForm" name="slctProyecto" id="slctProyecto" required>
                <option value="">NAN</option>
              </select> -->

              <select class="selectpicker form-control" name="slctProyecto" id="slctProyecto" data-live-search="true" data-virtual-scroll="false">
                <option value="">NAN</option>
              </select>

              <!-- <select class="selectpicker form-control" id="number" data-live-search="true" title="Select a number" data-hide-disabled="true"></select> -->
            </div>

            <div id="divUsuarios" class="form-group body-modalsSinci">
              <label id="lblUsuario" for="recipient-name" class="col-form-label">Usuario:</label>
              <!-- <input type="text" class="form-control" id="recipient-name" name="usuario"> -->
              <!-- <select class="form-select modalForm" name="slctUsuario" id="slctUsuario" required> -->
              <select class="selectpicker form-control" name="slctUsuario" id="slctUsuario" data-live-search="true" data-virtual-scroll="false">
              <!-- <option value="">NAN</option> -->
              </select>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Inicio:</label>
                  <input type="text" class="form-control datetimepicker modalForm" id="startDate" name="inicio" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Fin:</label>
                  <input type="text" class="form-control datetimepicker modalForm" id="endDate" name="fin" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Tipo:</label>
                  <select class="form-select modalForm" name="slctTipo" id="slctTipo" required>
                    <option value="-1">Seleccione una opción</option>
                    <option value="0">Horas desarrollo</option>
                    <option value="1">Horas de puesta en servicio</option>
                    <option value="2">Administrativo</option>
                    <option value="3">Servicio</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group body-modalsSinci asignar_a">
                  <label for="recipient-name" class="col-form-label">Asignar_a:</label>
                  <select class="selectpicker form-control" name="slctAsignar" id="slctAsignar" data-live-search="true" data-virtual-scroll="false">
                    <option value="">NAN</option>
                  </select>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">

          <button id="btnSaveEvent" type="button" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>
          <button id="btnDeleteEvent" type="button" class="btn btn-danger btnDeleteNone">Eliminar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- This is a modal confirm -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="mi-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Confirmar</h5>
        <!-- <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        </div>
        <div class="modal-body"><p>Desea continuar con la acción</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modal-btn-si">Sí</button>
          <button type="button" class="btn btn-secondary" id="modal-btn-no">No</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End -->

@endsection

@section('jsSection')

    <!-- <script src='../js/calendar/jquery-ui.custom.min.js' type="text/javascript"></script> -->
  <script src='../js/calendar/fullcalendar.js' type="text/javascript"></script>
  <script src='../js/calendar/mainCalendar.js' type="text/javascript"></script>

  <script>

    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/bitacoras/main"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

  </script>

@endsection
