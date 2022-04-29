
@extends('layouts.app')

@section('cssSection')

    <!-- <link rel="stylesheet" href="/css/dataTable/dataTable-1.11.5.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/compras/mainCompras.css">

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">

              <div id='wrap'>

                <div class="detallerequisicionOrden">

                    <button id="btnRegistraRequisicion" class="btn btn-success">Registrar Requisición</button>
                    <button id="btnEditarRequisicion" class="btn btn-primary">Editar Requisición</button>
                    <button id="btnVerDetalle" class="btn btn-secondary">Ver detalle</button>
                    <button id="btnAutorizar" class="btn btn-success">Autorizar</button>
                    <button id="btnCancelar" class="btn btn-warning">Cancelar</button>
                    <button id="btnEliminar" class="btn btn-danger">Eliminar</button>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="requisicion-tab" data-bs-toggle="tab" data-bs-target="#requisicion" type="button" role="tab" aria-controls="requisicion" aria-selected="true">Requisiciones</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="requisicionAuth-tab" data-bs-toggle="tab" data-bs-target="#requisicionAuth" type="button" role="tab" aria-controls="requisicionAuth" aria-selected="false">Requisiciones Autorizadas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ordenCompra-tab" data-bs-toggle="tab" data-bs-target="#ordenCompra" type="button" role="tab" aria-controls="ordenCompra" aria-selected="false">Ordenes Compra</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="canceladas-tab" data-bs-toggle="tab" data-bs-target="#canceladas" type="button" role="tab" aria-controls="canceladas" aria-selected="false">Canceladas</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="requisicion" role="tabpanel" aria-labelledby="requisicion-tab">
                            <!-- Table Requisiciones -->
                            <div class="requisiciones tabContents">

                                <table id="tableRequisiciones" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr class="headTable">
                                        <th>Folio</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Fecha requerida</th>
                                        <th>Por entregar el</th>
                                        <th>Proyecto</th>
                                        <th>Oficina</th>
                                        <th>Pedido por</th>
                                        <th>Compañia</th>
                                        <th>Ciudad</th>
                                        <th>Area</th>
                                        <th>Aplica</th>
                                        <th>Prioridad</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <textarea name="" class="form-control textAreaViewer" id="notesRequisicion"></textarea>

                            </div>
                             <!-- END -->
                        </div>

                        <div class="tab-pane fade show" id="requisicionAuth" role="tabpanel" aria-labelledby="requisicion-tab">

                            <!-- Table RequisicionesAuth -->
                            <div class="requisicionesAuth tabContents">

                                <table id="tableRequisicionesAuth" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr class="headTable">
                                        <th colspan="11">Orden de compra</th>
                                        <th colspan="7">Datos de la requisición</th>
                                    </tr>
                                    <tr class="headTable">
                                        <th>Status</th>
                                        <th>Orden compra</th>
                                        <th>Proveedor</th>
                                        <th>Fecha orden compra</th>
                                        <th>Por entregar</th>
                                        <th>Moneda</th>
                                        <th>Total</th>
                                        <th>Condicion Pago</th>
                                        <th>Aplica</th>
                                        <th>Prioridad</th>
                                        <th>Oficina</th>
                                        <th>Folio</th>
                                        <th>Código</th>
                                        <th>Solicitado el</th>
                                        <th>Solicitado por</th>
                                        <th>Autorizado por</th>
                                        <th>Autorizado</th>
                                        <th>Orden compra por</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <div class="row" style="margin-bottom: 1rem;">

                                    <div class="col-md-3">

                                        <select name="" id="slctRequisicionAuth" class="form-select">
                                            <option value="1">Requisición</option>
                                            <option value="2">Orden de compra</option>
                                            <option value="3">Entregar en</option>
                                        </select>

                                    </div>

                                </div>

                                <textarea name="" class="form-control textAreaViewer" id="notesRequisicionAuth"></textarea>

                            </div>
                        </div>
                        <!-- END -->

                        <div class="tab-pane fade show" id="ordenCompra" role="tabpanel" aria-labelledby="requisicion-tab">

                            <!-- Table Ordenes Compra -->
                            <div class="ordenCompra tabContents">

                                <div class="row">

                                    <div class="col-md-3">

                                        <select name="" id="slctYearOrdenCompra" class="form-select"></select>

                                    </div>

                                </div>

                                <table id="tableOrdenesCompra" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr class="headTable">
                                        <th colspan="12">Orden de compra</th>
                                        <th colspan="8">Requisición</th>
                                    </tr>
                                    <tr class="headTable">
                                        <th>Proyecto</th>
                                        <th>Recepcion</th>
                                        <th>Orden compra</th>
                                        <th>Fecha orden compra</th>
                                        <th>Fecha cierre</th>
                                        <th>Por entregar el</th>
                                        <th>Moneda</th>
                                        <th>Condiciones pago</th>
                                        <th>Total</th>
                                        <th>Aplica</th>
                                        <th>Prioridad</th>
                                        <th>Oficina</th>
                                        <th>Folio</th>
                                        <th>Solicitado</th>
                                        <th>Solicitado por</th>
                                        <th>Autorizado por</th>
                                        <th>Orden compra por</th>
                                        <th>Autorizado</th>
                                        <th>Requisitado</th>
                                        <th>Se cerro por</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <div class="row" style="margin-bottom: 1rem;">

                                    <div class="col-md-3">

                                        <select name="" id="slctOrdenCompra" class="form-select">
                                            <option value="1">Requisición</option>
                                            <option value="2">Orden de compra</option>
                                        </select>

                                    </div>

                                </div>

                                <textarea name="" class="form-control textAreaViewer" id="notesOrdenesCompra"></textarea>

                            </div>
                        </div>
                        <!-- END -->

                        <div class="tab-pane fade show" id="canceladas" role="tabpanel" aria-labelledby="requisicion-tab">

                            <!-- Table Canceladas -->
                            <div class="canceladas tabContents">

                                <table id="tableCanceladas" class="table table-bordered align-items-center mb-0">
                                <thead>
                                    <tr class="headTable">
                                    <th>Folio</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Proyecto</th>
                                    <th>Solictado por</th>
                                    <th>Autorizado por</th>
                                    <th>Orden de compra por</th>
                                    <th>Orden de compra</th>
                                    <th>Fecha de orden de compra</th>
                                    <th>Por entregar</th>
                                    <th>Cerrada el</th>
                                    <th>Aplica</th>
                                    <th>Oficina</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END -->

                    <!-- END of tabulation  -->
                    </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- In this space is deployed the modals required to the calendar plugin -->
  <!-- This modal is to save de event on the calendar -->
  <div id="registrarRequisicion" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="registrarrequisicion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Nueva Requisición</h4>
        </div>
        <div class="modal-body">
          <form id="dataRequisiciones">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Fecha_solicitud:*</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="dateRequired" name="dateRequired">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Requerida:*</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="endDate" name="endDate">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Prioridad:</label>
                  <select class="form-select" name="prioridad" id="prioridad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Proyecto:*</label>
                  <select class="selectpicker form-control" id="slctProyecto" data-live-search="true" data-virtual-scroll="false" name="slctProyecto">
                    <option value="">NAN</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="message-text" class="col-form-label">Entregar_en:*</label>
                  <input type="text" id="entregarEn" class="form-control" name="entregarEn">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div id="divUsuarios" class="form-group body-modalsSinci">
                  <label id="lblUsuario" for="recipient-name" class="col-form-label">Solicitado_por:*</label>
                  <select class="selectpicker form-control" id="slctUsuario" data-live-search="true" data-virtual-scroll="false" name="slctUsuario">
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div id="divUsuarios" class="form-group body-modalsSinci">
                  <label id="lblUsuario" for="recipient-name" class="col-form-label">Ciudad:*</label>
                  <select class="selectpicker form-control" id="slctCiudades" data-live-search="true" data-virtual-scroll="false" name="slctCiudades">
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Compañia:*</label>
                  <select class="form-select" id="slctCompannia" data-live-search="true" data-virtual-scroll="false" name="slctCompannia">
                    <option value="">NAN</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group body-modalsSinci asignar_a">
                  <label for="recipient-name" class="col-form-label">Aplica_a:*</label>
                  <select class="selectpicker form-control" id="slctAsignar" data-live-search="true" data-virtual-scroll="false" name="slctAsignar">
                    <option value="">NAN</option>
                  </select>
                </div>
              </div>
            </div>

            <hr>

            <div class="row materialRequired">
              <div class="col-md-12">
                <div class="form-group">
                  <table id="tableMaterials" class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>Cons</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Material</th>
                        <th>Proveedor</th>
                        <th>Marca</th>
                        <th>Catalogo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="materialsRequired">
                        <!-- <td colspan="7" class="addMaterialRow">Haz clic aqui para agregar material</td> -->

                          <td>--</td>
                          <td> <input type='text' class='form-control' id='txtCantidad' value="1" style="text-align: center;"> </td>
                          <td> <select class='form-select' id='slctUnidad'></select> </td>
                          <td> <input type='text' class='form-control' id='txtMaterial'> </td>
                          <td> <select class='form-select' id='slctProveedor'></select> </td>
                          <td> <input type='text' class='form-control' id='txtMarca'> </td>
                          <td> <input type='text' class='form-control' id='txtCatalogo'> </td>
                          <td style="text-align: center; cursor: pointer;">
                          <i class="material-icons opacity-10" id="addMaterial">check</i>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-10">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Notas:</label>
                  <input type="text" class="form-control" id="notasRequisicion" name="notasRequisicion">
                </div>
              </div>

              <div class="col-md-2">
                <button type="button" id="btnNotesCatalog" class="btn btn-primary" style="margin-top: 0.5rem;">Añadir Nota</button>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">

          <button id="btnSaveEvent" type="button" class="btn btn-primary">Guardar</button>
          <button id="btnEditEvent" type="button" class="btn btn-primary displayButton">Editar</button>
          <!-- <button id="btnDeleteEvent" type="button" class="btn btn-danger btnDeleteNone">Guardar y enviar correo</button> --> <!-- Este boton queda pendiente hasta verificar la opcion de guardar y enviar por correo -->
          <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- This is a modal to auth the requisición -->
  <div id="autorizarRequisicion" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="autorizarRequisicion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content" style="height: 31rem !important">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Autorizar requisición de compras</h4>
        </div>
        <div class="modal-body">

            <hr>

            <div class="content__requisicion">
                <div class="row">
                    <div class="col-md-3 folio"></div>
                    <div class="col-md-4 fecha__solicitud"></div>
                    <div class="col-md-4 fecha__requerida"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 proyecto"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 solicitado"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 compannia"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 ciudad"></div>
                </div>
            </div>

            <hr>

            <p style="text-align: right;">Haga clic en "autorizar" y la requisición continuara con el proceso de compras</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-si">Autorizar</button>
          <!-- <button type="button" class="btn btn-primary" id="modal-btn-si">Autorizar y enviar correo</button> -->
          <button type="button" class="btn btn-secondary btnCancelModal" id="modal-btn-no">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This is a modal confirm -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="mi-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
        </div>
        <div class="modal-body"><p>Desea continuar con la acción</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modal-btn-si">Sí</button>
          <button type="button" class="btn btn-secondary" id="modal-btn-no">No</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This is a modal message -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="mi-modal-message">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="modal-btn-cerrar">Salir</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This modal dispaly the notes registered in the DB   -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="modalNotesCatalog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="">Notas del catalogo</h4>
        </div>
        <div class="modal-body">
          <div id="notesDB"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modalAddNote">Añadir</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancelNotes">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This modal dispaly the details of a "orden de compra" registered in the DB   -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="modalDetalleOrden">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="">Detalle de la orden</h4>
        </div>
        <div class="modal-body">
          <div>
            <table id="tableDetailMaterial" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>PDA</th>
                  <th>Cantidad</th>
                  <th>Unidad</th>
                  <th>Material</th>
                  <th>Marca</th>
                  <th>Catalogo</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancelDetalle">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->


  <style>

    .dropdown.bootstrap-select.form-control{

        width: 87% !important;
    }

  </style>

@endsection

@section('jsSection')

    <!-- <script src="../js/dataTable/dataTable-1.11.5.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="../js/compras/dataTablesCompras.js"></script>
    <script src="../js/compras/mainCompras.js"></script>

    <script>

        $('.navbar-nav li a').removeClass('bg-gradient-primary');
        $('a[href = "/compras/main"]').addClass('bg-gradient-primary');

    </script>

@endsection
