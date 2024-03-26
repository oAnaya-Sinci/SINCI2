@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('pageContent')

<style>

   .card-body{

      width: 100%;
      height: 75vh;
      overflow: auto;
   }

   table thead tr th{
      /* padding: 0.75rem 0 0.75rem 1rem !important; */
      text-align: left;
   }
   
   table tbody tr td{
      font-size: 13px;
      text-align: left;
      /* padding: 0.5rem 0.25rem !important; */
      padding: 0.75rem 1.5rem !important;
   }

   table tbody tr td:last-child .btn{
      margin: 0;
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
</style>

<div class="container-fluid">
   <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">

         <div class="card">
            <div class="card-header p-3 pt-2" style="background-color: #8A1F03;">
               <div class="pt-1">
                  <h5 style="margin: -3px 0 -7px 0;">Historial de encuestas</h5>
               </div>
            </div>

            <div class="card-body pt-3">
               <table id="tableSurveys" class="table table-hover">
                  <thead>
                     <tr>
                        <th class="client">Cliente</th>
                        <th>Proyecto</th>
                        <th>Orden compra</th>
                        <!-- <th>Descripcion</th> -->
                        <th>Correo</th>
                        <th>CC</th>
                        <th>CCO</th>
                        <th>Estatus</th>
                        <th>Fecha crecion</th>
                        <th>Encuesta</th>
                        <!-- <th>Descripcion</th> -->
                        <th>Fecha Contestada</th>
                        <th>Reporte</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($surveys as $survey)
                        <tr>
                           <td>{{ $survey->nombre_cliente }}</td>
                           <td>{{ $survey->codigo_proyecto_cliente }}</td>
                           <td>{{ $survey->orden_compra_cliente }}</td>
                           <!-- <td>{{ $survey->descripcion_proyecto_cliente }}</td> -->
                           <td>{{ $survey->correo_cliente }}</td>
                           <td>{{ $survey->correo_copia }}</td>
                           <td>{{ $survey->correo_copia_oculta }}</td>
                           
                           @if($survey->estatus_encuesta == 1)
                              <td> Creada </td>
                           @else
                              <td> Contestada </td>
                           @endif

                           <td>{{ $survey->survey_created }}</td>
                           <td>{{ $survey->nombre_encuesta }}</td>
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
                  </tbody>
               </table>

            </div>

            <div class="card-footer" style="padding: 1rem;">
               <div class="row">
                  <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2" style="text-align: end;">
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
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Orden Compra</label>
                        <div class="input-group mb-0">
                           <input type="text" id="inputOC" class="form-control" placeholder="Orden compra proyecto">
                           <div class="input-group-append">
                           <button id="searchOC" class="btn btn-outline-primary" type="button">
                              <!-- <button id="searchOC" class="btn btn-outline-secondary" type="button"> -->
                                 Buscar
                                 <!-- <i class='bx bx-search'></i> -->
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" id="clientName" class="form-control" placeholder="Cliente" disabled>
                     </div>
                  </div>

               </div>

               <div class="row">
                  
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="">Codigo Proyecto</label>
                        <input type="text" id="codeProject" class="form-control" placeholder="Codigo" disabled>
                     </div>
                  </div>

                  <div class="col-md-9">
                     <div class="form-group">
                        <label for="">Descripcion</label>
                        <input type="text" id="descriptionProject" class="form-control" placeholder="Descripcion" disabled>
                     </div>
                  </div>

               </div>

               <div class="row mt-2">
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Encuesta</label>
                        <select name="" id="" class="form-select slctCliente">
                           <option value="">Seleccione una opción</option>
                           @foreach($surveysGenerated AS $sg)
                              <option value="{{$sg->id_encuesta}}" selected>{{$sg->nombre_encuesta}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Correo</label>
                        <input type="text" class="form-control" placeholder="Correo">
                     </div>
                  </div>

               </div>

               <div class="row mt-2">
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Correo copia (CC)</label>
                        <input type="text" class="form-control" placeholder="CC">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Correo copia oculta (CCO)</label>
                        <input type="text" class="form-control" placeholder="CCO">
                     </div>
                  </div>

               </div>
                
            </div>
            <div class="modal-footer">
                <button id="btnSaveSurvey" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsSection')

   <script>

      let urlServer = "https://websas.sinci.com:1880";

      document.addEventListener("DOMContentLoaded", async function(event) {
         outLoader();
      });

      document.querySelector('#searchOC').addEventListener('click', async () => {

         let ordenCompra = document.querySelector('#inputOC').value;
         let dataOC = (await fetch(`${urlServer}/obtainDataClient?oc=${ordenCompra}`).then(json => json.json()))[0];

         document.querySelector('#clientName').value = dataOC.RAZON_SOCIAL;
         document.querySelector('#codeProject').value = dataOC.CODIGO;
         document.querySelector('#descriptionProject').value = dataOC.DESCRIPCION;
      });

      document.querySelector('#btnSaveSurvey').addEventListener('click', async () => {

         inLoader();

         let dataSurvey = [];
         document.querySelectorAll('#createNewSurveyModal .modal-body input').forEach( input => { dataSurvey.push(input.value); });
         document.querySelectorAll('#createNewSurveyModal .modal-body select').forEach( select => { dataSurvey.push(select.value); });

         let headers = {
            method: 'POST',
            body: JSON.stringify(dataSurvey),
            headers: {
               "content-type": "application/json; charset=utf-8",
               'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content"),
            }
         };

         await fetch(`/surveys/saveDataSurvey`, headers);

         $('#createNewSurveyModal').modal('hide'); 

         await obtainDataSurvey();
         
         outLoader();
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
            tbody += `<td>${ elem.correo_copia === null ? " - " : elem.correo_copia}</td>`;
            tbody += `<td>${ elem.correo_copia_oculta === null ? " - " : elem.correo_copia_oculta }</td>`;
            tbody += `<td>${ elem.estatus_encuesta === 1 ? "Creada" : "Contestada" }</td>`;
            tbody += `<td>${ elem.survey_created }</td>`;
            tbody += `<td>${ elem.nombre_encuesta }</td>`;
            // tbody += `<td>${ elem.descripcion }</td>`;
            tbody += `<td>${ elem.survey_answered }</td>`;
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
               window.open(`/surveys/generatePDFSurveys?idSurvey=${keyReportPDF}`, '_blank');
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
