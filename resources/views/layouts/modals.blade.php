<div id="createEventCalendar" class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          
          <div class="form-group">
            <label for="message-text" class="col-form-label">Resumen de la bitacora:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>

          <div class="form-group body-bitacora">
            <label for="recipient-name" class="col-form-label">Proyecto:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>

          <div class="form-group body-bitacora">
            <label for="recipient-name" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Inicio:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Fin:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Tipo:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group body-bitacora">
                <label for="recipient-name" class="col-form-label">Asignar a:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>