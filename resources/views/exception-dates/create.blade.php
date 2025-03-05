@extends('layouts.app')

@section('cssSection')
@endsection

@section('pageContent')

<div class="row">
  <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
    <div class="card">
      <!-- <div class="card-header p-3 pt-2">
        Registro de nueva excepción
      </div> -->
      <div class="card-body pb-1">
        <div class="pt-1">
          <div id='wrap'>
            <div id='exceptions'>

              <div class="row mb-2">
                <div class="col-md-4">

                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-s">Fecha Inicio</label>
                    <input type="date" class="form-control datetimepicker" id="initDate" name="inicio" value="{{ date('Y-m-d') }}">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-s">Fecha Fin</label>
                    <input type="date" class="form-control datetimepicker" id="initDate" name="inicio" value="{{ date('Y-m-d') }}">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-s">Tipo Excepción</label>
                    <select name="slctEmployee" id="slctEmployee" class="form-select">
                    </select>
                  </div>

                </div>
              </div>

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-s">Empleado</label>
                    <select name="slctEmployee" id="slctEmployee" class="form-select">
                    </select>
                  </div>

                </div>

                <div class="col-md-8">

                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-s">Descripción</label>
                    <input type="text" class="form-control" id="initDate" name="inicio">
                  </div>

                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
      <div class="card-footer">
        <hr class="mt-0">
        <div class="row">
          <div class="col-md-12 text-end">
            <button class="btn btn--large btn-outline-primary btn-block btn-create-exception mb-0 btn-save-exception" type="button" style="padding: 0.35rem 0.65rem;">Guardar</button>
            <button class="btn btn--large btn-outline-danger btn-block btn-create-exception mb-0 btn-cancelate-exception" type="button" style="padding: 0.35rem 0.65rem;">Cancelar</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/dayjs.min.js" integrity="sha512-FwNWaxyfy2XlEINoSnZh1JQ5TRRtGow0D6XcmAWmYCRgvqOUTnzCxPc9uF35u5ZEpirk1uhlPVA19tflhvnW1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/exceptions/create.js" type="text/javascript"></script>
<script>
  $('.navbar-nav li a').removeClass('bg-gradient-primary');
  $('a[href = "/exception-dates/main"]').addClass('bg-gradient-primary');
</script>
@endsection
