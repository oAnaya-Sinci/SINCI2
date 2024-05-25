@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('cssSection')
    <link rel="stylesheet" href="/css/surveys/main.css">
@endsection

@section('pageContent')

<div class="row justify-content-end alarmExistSurvey">
  <div class="col-12 col-lg-6">
    <div class="alert alert-danger" role="alert">
      <div class="title">
        <h5>Error: No se pudo guardar la encuesta</h5>
      </div>
      <hr>
      <div class="message"></div>
    </div>
  </div>
</div>

<div class="row justify-content-end alarmErrorEmails">
  <div class="col-12 col-lg-6">
    <div class="alert alert-danger" role="alert">
      <div class="title">
        <h5>Detalle en correos</h5>
      </div>
      <hr>
      <div class="message"><p>El formato de los correos ingresados no es correcto, favor de revisarlo antes de continuar</p></div>
    </div>
  </div>
</div>

<div class="container-fluid mb-3">
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">

      <div class="card">
        <div class="card-header p-3 pt-2" style="background-color: #8A1F03; padding: 0.5rem 1rem !important;">
          <div class="pt-1">
            <h5 style="margin: -3px 0 -7px 0;">Historial de encuestas</h5>
          </div>
        </div>

        <div class="card-body pt-3" style="padding: 0.25rem 1rem !important;">

          <div class="row">
            <div class="col-xl-3">
              <label for="" style="margin-bottom: 0 !important; margin-top: 0.5rem !important; font-weight: 500 !important;">Status</label>
              <select name="" id="slctStatus" class="form-select">
                <option value="1">Creada</option>
                <option value="0">Contestada</option>
              </select>
            </div>
            <div class="col-xl-3">
              <label for="" style="margin-bottom: 0 !important; margin-top: 0.5rem !important; font-weight: 500 !important;">Busqueda por fechas</label>
              <div class="form-group" style="display: flex; gap: 1em;">
                <input type="date" name="" id="date_init" class="form-control">
                <input type="date" name="" id="date_end" class="form-control">
              </div>
            </div>
            <!-- <div class="col-xl-4">
                     <label style="margin-bottom: 0 !important; margin-top: 0.5rem !important; font-weight: 500 !important;">Busqueda general</label>
                     <input type="text" name="" id="" class="form-control" placeholder="ingrese el valor que desea filtar en la tabla de resultado">
                  </div> -->
            <div class="col-xl-1" style="display: flex; flex-direction: column;">
              <label style="visibility: hidden;">Buscar</label>
              <button class="btn btn-primary btn-filters">Buscar</button>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">

      <div class="card">
        <div class="card-header p-3 pt-2" style="background-color: #8A1F03; display:none">
          <div class="pt-1">
            <h5 style="margin: -3px 0 -7px 0;">Historial de encuestas</h5>
          </div>
        </div>

        <div class="card-body surveys pt-3" style="padding: 0;">
          <table id="tableSurveys" class="table table-hover table-striped" style="margin-top: -1rem;">
            <thead>
              <tr>
                <th class="client">Cliente</th>
                <th>Proyecto</th>
                <th>Orden compra</th>
                <!-- <th>Descripcion</th> -->
                <th>Correo cliente</th>
                <!-- <th>CC</th> -->
                <!-- <th>CCO</th> -->
                <th>Estatus</th>
                <th>Creada el</th>
                <!-- <th>Encuesta</th> -->
                <!-- <th>Descripcion</th> -->
                <th>Contestada el</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @if($surveys == [])
              <tr></tr>
              @else
              @foreach($surveys as $survey)
              <tr>
                <td>{{ $survey->nombre_cliente }}</td>
                <td>{{ $survey->codigo_proyecto_cliente }}</td>
                <td>{{ $survey->orden_compra_cliente }}</td>
                <!-- <td>{{ $survey->descripcion_proyecto_cliente }}</td> -->
                <td>{{ $survey->correo_cliente }}</td>
                <!-- <td>{{ $survey->correo_copia }}</td> -->
                <!-- <td>{{ $survey->correo_copia_oculta }}</td> -->

                @if($survey->estatus_encuesta == 1)
                <td> Creada </td>
                @else
                <td> Contestada </td>
                @endif

                <td>{{ $survey->survey_created }}</td>
                <!-- <td>{{ $survey->nombre_encuesta }}</td> -->
                <!-- <td>{{ $survey->descripcion }}</td> -->

                @if($survey->survey_answered != null)
                <td>{{ $survey->survey_answered }}</td>
                @else
                <td> - </td>
                @endif

                @if($survey->id_llave_encuesta != null)
                    <td><button class="btn btn-primary btn-sm" data-llave="{{$survey->id_llave_encuesta}}" data-type="pdf">PDF</button></td>
                @else
                    <td><button class="btn btn-primary btn-sm" data-llave="{{$survey->orden_compra_cliente}}" data-type="reenviar">Reenviar</button></td>
                @endif
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>

        </div>

        <div class="card-footer" style="padding: 1rem;">
          <div class="row">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2" style="text-align: end;">
              <hr>
              <button id="newSurvey" class="btn btn-success" style="margin: 0;">Nueva encuesta</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div id="createNewSurveyModal" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="margin-left: 5rem;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de encuesta</h5>
      </div>
      <div class="modal-body">

        <div class="row">

          <!-- <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Orden Compra</label>
                        <div class="input-group mb-0">
                           <input type="text" id="inputOC" class="form-control" placeholder="Orden compra proyecto">
                           <div class="input-group-append">
                           <button id="searchOC" class="btn btn-outline-primary" type="button">
                                 Buscar
                              </button>
                           </div>
                        </div>
                     </div>
                  </div> -->

          <div class="col-md-12">
            <div class="form-group">
              <label for="">Proyecto</label>
              <div class="input-group mb-0">
                <!-- <select name="dataProjects" id="dataProjects" class="form-select"> -->
                <select class="selectpicker form-control" name="dataProjects" id="dataProjects" data-live-search="true" data-virtual-scroll="false">
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-3">
            <div class="form-group">
              <label for="">Orden de compra</label>
              <input type="text" id="codeProject" class="form-control" placeholder="Codigo" disabled>
            </div>
          </div>

          <div class="col-md-9">
            <div class="form-group">
              <label for="">Cliente</label>
              <input type="text" id="clientName" class="form-control" placeholder="Cliente" disabled>
            </div>
          </div>

        </div>

        <div class="row mt-2">

          <div class="col-md-12">
            <div class="form-group">
              <label for="">Vendedor</label>
              <input type="text" id="vendedor" class="form-control" placeholder="Vendedor" disabled>
            </div>
          </div>

        </div>

        <div class="row mt-2">

          <div class="col-md-6">
            <div class="form-group">
              <label for="">Encuesta</label>
              {!! Form::select('', $surveysGenerated, null, ['class' => 'form-select slctCliente', 'id'=>'surveysSlct', 'placeholder' => 'Seleccione una encuesta ...',]) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="">Correo contestar encuesta</label>
              <input type="text" class="form-control emailClient" placeholder="Correo">
            </div>
          </div>

        </div>

        <div class="row mt-2">

          <div class="col-md-6">
            <div class="form-group">
              <label for="">Correo adicional</label>
              <input type="text" class="form-control emailAdditional" placeholder="Additional Email">
            </div>
          </div>

          <!-- <div class="col-md-6">
            <div class="form-group">
              <label for="">Correo adicional copia (CC)</label>
              <input type="text" class="form-control emailCC" placeholder="CC">
            </div>
          </div> -->

        </div>

      </div>
      <div class="modal-footer">
        <button id="btnSaveSurvey" type="button" class="btn btn-primary" disabled>Guardar</button>
        <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('jsSection')
    <script src="/js/surveys/main.js"></script>
@endsection
