<!-- This modal is to save de event on the calendar -->
<div id="createEventCalendar" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Registro de Evento</h4>
        <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="dataEvent">
          
          <span class="invalidRequired hidden">
            <strong>Faltan elementos para guardar el registro</strong>
          </span>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Resumen de la bitacora:</label>
            <textarea class="form-control" id="message-text" name="resumen" required></textarea>
          </div>

          <div class="form-group body-bitacora">
            <label for="recipient-name" class="col-form-label">Proyecto:</label>
            <!-- <input type="text" class="form-control" id="recipient-name" name="proyecto"> -->
            <select class="form-select modalForm" name="slctProyecto" id="slctProyecto" required>
              <option value="">NAN</option>
            </select>
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
                  <!-- <option value="-1">Seleccione opcion</option> -->
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
                <select class="form-select modalForm" name="slctAsignar" id="slctAsignar" required>
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
      </div>
    </div>
  </div>
</div>

<!-- This modal is to save de event on the calendar -->
<div id="modalMessageSystem" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
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
</div>