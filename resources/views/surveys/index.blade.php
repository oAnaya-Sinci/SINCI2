@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('pageContent')

<style>

   .card-body.surveys{

      width: 100%;
      height: 60vh;
      overflow: auto;
   }

   table thead tr th{
      text-align: left;
      padding: 0.25rem 0.5rem 0.5rem 0.5rem !important;
      vertical-align: middle;
   }

   table thead tr{
      background-color: #8A1F03;
      color: #FFF;
   }

   table thead tr th{

      border-right: solid 1px #FFF !important;
   }

   table tbody tr td{

      /* border: solid 1px #8A1F03 !important; */
   }

   table tbody tr td{
      font-size: 13px;
      text-align: left;
      padding: 0.25rem 0.25rem 0.25rem 0.75rem !important;
   }

   table tbody tr td:last-child{
      text-align: center;
   }

   table tbody tr td:last-child .btn{
      margin: -3px 0 0.25rem 0;
      padding: 0.25rem 1rem;
   }

   table thead tr th.client,
   table tbody tr td.client{
      width: 23px;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
   }

   .modal .modal-body label{
      font-weight: 500;
      font-size: 14px;
   }

   .form-group .input-group input{

      height: fit-content;
   }

   .form-group .input-group .input-group-append .btn{

      border-radius: 0 0.5rem 0.5rem 0;
      /* border-radius: 0; */
   }

   #createNewSurveyModal .modal-content{
      height: auto;
   }

   #createNewSurveyModal .modal-footer .btn{
      margin-bottom: 0;
   }

   .alarmExistSurvey .alert{
      width: 83%;
   }

   .alarmExistSurvey .alert p{
      font-weight: 500;
      color: #fff
   }

   .alarmExistSurvey{
      width: 93%;
      position: fixed;
      z-index: 2;
      transform: translateX(100%);
      transition: transform ease-out 1.5s;
   }
   .showAlarmExistSurvey{
      transform: translateX(0%);
      transition: transform ease-out 0.5s;
   }

   hr{
      color: #FFF;
   }
</style>

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


