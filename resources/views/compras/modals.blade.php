<!-- In this space is deployed the modals required to the calendar plugin -->
  <!-- This modal is to save de event on the calendar -->
  <div id="registrarRequisicion" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="registrarRequisicion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Requisición</h5>
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
                    <option value="2" selected>2</option>
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
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="materialsRequired">
                          <td>--</td>
                          <td> <input type='text' class='form-material' id='txtCantidad' value="1" style="text-align: center;"> </td>
                          <td> <select class='form-select' id='slctUnidad'></select> </td>
                          <td> <input type='text' class='form-material' id='txtMaterial'> </td>
                          <td> <select class='form-select' id='slctProveedor'></select> </td>
                          <td> <input type='text' class='form-material' id='txtMarca'> </td>
                          <td> <input type='text' class='form-material' id='txtCatalogo'> </td>
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
                <!-- <div class="form-group body-modalsSinci"> -->
                  <label for="recipient-name" class="col-form-label">Notas:</label>
                  <input type="text" class="form-control" id="notasRequisicion" name="notasRequisicion" style="line-height: 4rem !important">
                <!-- </div> -->
              </div>

              <div class="col-md-2">
                <button type="button" id="btnNotesCatalog" class="btn btn-primary" style="margin-top: 3rem;">Añadir Nota</button>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">

          <button id="btnSaveEvent" type="button" class="btn btn-primary">Guardar</button>
          <button id="btnEditEvent" type="button" class="btn btn-primary displayButton">Editar</button>
          <!-- <button id="btnDeleteEvent" type="button" class="btn btn-danger btnDeleteNone">Guardar y enviar correo</button> --> <!-- Este boton queda pendiente hasta verificar la opcion de guardar y enviar por correo -->
          <!-- <button type="button" class="btn btn-secondary btnCancelModal" id="btnCerrarModal" data-dismiss="modal">Cancelar</button> -->
          <button type="button" class="btn btn-secondary btnCancelModal" id="btnCerrarModal" data-dismiss="registrarRequisicion">Cancelar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- This is a modal to auth the requisición -->
  <div id="autorizarRequisicion" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="autorizarRequisicion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content" style="height: 31rem !important">
        <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Autorizar requisición de compras</h5>
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

  <!-- This is a modal to see and edit the OC -->
  <div id="modalOrdenCompra" class="modal fade modal-lg modalsSinciClass modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalOrdenCompra" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Orden de Compra</h5>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="modal-btn-si">Crear</button>
          <!-- <button type="button" class="btn btn-primary" id="modal-btn-si">Crear y enviar correo</button> -->
          <button type="button" class="btn btn-secondary btnCancelModal" id="modal-btn-no">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This is a modal confirm -->
  <div class="modal fade modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="mi-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Confirmar</h5>
        </div>
        <div class="modal-body"><p>Desea continuar con la acción</p></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modal-btn-si">Sí</button>
          <button type="button" class="btn btn-secondary btnCancelModal" id="modal-btn-no">No</button>
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
        <h5 class="modal-title" id="myModalLabel"></h5>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="modal-btn-cerrar">Ok</button>
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
        <h5 class="modal-title" id="">Notas del catalogo</h5>
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
        <h5 class="modal-title" id="">Detalle de la orden</h5>
        </div>
        <div class="modal-body">
          <div>

            <!-- <hr>

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

            <hr> -->

            <div class="row">
                <div class="col-md-12 tableDetail">
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
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancelDetalle">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <!-- This modals are requierd for the registration of the requisicion autorized and the ordenes de compra -->
   <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="modalCrearOrdenCompra" style="margin-top: 1rem;">
    <div class="modal-dialog modal-lg" style="max-width: 56rem;">
      <div class="modal-content" style="height: 50rem; margin-top:-1rem;">
        <div class="modal-header">
        <h5 class="modal-title" id="">Crear ordenes de compra</h5>
        </div>
        <div class="modal-body">
          <div>

            <label>Datos de la requisición</label>
            <hr style="margin-top: 0.1rem !important;">

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

                <hr style="margin-top: 0.1rem !important;">

                <div class="row">
                    <div class="col-md-12">
                        <label>Consideraciones especiales</label>
                        <textarea name="" class="form-control textAreaViewer" id="consideracionesEspc" style="height: 7rem;"></textarea>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 1rem;">
                <div class="col-md-12 tableDetailOrden" style="height: 13rem !important;">
                    <table id="tableDetailCrearOrdenCompra" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th>Orden</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Material</th>
                        <th>Proveedor</th>
                        <th>Orden Compra</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>
            </div>
