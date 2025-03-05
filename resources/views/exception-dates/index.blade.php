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

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="Tipo Excepción" class="col-form-label text-s">Tipo de excepción</label>
                    <select name="slctTipo" id="slctTipo" class="form-select">
                      <option value="-1">Seleccione una opción</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="Tipo Excepción" class="col-form-label text-s">Busqueda General</label>
                    <input type="text" name="genericSearch" id="genereicSearch" class="form-control"/>
                  </div>
                </div>

                <div class="col-md-6 mt-5 text-end">
                  <button class="btn btn--large btn-outline-primary btn-block btn-create-exception mb-0" type="button" style="padding: 0.35rem 0.65rem;">Nueva Excepción</button>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1"><span class="fecha"> Fecha Inicio </span></th>
                          <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1"><span class="noti_email"> Fecha Fin </span></th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7"><span class="noti_email"> Total días </span></th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7"><span class="noti_telegram">tipo excepción </span></th>
                          <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1"><span class="noti_telegram">Descripción </span></th>
                          <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-1"><span class="admin">Empleado</span></th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7"><span class="admin">Acciones</span></th>
                        </tr>
                      </thead>
                      <tbody style="text-align: center;">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/dayjs.min.js" integrity="sha512-FwNWaxyfy2XlEINoSnZh1JQ5TRRtGow0D6XcmAWmYCRgvqOUTnzCxPc9uF35u5ZEpirk1uhlPVA19tflhvnW1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/exceptions/main.js" type="text/javascript"></script>
<script>
  $('.navbar-nav li a').removeClass('bg-gradient-primary');
  $('a[href = "/exception-dates/main"]').addClass('bg-gradient-primary');

  document.querySelector('.btn-create-exception').addEventListener('click', function() {
    window.location.href = '/exception-dates/create';
  });
</script>
@endsection
