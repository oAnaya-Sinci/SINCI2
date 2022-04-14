
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

                <!-- Table Requisiciones -->
                <div class="requisiciones">
                  <!-- <button id="btnRequisiciones" type="button" class="btn btn-primary">Obtener datos tabla</button> -->
                  <h6>Requisiciónes</h6>
                  <table id="tableRequisiciones" class="table align-items-center mb-0">
                    <thead>
                      <tr>
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
                  <hr>
                </div>
                <!-- END -->

                <!-- Table RequisicionesAuth -->
                <div class="requisicionesAuth">
                  <!-- <button id="btnRequisicionesAuth" type="button" class="btn btn-primary">Obtener datos tabla</button> -->
                  <h6>Requisiciónes Autorizadas</h6>
                  <table id="tableRequisicionesAuth" class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th colspan="11">Orden de compra</th>
                        <th colspan="7">Datos de la requisición</th>
                      </tr>
                      <tr>
                        <th>Stataus</th>
                        <th>Orden de compra</th>
                        <th>Proveedor</th>
                        <th>Fecha de orden de compra</th>
                        <th>Por entregar</th>
                        <th>Moneda</th>
                        <th>Total</th>
                        <th>Condiciones de Pago</th>
                        <th>Aplica</th>
                        <th>Prioridad</th>
                        <th>Oficina</th>
                        <th>Folio requisición</th>
                        <th>Código</th>
                        <th>Solicitado el</th>
                        <th>Solicitado por</th>
                        <th>Autorizado por</th>
                        <th>Autorizado</th>
                        <th>Orden de compra por</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>

                  <select name="" id="slctRequisicionAuth" class="form-select">
                      <option value="1">Requisición</option>
                      <option value="2">Orden de compra</option>
                      <option value="3">Entregar en</option>
                  </select>
                  <textarea name="" class="form-control textAreaViewer" id="notesRequisicionAuth"></textarea>
                  <hr>
                </div>
                <!-- END -->

                <!-- Table Ordenes Compra -->
                <div class="ordenCompra">
                  <!-- <button id="btnOrdenesCompra" type="button" class="btn btn-primary">Obtener datos tabla</button> -->
                  <h6>Ordenes de compra</h6>
                  <select name="" id="slctYearOrdenCompra" class="form-select">

                  </select>
                  <table id="tableOrdenesCompra" class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th colspan="12">Orden de compra</th>
                        <th colspan="8">Requisición</th>
                      </tr>
                      <tr>
                        <th>Proyecto</th>
                        <th>Recepcion</th>
                        <th>Orden de compra</th>
                        <th>Fecha de la orden de compra</th>
                        <th>Fecha de cierre</th>
                        <th>Por entregar el</th>
                        <th>Moneda</th>
                        <th>Condiciones de pago</th>
                        <th>Total</th>
                        <th>Aplica</th>
                        <th>Prioridad</th>
                        <th>Oficina</th>
                        <th>Folio</th>
                        <th>Solicitado</th>
                        <th>Solicitado por</th>
                        <th>Autorizado por</th>
                        <th>Orden de compra por</th>
                        <th>Autorizado</th>
                        <th>Requisitado</th>
                        <th>Se cerro por</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>

                  <select name="" id="slctOrdenCompra" class="form-select">
                      <option value="1">Requisición</option>
                      <option value="2">Orden de compra</option>
                  </select>
                  <textarea name="" class="form-control textAreaViewer" id="notesOrdenesCompra"></textarea>
                  <hr>
                </div>
                <!-- END -->

                <!-- Table Canceladas -->
                  <div class="canceladas">
                    <!-- <button id="btnOrdenesCanceladas" type="button" class="btn btn-primary">Obtener datos tabla</button> -->
                    <h6>Canceladas</h6>
                    <table id="tableCanceladas" class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th>Requisición</th>
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
                    <hr>
                  </div>
                <!-- END -->

                <div class="detallerequisicionOrden">

                  <button id="btnVerDetalle" class="btn btn-primary">Ver detalle</button>

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
                  <select class="form-select" name="prioridad">
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
          <button id="btnDeleteEvent" type="button" class="btn btn-danger btnDeleteNone">Guardar y enviar correo</button>
          <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>

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

@endsection

@section('jsSection')

    <!-- <script src="../js/dataTable/dataTable-1.11.5.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="../js/compras/mainCompras.js"></script>
    <script src="../js/compras/dataTablesCompras.js"></script>

    <script>

        $('.navbar-nav li a').removeClass('bg-gradient-primary');
        $('a[href = "/compras/main"]').addClass('bg-gradient-primary');

    </script>

@endsection