<div class="container-fluid mb-3">
   <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">

         <div class="card">
            <div class="card-header p-3 pt-2" style="background-color: #8A1F03; padding: 0.5rem 1rem !important;">
               <div class="pt-1">
                  <h5 style="margin: -3px 0 -7px 0;">Historial de encuestas</h5>
               </div>
            </div>

            <div class="card-body pt-3">

                <div class="row">
                    <div class="col-xl-3">
                        <label for="">Status</label>
                        <select name="" id="" class="form-select">
                            <option value="">Seleccione una opción</option>
                            <option value="">elem</option>
                            <option value="">elem</option>
                            <option value="">elem</option>
                        </select>
                    </div>
                    <div class="col-xl-8">
                        <label>Busqueda general</label>
                        <input type="text" name="" id="" class="form-control" placeholder="ingrese el valor que desea filtar en la tabla de resultado">
                    </div>
                    <div class="col-xl-1" style="display: flex; flex-direction: column;">
                            <label style="visibility: hidden;">Buscar</label>
                            <button class="btn btn-primary">Buscar</button>
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
                        <th>Reporte</th>
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
                                 <td><button class="btn btn-primary btn-sm" data-llave="{{$survey->id_llave_encuesta}}">Ver</button></td>
                              @else
                                 <td> - </td>
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
                           <!-- <select name="" id="dataProjects" class="form-select"> -->
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
                        <input type="text" class="form-control" placeholder="Correo">
                     </div>
                  </div>

               </div>

               <div class="row mt-2">

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Correo adicional</label>
                        <input type="text" class="form-control" placeholder="CC">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Correo adicional copia (CC)</label>
                        <input type="text" class="form-control" placeholder="CCO">
                     </div>
                  </div>

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

   <script>

      document.addEventListener("DOMContentLoaded", async function(event) {

         let dataProyecto = await fetch(urlData + "/obtainDataFromProyects?isLogedIn=" + dataLogin()).then(data => data.json()).then(dataProyecto => { return dataProyecto }).catch(() => { IsLogedIn(); });

         let options = "<option value=''>Seleccione un proyecto</option>";
         dataProyecto.forEach(elem => {
            options += `<option value="${elem.VALUE_SELECT}">${elem.OPTION_SELECT}</option>`;
         });

         document.querySelector('#dataProjects').innerHTML = options;
         $('.selectpicker').selectpicker('refresh');

         outLoader();
      });

      document.querySelector('#dataProjects').addEventListener('change', async elem => {

         let idProyecto = elem.srcElement.value;
         let dataOC = (await fetch(`${urlData}/obtainDataClient?idp=${idProyecto}`).then(json => json.json()))[0];

         document.querySelector('#clientName').value = dataOC.RAZON_SOCIAL;
         document.querySelector('#codeProject').value = dataOC.ORDEN_COMPRA;
         document.querySelector('#vendedor').value = dataOC.VENDEDOR;

         document.querySelector('#btnSaveSurvey').removeAttribute('disabled');
      });

      document.querySelector('#btnSaveSurvey').addEventListener('click', async () => {

         inLoader();

         let dataSurvey = [];
         document.querySelectorAll('#createNewSurveyModal .modal-body input:not([type = "search"])').forEach( input => { dataSurvey.push(input.value); });
         document.querySelectorAll('#createNewSurveyModal .modal-body select').forEach( select => { dataSurvey.push(select.value); });

         let headers = {
            method: 'POST',
            body: JSON.stringify(dataSurvey),
            headers: {
               "content-type": "application/json; charset=utf-8",
               'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content"),
            }
         };

         let responseSaveData = await fetch(`/surveys/saveDataSurvey`, headers).then(json => json.json());

         $('#createNewSurveyModal').modal('hide');
         outLoader();

         if(!responseSaveData.response){

            setTimeout(() => {

               document.querySelector('.alarmExistSurvey .alert .message').innerHTML = `<p>${responseSaveData.Message} (${responseSaveData.codigo})</p>`;
               document.querySelector('.alarmExistSurvey').classList.toggle('showAlarmExistSurvey');
            }, 1000);

            setTimeout(() => {
               document.querySelector('.alarmExistSurvey').classList.toggle('showAlarmExistSurvey');
            }, 13000);

         } else {
            await obtainDataSurvey();
         }
      });

      let obtainDataSurvey = async () => {

         let dataSurvey = await fetch(`/surveys/obtainSurveys`).then(json => json.json());

         let table = document.querySelector('#tableSurveys tbody');
         table.querySelector('tr').remove();
         let tbody = "";

         dataSurvey.forEach( elem => {

            tbody += `<tr><td class="client">${ elem.nombre_cliente }</td>`;
            tbody += `<td>${ elem.codigo_proyecto_cliente }</td>`;
            tbody += `<td>${ elem.orden_compra_cliente }</td>`;
            // tbody += `<td class="description">${ elem.descripcion_proyecto_cliente }</td>`;
            tbody += `<td>${ elem.correo_cliente }</td>`;
            // tbody += `<td>${ elem.correo_copia === null ? " - " : elem.correo_copia}</td>`;
            // tbody += `<td>${ elem.correo_copia_oculta === null ? " - " : elem.correo_copia_oculta }</td>`;
            tbody += `<td>${ elem.estatus_encuesta === 1 ? "Creada" : "Contestada" }</td>`;
            tbody += `<td>${ elem.survey_created }</td>`;
            // tbody += `<td>${ elem.nombre_encuesta }</td>`;
            // tbody += `<td>${ elem.descripcion }</td>`;
            tbody += `<td>${ elem.survey_answered === null ? ' - ' : elem.survey_answered }</td>`;
            tbody += `<td>${ elem.id_llave_encuesta === null ? ' - ' : `<button class="btn btn-primary btn-sm" data-llave="${elem.id_llave_encuesta}">Ver</button>` }</td><tr>`;
         });

         table.innerHTML = tbody;

         return true;
      };

      let iniciateButtonPDF = () => {

         document.querySelectorAll('#tableSurveys tbody tr td .btn').forEach(btn => {

            btn.addEventListener('click', async btnClick => {

               let keyReportPDF = btnClick.srcElement.dataset.llave;
               // window.open(`/reportsPDF/${keyReportPDF}.pdf`, '_blank');
               window.open(`/surveys/generatePDFSurveys?idSurvey=${keyReportPDF}&sendEmail=false`, '_blank');
            });
         });
      };

      iniciateButtonPDF();

      document.querySelector('#newSurvey').addEventListener('click', () => {

         document.querySelectorAll('#createNewSurveyModal .modal-body input').forEach( input => { input.value = ""; });
         document.querySelectorAll('#createNewSurveyModal .modal-body select').forEach( select => { select.value = ""; });

         $('#createNewSurveyModal').modal('show');
      });

   </script>

@endsection
