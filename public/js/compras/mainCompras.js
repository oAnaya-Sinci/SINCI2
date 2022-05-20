$(document).ready(function() {

    $('.datetimepicker.compras').datetimepicker({
        // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
        format: 'YYYY-MM-DD',

        // Your Icons
        // as Bootstrap 4 is not using Glyphicons anymore
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },
    });

    $('.datetimepicker').datetimepicker({
        // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
        format: 'YYYY-MM-DD HH:mm',

        // Your Icons
        // as Bootstrap 4 is not using Glyphicons anymore
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },
    });

    // let date = new Date();
    // let today = date.getFullYear() + "-" + (date.getMonth() < 9 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1) + "-" + (date.getDate() < 10 ? "0" + (date.getDate()) : date.getDate());
    let today = moment().format('YYYY-MM-DD');
    $('#dateRequired').val(today);

    selectYears(15);

    iniciateTablesDT();
    modalComprasSinci();

    // $('#modalEditarOrdenCompra').modal('show');
});

$('#btnCerrarModal').click(function() {

    $('#registrarRequisicion').modal('hide');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-27 14:07:32
 * @Desc:
 */

$('#mi-modal-message #modal-btn-cerrar').click(function() {

    $('#mi-modal-message').modal('hide');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-25 10:22:45
 * @Desc:
 */

$('#btnRegistraRequisicion').click(function() {

    $('#registrarRequisicion').modal('show');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 16:35:57
 * @Desc:
 */

let selectYears = (totYears) => {

    let year = moment().format("YYYY");
    let options = "";

    for (let i = 0; i <= totYears; ++i)
        options += "<option value='" + (year - i) + "'>" + (year - i) + "</option>"

    options += "<option value='all'>Todos</option>"

    $('#slctYearOrdenCompra').append(options);

    $('#slctYearOrdenCompra').change(function() {

        $('#tableOrdenesCompra').DataTable().ajax.reload();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-21 15:42:55
 * @Desc: This function iniciate the select in the sales apart
 */

async function modalComprasSinci() {

    let dl = dataLogin();

    console.time("Selects In Modal");

    await fetch(urlData + "/obtainDataProyecto?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctProyecto'); }).catch(() => { IsLogedIn(); });
    await fetch(urlData + "/obtainDataUser?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctUsuario'); }).catch(() => { IsLogedIn(); });
    await fetch(urlData + "/obtainDataAsignar?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctAsignar'); }).catch(() => { IsLogedIn(); });
    await fetch(urlData + "/obtainDataCiudades?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctCiudades'); }).catch(() => { IsLogedIn(); });
    await fetch(urlData + "/obtainDataCompannia?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctCompannia'); }).catch(() => { IsLogedIn(); });

    await fetch(urlData + "/obtainDataProveedores?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => {
        processDataToSelect(dataAsignar, '#slctProveedor', 'Sin proveedor');
        processDataToSelect(dataAsignar, '#slctProveedorOrdenCompra', 'Sin proveedor');
    }).catch(() => { IsLogedIn(); });

    await fetch(urlData + "/obtainDataUnidadesMedida?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctUnidad', "-"); }).catch(() => { IsLogedIn(); });
    await fetch(urlData + "/obtainDataNotesCatalog?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToModalNotes(dataAsignar); }).catch(() => { IsLogedIn(); });

    $('.selectpicker').selectpicker('refresh');

    console.timeEnd("Selects In Modal");

    outLoader();

    return true;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 15:56:28
 * @Desc: This funcion display the data obtainded from the DB in the SELECT of the page
 */

function processDataToSelect(data, select, firstOption = "") {

    let options = "";

    if (data.length == 1) {
        $('#slctUsuario').remove();
        let select = '<label id="lblUsuario" for="recipient-name" class="col-form-label">Usuario:</label> <select class="form-select" name="slctUsuario" id="slctUsuario">';
        $('#divUsuarios').html(select);
    }

    $(select).empty();

    if (firstOption == "")
        data.length > 1 ? options = "<option value=''>Seleccione una opción</option>" : null;

    else
        options = "<option value=''>" + firstOption + "</option>";

    $.each(data, function(index, value) {

        options += '<option value="' + value.VALUE_SELECT + '">' + value.OPTION_SELECT + '</option>';
    });

    $(select).append(options);
}

let displayDetailsDataModal = (dataDetails) => {

    // let folio = "<strong>Folio: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.folio').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .folio").html(folio);

    // let proyecto = "<strong>Proyecto: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.proyetoReqs').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .proyecto").html(proyecto);

    // let fechaSolicitud = "<strong>Fecha Solicitud: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.fechaSolicitud').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .fecha__solicitud").html(fechaSolicitud);

    // let fechaRequerida = "<strong>Fecha requerida: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.fechaRequerida').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .fecha__requerida").html(fechaRequerida);

    // let solcitado = "<strong>Solicitdo por: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.solicitado').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .solicitado").html(solcitado);

    // let compannia = "<strong>Compañia: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.compania').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .compannia").html(compannia);

    // let ciudad = "<strong>Ciudad: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.ciudad').text();
    // $("#modalDetalleOrden .modal-body .content__requisicion .ciudad").html(ciudad);

    $('#tableDetailMaterial tbody').empty();

    dataDetails = JSON.parse(dataDetails);

    let rows = "";
    $.each(dataDetails, function(index, value) {

        rows += "<tr>" +
            "<td></td>" +
            "<td>" + value.CANTIDAD + "</td>" +
            "<td>" + value.UNIDAD + "</td>" +
            "<td>" + value.MATERIAL + "</td>" +
            "<td>" + value.MARCA + "</td>" +
            "<td>" + value.CATALOGO + "</td>" +
            "</tr>";
    })

    $('#tableDetailMaterial tbody').append(rows);

    $('#modalDetalleOrden').modal('show');
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 16:08:10
 * @Desc: This events call and cancel the modal with the catalog of noted fro the DB
 */

$('#btnCancelDetalle').click(function() {
    $('#modalDetalleOrden').modal('hide');
});

$('#btnCancelNotes').click(function() {
    $('#modalNotesCatalog').modal('hide');
});

$('#btnNotesCatalog').click(function() {

    $('#modalNotesCatalog').modal('show');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 16:34:56
 * @Desc: This function add the notes from the Db to thie modal
 */

let processDataToModalNotes = (dataNotes) => {

    let notesDB = "";
    $.each(dataNotes, function(index, value) {

        notesDB += "<p class='noteCatalog'>" + value.OPTION_SELECT + "</p><hr>";
    });

    $('#modalNotesCatalog .modal-body #notesDB').append(notesDB);

    $('#modalNotesCatalog .modal-body #notesDB .noteCatalog').click(function() {

        $('#notesDB .noteCatalog').removeClass('active');
        $(this).addClass('active');
    });
}

$('#modalAddNote').click(function() {

    let note = $('#modalNotesCatalog .modal-body #notesDB .noteCatalog.active').text();

    $('#notasRequisicion').val(note);

    $('#modalNotesCatalog').modal('hide');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 15:57:23
 * @Desc: this event display the info registerd for the user in the materials required and added to the table
 */
$('#addMaterial').click(function() {

    let cantidad = $('#txtCantidad').val();
    // let unidadId = $('#slctUnidad').val();
    let unidad = $('#slctUnidad option:selected').text();
    let material = $('#txtMaterial').val();
    let proveedorId = $('#slctProveedor').val();
    let proveedor = $('#slctProveedor option:selected').text();
    let marca = $('#txtMarca').val();
    let catalogo = $('#txtCatalogo').val();

    let consecutivo = $('#tableMaterials tbody tr').length;

    let newRowMaterial = "<tr>" +
        "<td class='consecutivo' data-mtrlvalue='" + consecutivo + "'>" + consecutivo + "</td>" +
        "<td class='cantidad' data-mtrlvalue='" + cantidad + "'>" + cantidad + "</td>" +
        "<td class='unidad' data-mtrlvalue='" + unidad + "'>" + unidad + "</td>" +
        "<td class='material' data-mtrlvalue='" + material + "'>" + material + "</td>" +
        "<td class='proveedor' data-mtrlvalue='" + proveedorId + "'>" + proveedor + "</td>" +
        "<td class='marca' data-mtrlvalue='" + marca + "'>" + marca + "</td>" +
        "<td class='catalogo' data-mtrlvalue='" + catalogo + "'>" + catalogo + "</td>" +
        "<td> <i class='material-icons opacity-10' class='removeMaterial'>clear</i> " +
        "<i class='material-icons opacity-10' class='editMaterial'>drive_file_rename_outline</i> </td>" +
        "</tr>";

    // $('#materialsRequired').before(newRowMaterial);
    $('#materialsRequired').after(newRowMaterial);

    iniciateEditMaterial();
    iniciateRemovematerials();
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 15:56:10
 * @Desc: Funciones necesarios para editar el apartado de requiciones
 */

let showDataCompra = (dataCompra, datDetalleCompra) => {

    cleanModalrequisicion();

    $('#dateRequired').val(moment(dataCompra[0].FECHA_SOLICITUD).format('YYYY-MM-DD'));
    $('#endDate').val(moment(dataCompra[0].FECHA_REQUISICION).format('YYYY-MM-DD'));
    $('#prioridad').val(dataCompra[0].Prioridad);
    $('#slctProyecto').val(dataCompra[0].ID_PROYECTO);
    $('#entregarEn').val(dataCompra[0].ENTREGAR_EN);
    $('#slctUsuario').val(dataCompra[0].ID_USUARIO);
    $('#slctCiudades').val(dataCompra[0].CIUDAD);
    $('#slctCompannia').val(dataCompra[0].COMPANIA);
    $('#slctAsignar').val(dataCompra[0].APLICA);
    $('#notasRequisicion').val(dataCompra[0].NOTAS_REQUISICION);

    $('.selectpicker').selectpicker('refresh');

    let RowsMaterial = "";
    datDetalleCompra.forEach(function(valor, indice) {

        RowsMaterial += "<tr>" +
            "<td class='consecutivo' data-mtrlvalue='" + valor.CONSECUTIVO + "'>" + valor.CONSECUTIVO + "</td>" +
            "<td class='cantidad' data-mtrlvalue='" + valor.CANTIDAD + "'>" + valor.CANTIDAD + "</td>" +
            "<td class='unidad' data-mtrlvalue='" + valor.UNIDAD + "'>" + valor.UNIDAD + "</td>" +
            "<td class='material' data-mtrlvalue='" + valor.MATERIAL + "'>" + valor.MATERIAL + "</td>" +
            "<td class='proveedor' data-mtrlvalue='" + valor.ID_PROVEEDOR + "'>" + valor.PROVEEDOR + "</td>" +
            "<td class='marca' data-mtrlvalue='" + valor.MARCA + "'>" + valor.MARCA + "</td>" +
            "<td class='catalogo' data-mtrlvalue='" + valor.CATALOGO + "'>" + valor.CATALOGO + "</td>" +
            "<td> <i class='material-icons opacity-10' class='removeMaterial'>clear</i> " +
            "<i class='material-icons opacity-10' class='editMaterial'>drive_file_rename_outline</i> </td>" +
            "</tr>";
    });

    $('#materialsRequired').after(RowsMaterial);

    iniciateEditMaterial();
    iniciateRemovematerials();

    $('#registrarRequisicion').modal('show');

    return true;
}

let cleanModalrequisicion = () => {

    $('#dateRequired').val(moment().format('YYYY-MM-DD'));
    $('#endDate').val(moment().format('YYYY-MM-DD'));
    $('#prioridad').val(1);
    $('#slctProyecto').val('');
    $('#entregarEn').val('');
    $('#slctUsuario').val('');
    $('#slctCiudades').val('');
    $('#slctCompannia').val('');
    $('#slctAsignar').val('');
    $('#notasRequisicion').val('');

    $('.selectpicker').selectpicker('refresh');

    $('#tableMaterials tbody tr .removeMaterial').each(function() {
        $(this).click();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 15:58:27
 * @Desc: This function enable the function to remove the materials registered in the table
 */
let iniciateRemovematerials = () => {

    $('#txtCantidad').val(1);
    $('#slctUnidad').val("");
    $('#txtMaterial').val("");
    $('#slctProveedor').val("");
    $('#txtMarca').val("");
    $('#txtCatalogo').val("");

    $('#tableMaterials tbody tr .removeMaterial').each(function() {
        $(this).click(function() {
            $(this).parent().parent().remove();
            // iniciateRemovematerials();
        });
    });
}

let iniciateEditMaterial = () => {

    $('#tableMaterials tbody tr .editMaterial').each(function() {
        $(this).click(function() {

            let rowData = $(this).parent().parent().find('td');
            let dataContainer = [];

            rowData.each(function(index, value) {
                // dataContainer.push($(this).data('mtrlvalue'));
                dataContainer.push($(this).attr('mtrlvalue'));
            });

            $('#consecutivo').val(dataContainer[0]);
            $('#txtCantidad').val(dataContainer[1]);
            $('#slctUnidad').val(dataContainer[2]);
            $('#txtMaterial').val(dataContainer[3]);
            $('#slctProveedor').val(dataContainer[4]);
            $('#txtMarca').val(dataContainer[5]);
            $('#txtCatalogo').val(dataContainer[6]);

            $(this).parent().parent().remove();
            // iniciateEditMaterial();
            // iniciateRemovematerials();
        });
    });
}


/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-23 11:03:17
 * @Desc:
 */
$('#btnSaveEvent').click(function() {

    obtainDataMaterials(false);
});

$('#btnEditEvent').click(function() {

    obtainDataMaterials(true);
})

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 17:28:11
 * @Desc:
 */

let obtainDataMaterials = async(update) => {

    let requisicionData = $('#dataRequisiciones').serializeArray();

    let dataTable = [];
    let dataRow = [];
    let totTd = 1;
    let firstRow = 1;

    $('#tableMaterials tbody tr').each(function(index, tr) {

        if (firstRow != 1) {

            $(tr).find('td').each(function(index, td) {

                if (totTd < 8) {

                    // dataRow.push($(this).data('mtrlvalue'));
                    dataRow.push($(this).attr('mtrlvalue'));
                } else {

                    dataTable.push(dataRow);
                    dataRow = [];
                    totTd = 0;
                }

                totTd++;
            });
        }

        firstRow++;
    });

    let dl = dataLogin();
    let tipoFolio = "FOLIO_REQUISICION";

    requisicionData.push({
        "name": `folio`,
        "value": await fetch(urlData + "/obtainFolios?isLogedIn=" + dl + "&tipoFolio=" + tipoFolio).then(data => data.json()).then(folio => { return folio.data[0].TIPO_FOLIO }).catch(() => { IsLogedIn(); })
    });

    requisicionData.push({ "name": `Materials`, "value": JSON.stringify(dataTable) });

    registroRequisicion(requisicionData, update);
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 17:28:15
 * @Desc:
 */
let registroRequisicion = (requisicionData, update) => {

    console.log(requisicionData);

    let url, type, folio = null;

    if (update) {

        type = "PUT";
        url = "/updateDataRequisicion";
        folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    } else {

        type = "POST";
        url = "/saveDataRequisicion"
    }

    $.ajax({
        type: type,
        url: urlData + url,
        data: { isLogedIn: dataLogin(), data: requisicionData, folio: folio },
        beforeSend: function() {

            inLoader();
        },
        success: function(response) {

            $('#tableRequisiciones').DataTable().ajax.reload();
            // $('#tableRequisicionesAuth').DataTable().ajax.reload();
            // $('#tableOrdenesCompra').DataTable().ajax.reload();
            // $('#tableCanceladas').DataTable().ajax.reload();

            $('#registrarRequisicion').modal('hide');

            outLoader();
        },
        error: function(exception) {

            outLoader();
            showMessage('danger', 'Error', exception.messageText());
        }

    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 17:18:59
 * @Desc:
 */

$('.btnCancelModal').click(function() {

    cleanModalrequisicion();

    $('#btnSaveEvent').removeClass('displayButton');
    $('#btnEditEvent').addClass('displayButton');
});

/**
 * javascript comment
 * @Author: flydreame
 * @Date: 2022-03-24 12:06:26
 * @Desc: This event show the details of a row selected from a table
 */

$('#btnVerDetalle').click(async() => {

    let dl = dataLogin();
    let idCompra;

    try {

        idCompra = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    } catch (error) {

        $("#mi-modal-message .modal-header h4").text("Mensaje:");
        $("#mi-modal-message .modal-body").html("<p>primero se debe de elegir una fila de la tabla para mostrar el detalle</p>");
        $("#mi-modal-message").modal('show');

        return false;
    }

    await $.ajax({
        type: "GET",
        url: urlData + "/obtainDataDetalleRequisicionOrden",
        data: { "isLogedIn": dl, "idCompra": idCompra },
        success: function(response) {

            displayDetailsDataModal(response);
        },
        error: function(exception) {

            console.error(exception);
            showMessage('danger', 'Error', exception.showMessage());
        }
    });

});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-29 12:37:57
 * @Desc:
 */

$('#btnAutorizar').click(function() {

    let folio = "<strong>Folio: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.folio').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .folio").html(folio);

    let proyecto = "<strong>Proyecto: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.proyetoReqs').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .proyecto").html(proyecto);

    let fechaSolicitud = "<strong>Fecha Solicitud: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.fechaSolicitud').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .fecha__solicitud").html(fechaSolicitud);

    let fechaRequerida = "<strong>Fecha requerida: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.fechaRequerida').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .fecha__requerida").html(fechaRequerida);

    let solcitado = "<strong>Solicitdo por: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.solicitado').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .solicitado").html(solcitado);

    let compannia = "<strong>Compañia: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.compania').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .compannia").html(compannia);

    let ciudad = "<strong>Ciudad: </strong>" + $('#tableRequisiciones tbody tr.rowSelected td.ciudad').text();
    $("#autorizarRequisicion .modal-body .content__requisicion .ciudad").html(ciudad);

    $('#autorizarRequisicion').modal('show');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 13:52:05
 * @Desc:
 */
$('#btnEditarRequisicion').click(async() => {

    $('#btnSaveEvent').addClass('displayButton');
    $('#btnEditEvent').removeClass('displayButton');

    let dl = dataLogin();
    let folio;
    // let folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;

    try {
        folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    } catch (error) {

        $("#mi-modal-message .modal-header h4").text("Mensaje:");
        $("#mi-modal-message .modal-body").html("<p>primero se debe de elegir una fila de la tabla para modificar el registro</p>");
        $("#mi-modal-message").modal('show');

        return false;
    }

    await $.ajax({
        type: "GET",
        url: urlData + "/editDataRequisicion",
        data: { "isLogedIn": dl, "folio": folio },
        beforeSend: function() {

            inLoader();
        },
        success: function(response) {

            let dataCompra = JSON.parse(response).compra;
            let datDetalleCompra = JSON.parse(response).detalleCompra;

            showDataCompra(dataCompra, datDetalleCompra);

            outLoader();
        },
        error: function(exception) {

            console.error(exception);
            showMessage('danger', 'Error', exception.showMessage());
        }
    });

});


/**
 * javascript comment
 * @Author: flydreame
 * @Date: 2022-03-24 12:06:26
 * @Desc: This event show the details of a row selected from a table
 */

$('#btnCancelar').click(() => {

    let dl = dataLogin();
    let folio;

    try {

        folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    } catch (error) {

        $("#mi-modal-message .modal-header h4").text("Mensaje:");
        $("#mi-modal-message .modal-body").html("<p>primero se debe de elegir una fila de la tabla para cancelar el registro</p>");
        $("#mi-modal-message").modal('show');

        return false;
    }

    $("#mi-modal .modal-header h4").text("Confirmar Cancelación");
    $("#mi-modal .modal-body").html("<p>Está a punto de cancelar este registro.</p><p>¿Desea continuar con la cancelación?</p>");
    $("#mi-modal").modal('show');

    modalConfirmRequisicion(async function(confirm) {
        if (confirm) {

            await $.ajax({
                type: "PUT",
                url: urlData + "/cancelData",
                data: { "isLogedIn": dl, "folio": folio },
                success: function(response) {

                    showMessage('success', 'Exito', 'Información cancelada');

                    $('#tableRequisiciones').DataTable().ajax.reload();
                    // $('#tableRequisicionesAuth').DataTable().ajax.reload();
                    // $('#tableOrdenesCompra').DataTable().ajax.reload();
                    // $('#tableCanceladas').DataTable().ajax.reload();
                },
                error: function(exception) {

                    console.error(exception);
                    showMessage('danger', 'Error', exception.showMessage());
                }
            });
        } else {
            console.log(confirm)
        }
    });
});

/**
 * javascript comment
 * @Author: flydreame
 * @Date: 2022-03-24 12:06:26
 * @Desc: This event show the details of a row selected from a table
 */

$('#btnEliminar').click(() => {

    let dl = dataLogin();
    let folio;

    try {

        folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    } catch (error) {

        $("#mi-modal-message .modal-header h4").text("Mensaje:");
        $("#mi-modal-message .modal-body").html("<p>primero se debe de elegir una fila de la tabla para eliminar el registro</p>");
        $("#mi-modal-message").modal('show');

        return false;
    }

    $("#mi-modal .modal-header h4").text("Confirmar Eliminación");
    $("#mi-modal .modal-body").html("<p>Está a punto de eliminar este registro, al hacerlo la información se perderá y no podrá ser recuperada.</p><p>¿Desea continuar con la eliminación?</p>");
    $("#mi-modal").modal('show');

    modalConfirmRequisicion(async function(confirm) {
        if (confirm) {

            await $.ajax({
                type: "DELETE",
                url: urlData + "/deleteData",
                data: { "isLogedIn": dl, "folio": folio },
                success: function(response) {

                    showMessage('success', 'Exito', 'Información borrada');

                    $('#tableRequisiciones').DataTable().ajax.reload();
                    // $('#tableRequisicionesAuth').DataTable().ajax.reload();
                    // $('#tableOrdenesCompra').DataTable().ajax.reload();
                    // $('#tableCanceladas').DataTable().ajax.reload();
                },
                error: function(exception) {

                    console.error(exception);
                    showMessage('danger', 'Error', exception.showMessage());
                }
            });
        } else {
            console.log(confirm);
        }

    });
});

var modalConfirmRequisicion = function(callback) {

    $("#modal-btn-si").on("click", function() {
        callback(true);
        $("#mi-modal").modal('hide');
    });

    $("#modal-btn-no").on("click", function() {
        callback(false);
        $("#mi-modal").modal('hide');
    });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-05 12:57:45
 * @Desc: Apartado ordenes de compra
 */

$('#btnRegistraOrdenCompra').click(async function() {

    let dl = dataLogin();
    let folio = $('#tableRequisicionesAuth tbody tr.rowSelected td.folio').text();

    await fetch(urlData + "/obtainOrdenCompra?folio=" + folio).then(data => data.json()).then(dataOrdenCompra => {

        let OrdenCompra = dataOrdenCompra.compra[0];

        // let folio = "<strong>Folio: </strong>" + dataOrdenCompra;
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .folio").html("<strong>Folio: </strong>" + folio);

        let proyecto = "<strong>Proyecto: </strong>" + OrdenCompra.PROYECTO;
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .proyecto").html(proyecto);

        let fechaSolicitud = "<strong>Fecha Solicitud: </strong>" + moment(OrdenCompra.FECHA_SOLICITUD).format("YYYY-MM-DD");
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .fecha__solicitud").html(fechaSolicitud);

        let fechaRequerida = "<strong>Fecha requerida: </strong>" + moment(OrdenCompra.FECHA_REQUISICION).format("YYYY-MM-DD");
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .fecha__requerida").html(fechaRequerida);

        let solcitado = "<strong>Solicitdo por: </strong>" + OrdenCompra.NOMBRE;
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .solicitado").html(solcitado);

        let compannia = "<strong>Compañia: </strong>" + OrdenCompra.COMPANIA;
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .compannia").html(compannia);

        let ciudad = "<strong>Ciudad: </strong>" + OrdenCompra.CIUDAD;
        $("#modalCrearOrdenCompra .modal-body .content__requisicion .ciudad").html(ciudad);

        $('#consideracionesEspc').val(OrdenCompra.Consideraciones_Especiales);

        let dataDetails = dataOrdenCompra.detalleCompra;

        $('#tableDetailCrearOrdenCompra tbody').empty();

        let rows = "";
        $.each(dataDetails, function(index, value) {

            rows += "<tr style='padding: 0 !important;'>" +
                "<td data-mtrlvalueOrden='" + value.CONSECUTIVO + "'>" + value.CONSECUTIVO + "</td>" +
                "<td data-mtrlvalueOrden='" + value.CANTIDAD + "'>" + value.CANTIDAD + "</td>" +
                "<td data-mtrlvalueOrden='" + value.UNIDAD + "'>" + value.UNIDAD + "</td>" +
                "<td data-mtrlvalueOrden='" + value.MATERIAL + "'><p class='ajusteTextoTablasModal' style='font-size: 11px !important;'>" + value.MATERIAL + "</p></td>" +
                "<td data-mtrlvalueOrden='" + value.PROVEEDOR + "'>" + value.PROVEEDOR + "</td>" +
                "<td><select class='form-select slctOrdenCompraTable'></select></td>" +
                "</tr>";
        });

        $('#tableDetailCrearOrdenCompra tbody').append(rows);

        let optionsSelect = "";
        optionsSelect += "<option value=''>-</option>";
        for (let i = 1; i <= 20; i++) {

            optionsSelect += "<option value='" + i + "'>" + i + "</option>";
        }

        $('.slctOrdenCompraTable').append(optionsSelect);

        $('.slctOrdenCompraTable').val("1");

    }).catch(() => { IsLogedIn(); });

    $('#btnOrdenesAutomaticas').click(function() {

        $('.slctOrdenCompraTable').val("1");

        $('#tableDetailOrdenCompra tbody tr').each(function() {

            $(this).removeClass('cleanOrders');
        });
    });

    $('#btnLimpiarOrdenes').click(function() {

        $('.slctOrdenCompraTable').val("");

        $('#tableDetailOrdenCompra tbody tr').each(function() {

            $(this).addClass('cleanOrders');
        });
    });

    $('#modalCrearOrdenCompra').modal('show');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-20 18:07:06
 * @Desc: This function obtain the data of the OC and the details of the OC
 */
$('#btnEditarOrdenCompra').click(function() {

    let folio = $('#tableRequisicionesAuth tbody tr.rowSelected td.folio').text();
    await fetch(urlData + "/obtainOrdenCompra?folio=" + folio).then(data => data.json()).then(dataOrdenCompra => {}).catch(() => { IsLogedIn(); });

    $('#modalEditarOrdenCompra').modal('show');
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-06 18:14:00
 * @Desc: Buttons to save and update the information of the "ordenes de compra"
 */

$('#btnCrearOrdenCompra').click(async() => {

    let dataOrdenCompra = [];

    dataOrdenCompra.push({ "Facturar": "SINCI GDL S. de R.L. de C.V." });
    dataOrdenCompra.push({ "RFC": "SGD 070919 8U3" });
    dataOrdenCompra.push({ "Domicilio_Compania": "Aurelio L Gallardo 615  Col Ladrón de Guevara   Guadalajara Jal  44600" });
    dataOrdenCompra.push({ "proveedor": 126 });
    dataOrdenCompra.push({ "year": moment().format('YYYY') });

    let dataTable = [];
    let dataRow = [];
    let totTd = 1;
    // let firstRow = 1;

    $('#tableDetailCrearOrdenCompra tbody tr').each(function(index, tr) {

        // if (firstRow != 1) {

        $(tr).find('td').each(function(index, td) {

            if (totTd < 7) {

                if (totTd != 6)
                    dataRow.push($(this).attr('data-mtrlvalueOrden'));
                // dataRow.push($(this).data('mtrlvalueOrden'));

                else
                    dataRow.push($(this).find('.slctOrdenCompraTable').val());
            } else {

                dataTable.push(dataRow);
                dataRow = [];
                totTd = 0;
            }

            totTd++;
        });
        // }

        // firstRow++;
    });

    dataOrdenCompra.push({ "name": `Materials`, "value": JSON.stringify(dataTable) });

    console.log(dataOrdenCompra);

    updateOrdenCompra("/saveDataOrdenCompra", dataOrdenCompra);

    // await $.ajax({
    //     type: "PUT",
    //     url: urlData + "/saveDataOrdenCompra",
    //     data: { "isLogedIn": dl, "data": dataOrdenCompra },
    //     success: function(response) {

    //     },
    //     error: function(exception) {

    //         console.error(exception);
    //         showMessage('danger', 'Error', exception.showMessage());
    //     }
    // });
});

$('#btnActualizarOrdenCompra').click(async() => {

    dataOrdenCompra = $('#dataEditOrdenCompra').serializeArray();

    let dataTable = [];
    let dataRow = [];
    let totTd = 1;
    let firstRow = 1;

    $('#tableMaterialsEditarOrdenCompra tbody tr').each(function(index, tr) {

        if (firstRow != 1) {

            $(tr).find('td').each(function(index, td) {

                if (totTd < 8) {

                    // dataRow.push($(this).data('mtrlvalueOrden'));
                    dataRow.push($(this).attr('mtrlvalueOrden'));
                } else {

                    dataTable.push(dataRow);
                    dataRow = [];
                    totTd = 0;
                }

                totTd++;
            });
        }

        firstRow++;
    });

    dataOrdenCompra.push({ "name": `Materials`, "value": JSON.stringify(dataTable) });

    console.log(dataOrdenCompra);

    updateOrdenCompra("/updateDataOrdenCompra", dataOrdenCompra);
});

let updateOrdenCompra = (urlToUpdate, dataOrdenCompra) => {

    // let dataOrdenCompra = [];

    let dl = dataLogin();
    let folio = $('#tableRequisicionesAuth tbody tr.rowSelected td.folio').text();

    $.ajax({
        type: "PUT",
        // url: urlData + "/updateDataOrdenCompra",
        url: urlData + urlToUpdate,
        data: { "isLogedIn": dl, "data": dataOrdenCompra, "folio": folio },
        success: function(response) {

        },
        error: function(exception) {

            console.error(exception);
            showMessage('danger', 'Error', exception.showMessage());
        }
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-09 13:51:44
 * @Desc:
 */
$('#addMaterialOrden').click(function() {

    let cantidad = $('#txtCantidad').val();
    let unidad = $('#slctUnidad option:selected').text();
    let material = $('#txtMaterial').val();
    let catalogo = $('#txtCatalogo').val();
    let precio = $('#slctProveedor').val();
    let importe = $('#txtMarca').val();

    let consecutivo = $('#tableMaterialsOrdenCompra tbody tr').length;

    let newRowMaterial = "<tr>" +
        "<td class='consecutivo' data-mtrlvalueOrden='" + consecutivo + "'>" + consecutivo + "</td>" +
        "<td class='cantidad' data-mtrlvalueOrden='" + cantidad + "'>" + cantidad + "</td>" +
        "<td class='unidad' data-mtrlvalueOrden='" + unidad + "'>" + unidad + "</td>" +
        "<td class='material' data-mtrlvalueOrden='" + material + "'>" + material + "</td>" +
        "<td class='catalogo' data-mtrlvalueOrden='" + catalogo + "'>" + catalogo + "</td>" +
        "<td class='precio' data-mtrlvalueOrden='" + precio + "'>" + precio + "</td>" +
        "<td class='importe' data-mtrlvalueOrden='" + importe + "'>" + importe + "</td>" +
        "<td> <i class='material-icons opacity-10' class='removeMaterialOrden'>clear</i> " +
        "<i class='material-icons opacity-10' class='editMaterialOrden'>drive_file_rename_outline</i> </td>" +
        "</tr>";

    $('#materialsRequiredOrden').after(newRowMaterial);

    iniciateEditMaterialOrden();
    iniciateRemovematerialsOrden();
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-09 13:53:50
 * @Desc:
 */
let iniciateEditMaterialOrden = () => {

    $('#tableMaterialsOrdenCompra tbody tr .editMaterialOrden').each(function() {
        $(this).click(function() {

            let rowData = $(this).parent().parent().find('td');
            let dataContainer = [];

            rowData.each(function(index, value) {
                // dataContainer.push($(this).data('mtrlvalueOrden'));
                dataContainer.push($(this).attr('mtrlvalueOrden'));
            });

            $('#consecutivo').val(dataContainer[0]);
            $('#txtCantidadOrden').val(dataContainer[1]);
            $('#slctUnidadOrden').val(dataContainer[2]);
            $('#txtMaterialOrden').val(dataContainer[3])
            $('#txtCatalogoOrden').val(dataContainer[4]);;
            $('#txtPrecioOrden').val(dataContainer[5]);

            calcularImporte(dataContainer[1], dataContainer[5]);

            $(this).parent().parent().remove();
        });
    });
}

let iniciateRemovematerialsOrden = () => {

    $('#txtCantidadOrden').val(1);
    $('#slctUnidadOrden').val("");
    $('#txtMaterialOrden').val("");
    $('#txtCatalogoOrden').val("");
    $('#txtPrecioOrden').val("");
    // $('#txtCatalogo').val("");

    $('#tableMaterialsOrdenCompra tbody tr .removeMaterialOrden').each(function() {
        $(this).click(function() {
            $(this).parent().parent().remove();
        });
    });
}

$('#btnCalculateOrdenCompra').click(() => {

    // $('#tableMaterialsOrdenCompra tbody tr #editMaterialOrden')
    let table = document.getElementById('tableMaterialsOrdenCompra');
    let dataTableOrden = document.getElementsByClassName('importe')

    dataTableOrden.forEach((value, index) => {

        console.log(value);
    });
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-05-09 16:53:39
 * @Desc: Calucale the importe of the data in the internal table
 */

$('#tableMaterialsOrdenCompra #txtCantidadOrden').keyup(function() {

    calcularImporte($(this).val(), $('#txtPrecioOrden').val());
});

$('#tableMaterialsOrdenCompra #txtPrecioOrden').keyup(function() {

    calcularImporte($('#txtCantidadOrden').val(), $(this).val());
});

let calcularImporte = (cantidad, precio) => {
    let importe = cantidad * precio;

    $('#tableMaterialsOrdenCompra tbody .importeOrden').text(importe);
}
