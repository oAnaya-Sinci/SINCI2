
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

                    <button id="btnRegistraOrdenCompra" class="btn btn-success">Registrar Orden Compra</button>
                    <button id="btnEditarOrdenCompra" class="btn btn-secondary">Editar Orden Compra</button>

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
                                        <th>Fecha <br> Solicitud</th>
                                        <th>Fecha <br> requerida</th>
                                        <th>Por <br> entregar el</th>
                                        <th>Proyecto</th>
                                        <th>Oficina</th>
                                        <th>Pedido <br> por</th>
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
                                        <th>Orden <br> compra</th>
                                        <th>Proveedor</th>
                                        <th>Fecha <br> orden compra</th>
                                        <th>Por <br> entregar</th>
                                        <th>Moneda</th>
                                        <th>Total</th>
                                        <th>Condicion <br> Pago</th>
                                        <th>Aplica</th>
                                        <th>Prioridad</th>
                                        <th>Oficina</th>
                                        <th>Folio</th>
                                        <th>Código</th>
                                        <th>Solicitado <br> el</th>
                                        <th>Solicitado <br> por</th>
                                        <th>Autorizado <br> por</th>
                                        <th>Autorizado</th>
                                        <th>Orden <br> compra por</th>
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
                                    <div class="col-md-2">
                                        <select name="" id="slctYearOrdenCompra" class="form-select"></select>
                                    </div>
                                </div>

                                <table id="tableOrdenesCompra" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr class="headTable">
                                        <th colspan="12">Orden de compra</th>
                                        <th colspan="8">Datos de la requisición</th>
                                    </tr>
                                    <tr class="headTable">
                                        <th>Proyecto</th>
                                        <th>Recepcion</th>
                                        <th>Orden <br> compra</th>
                                        <th>Fecha <br> orden compra</th>
                                        <th>Fecha <br> cierre</th>
                                        <th>Por <br> entregar el</th>
                                        <th>Moneda</th>
                                        <th>Condiciones <br> pago</th>
                                        <th>Total</th>
                                        <th>Aplica</th>
                                        <th>Prioridad</th>
                                        <th>Oficina</th>
                                        <th>Folio</th>
                                        <th>Solicitado</th>
                                        <th>Solicitado <br> por</th>
                                        <th>Autorizado <br> por</th>
                                        <th>Orden <br> compra por</th>
                                        <th>Autorizado</th>
                                        <th>Requisitado</th>
                                        <th>Se <br> cerro por</th>
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
                                    <th>Fecha <br> de Solicitud</th>
                                    <th>Proyecto</th>
                                    <th>Solictado <br> por</th>
                                    <th>Autorizado <br> por</th>
                                    <th>Orden <br> compra por</th>
                                    <th>Orden <br> compra</th>
                                    <th>Fecha <br> orden compra</th>
                                    <th>Por <br> entregar</th>
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

@include('compras.modals')

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