<hr>
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-secondary" id="btnActualizar">Actualizar</button>
                </div>

                <div class="col-md-9" style="text-align: right;">
                    <button type="button" class="btn btn-secondary" id="btnOrdenesAutomaticas">Ordenes automaticas</button>
                    <button type="button" class="btn btn-secondary" id="btnLimpiarOrdenes">Limpiar Ordenes</button>
                </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnCrearOrdenCompra">Crear</button>
          <!-- <button type="button" class="btn btn-primary" id="modal-btn-si">Crear y enviar correo</button> -->
          <button type="button" class="btn btn-secondary btnCancelModal" id="modalCancelarOrdenCompra">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <div class="modal fade modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" id="modalEditarOrdenCompra" style="margin-top: -1rem !important;">
  <!-- <div id="registrarRequisicion" class="modal fade modal-lg modalsSinciClass" tabindex="-1" role="dialog" aria-labelledby="registrarrequisicion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"> -->
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="height: 54rem !important;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Orden de compra</h5>
        </div>
        <div class="modal-body">
          <form id="dataEditOrdenCompra">

            <div class="row">
              <div class="col-md-3">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Orden_compra:</label>
                  <input type="text" class="form-control modalForm" id="idOrdenCompra" name="idOrdenCompra" disabled>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Fecha:</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="dateOrden" name="dateOrden">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Entregar:</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="dateEntregar" name="dateEntregar">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Condiciones:</label>
                  <input type="text" class="form-control modalForm" id="condiciones" name="condiciones">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Moneda:</label>
                  <!-- <input type="text" class="form-control modalForm" id="moneda" name="moneda"> -->
                  <select class="form-select modalForm" id="moneda" name="moneda">
                      <option value="Pesos">Pesos</option>
                      <option value="Dolar">Dollar</option>
                  </select>
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Proveedor:</label>
                  <select class="form-select" name="slctProveedorOrdenCompra" id="slctProveedorOrdenCompra">

                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6" style="margin-top: 1.1rem;">
                <div id="divUsuarios" class="form-group body-modalsSinci">
                  <label id="lblUsuario" for="recipient-name" class="col-form-label">Facturar_a:</label>
                  <!-- <select class="selectpicker form-control" id="slctFacturarA" data-live-search="true" data-virtual-scroll="false" name="slctFacturarA"> -->
                  <input type="text" class="form-control" id="slctFacturarA" name="slctFacturarA">
                  </input>
                </div>

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">RFC:</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="rfc" name="rfc" style="margin: 0.5rem 0 0.25rem 0;">
                </div>

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Domicilio:</label>
                  <input type="text" class="form-control datetimepicker compras modalForm" id="domicilio" name="domicilio" style="margin: 0.25rem 0 0.25rem 0;">
                </div>

              </div>

                <div class="col-md-6">

                    <label id="lblUsuario" for="recipient-name" class="col-form-label">Condiciones especiales:</label>
                    <textarea class="form-control textAreaViewer" name="" id="condicionesE" style="height: 7rem; margin-bottom: 0;" name="condicionesE"></textarea>

                </div>

            </div>

            <hr>

            <div class="row materialRequiredOrdenCompra" style="height: 16rem !important;">
              <div class="col-md-12">
                <div class="form-group" style="height: 16rem !important;">
                  <table id="tableMaterialsEditarOrdenCompra" class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>PDA</th>
                        <th>Cantidad</th>
                        <th>U.M</th>
                        <th>Material</th>
                        <th>Catalogo</th>
                        <th>Precio</th>
                        <th>Importe</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr id="materialsRequiredOrdenCompra">
                          <td class="consecutivoOrden"></td>
                          <td> <input type='text' class='form-material' id='txtCantidadOrden' value="1" style="text-align: center;"> </td>
                          <td> <select class='form-select' id='slctUnidadOrden'></select> </td>
                          <td> <input type='text' class='form-material' id='txtMaterialOrden'> </td>
                          <td> <input type='text' class='form-material' id='txtCatalogoOrden'> </td>
                          <td> <input type='text' class='form-material' id='txtPrecioOrden'> </td>
                          <td class="importeOrden"> </td>
                          <td style="text-align: center; cursor: pointer;">
                            <i class="material-icons opacity-10" id="addMaterialOrdenCompra">check</i>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group body-modalsSinci">
                  <!-- <label for="recipient-name" class="col-form-label">Notas:</label> -->
                  <input type="text" class="form-control" id="notaOrdenCompra" name="notaOrdenCompra" style="line-height: 7.5rem !important;">
                </div>
              </div>

              <div class="col-md-2">
                <button type="button" id="btnNotesCatalog" class="btn btn-primary" style="margin-top: 3rem;">Añadir <br> Nota</button>
              </div>

              <div class="col-md-2" style="text-align: center;">
                <button type="button" id="btnCalculateOrdenCompra" class="btn btn-primary" style="margin-top: 3.5rem;">Calcular</button>
              </div>

              <div class="col-md-3">

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Descuento:</label>
                  <input type="text" class="form-control numericTextAlign" id="descuentoPorcentaje" name="descuentoPorcentaje" style="margin-right: .5rem;" value="0" placeholder="0.00%">
                  <input type="text" class="form-control numericTextAlign" id="descuentoTotal" name="descuentoTotal" value="0" placeholder="0.00">
                </div>

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Importe:</label>
                  <input type="text" class="form-control numericTextAlign" id="importe" name="importe" value="0"  placeholder="0.00">
                </div>

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">IVA:</label>
                  <input type="text" class="form-control numericTextAlign" id="iva" name="iva" value="0"  placeholder="0.00">
                </div>

                <div class="form-group body-modalsSinci">
                  <label for="recipient-name" class="col-form-label">Total:</label>
                  <input type="text" class="form-control numericTextAlign" id="total" name="total" value="0"  placeholder="0.00">
                </div>

              </div>

            </div>

          </form>
        </div>
        <div class="modal-footer" style="display: block;">

            <div class="row">

                <div class="col-md-6" style="margin-top: -0.5rem;">
                    <div class="form-group body-modalsSinci">
                        <label for="recipient-name" class="col-form-label" style="margin-top: -0.2rem;">Status:</label>
                        <!-- <input type="text" class="form-control modalForm" id="statusOrden" name="statusOrden" style="font-size: .7rem; line-height: .8rem; width: 45%; height: 100%;"> -->
                        <select class="form-select modalForm" id="statusOrden" name="statusOrden" style="font-size: .7rem; line-height: .8rem; width: 45%; height: 100%;"></select>
                    </div>
                </div>

                <div class="col-md-6" style="text-align: end;">
                    <button id="btnActualizarOrdenCompra" type="button" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-secondary btnCancelModal" id="btnCerrarModalOrdenCompra" data-dismiss="modal">Cancelar</button>
                </div>

            </div>

        </div>
      </div>
    </div>
  </div>
  <!-- END -->
