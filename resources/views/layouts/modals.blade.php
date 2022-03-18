
  <!-- This Modal show at the users with the account disabbled that they are not availabel to login -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="noAccessModal">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
          </div>
          <div class="modal-body">
              <p>Su cuenta se encuentra desactivada.</p>
              <p>Para cualquier aclaración por favor contacte con el administrador del sistema o con su jefe inmediato.</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="modal-btn-no">Cerrar</button>
          </div>
          </div>
      </div>
  </div>

<!-- All thos block of code is for the notification modals  -->

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
  <div class="toast fade hide p-2 bg-gradient-success" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
      <div class="toast-header border-0 bg-transparent">
          <i class="material-icons text-success text-white me-2">
            check
          </i>
          <span class="me-auto font-weight-bold mssgHeader text-white">Material Dashboard</span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal light m-0">
      <div class="toast-body text-white">
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
  <div class="toast fade hide p-2 mt-2 bg-gradient-warning" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
      <div class="toast-header border-0 bg-transparent">
          <i class="material-icons text-warning me-2 text-white">
            travel_explore
          </i>
          <span class="me-auto font-weight-bold mssgHeader text-white">Material Dashboard </span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal light m-0">
      <div class="toast-body text-white">
          Hello, world! This is a notification message.
      </div>
  </div>
  <div class="toast fade hide p-2 mt-2 bg-gradient-danger" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
      <div class="toast-header border-0 bg-transparent">
          <i class="material-icons text-danger me-2 text-white">
          campaign
          </i>
          <span class="me-auto font-weight-bold mssgHeader text-white">Material Dashboard </span>
          <!-- <small class="text-body">11 mins ago</small> -->
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal light m-0">
      <div class="toast-body text-white">
          Hello, world! This is a notification message.
      </div>
  </div>
  </div>