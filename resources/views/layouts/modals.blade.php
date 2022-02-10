<!-- This modal is to save de event on the calendar -->
<div id="createEventCalendar" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Registro de Evento</h4>
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
            <label for="message-text" class="col-form-label">Resumen de la bitacora:</label>
            <textarea class="form-control" id="message-text" name="resumen" required></textarea>
          </div>

          <div class="form-group body-bitacora">
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

          <div class="form-group body-bitacora">
            <label for="recipient-name" class="col-form-label">Usuario:</label>
            <!-- <input type="text" class="form-control" id="recipient-name" name="usuario"> -->
            <select class="form-select modalForm" name="slctUsuario" id="slctUsuario" required>
            <option value="">NAN</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Inicio:</label>
                <input type="text" class="form-control datetimepicker modalForm" id="startDate" name="inicio" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Fin:</label>
                <input type="text" class="form-control datetimepicker modalForm" id="endDate" name="fin" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group body-bitacora">
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
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Asignar_a:</label>
                <!-- <input type="text" class="form-control" id="recipient-name" name="asignar"> -->
                <!-- <select class="form-select modalForm" name="slctAsignar" id="slctAsignar" required>
                <option value="">NAN</option> -->

                <select class="selectpicker form-control" name="slctAsignar" id="slctAsignar" data-live-search="true" data-virtual-scroll="false">
              <option value="">NAN</option>
            </select>
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
      <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
      <!-- <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button> -->
      </div>
      <div class="modal-body"><p>Desea continuar co la acción</p></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="modal-btn-si">Si</button>
        <button type="button" class="btn btn-secondary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
<!-- End -->

<!-- This modal is to save de event on the calendar -->
<!-- <div id="modalMessageSystem" class="modal modal-alert fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Mensaje del sistema</h4>
        <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="messageToDisplay"></div>
      </div>
      <div class="modal-footer">
        <button id="btnSaveEvent" type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary btnCancelModal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div> -->

<!--  -->

<div class="row" style="display: none;">
    <div class="col-lg-3 col-sm-6 col-12">
        <button class="btn bg-gradient-success w-100 mb-0 toast-btn" type="button" data-target="successToast">Success</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-sm-0 mt-2">
        <button class="btn bg-gradient-info w-100 mb-0 toast-btn" type="button" data-target="infoToast">Info</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
        <button class="btn bg-gradient-warning w-100 mb-0 toast-btn" type="button" data-target="warningToast">Warning</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
        <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" data-target="dangerToast">Danger</button>
    </div>
</div>

<div class="position-fixed top-1 end-1 z-index-1" style="z-index: 1050 !important;">
  <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
      <div class="toast-header border-0 bg-primary">
          <i class="material-icons text-success me-2">
            check
          </i>
          <span class="me-auto font-weight-bold mssgHeader">Material Dashboard</span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
          Hello, world! This is a notification message.
        </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">
              notifications
            </i>
          <span class="me-auto text-white font-weight-bold mssgHeader">Material Dashboard </span>
          <!-- <small class="text-white">11 mins ago</small> -->
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal light m-0">
      <div class="toast-body text-white">
          Hello, world! This is a notification message.
      </div>
  </div>
  <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
      <div class="toast-header border-0">
          <i class="material-icons text-warning me-2">
            travel_explore
          </i>
          <span class="me-auto font-weight-bold mssgHeader">Material Dashboard </span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
          Hello, world! This is a notification message.
      </div>
  </div>
  <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
      <div class="toast-header border-0">
          <i class="material-icons text-danger me-2">
          campaign
          </i>
          <span class="me-auto text-gradient text-danger font-weight-bold mssgHeader">Material Dashboard </span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
          Hello, world! This is a notification message.
      </div>
  </div>
  </div>