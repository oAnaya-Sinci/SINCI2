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

    let date = new Date();

    // let today = date.getFullYear() + "-" + (date.getMonth() < 9 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1) + "-" + (date.getDate() < 10 ? "0" + (date.getDate()) : date.getDate());
    let today = moment().format('YYYY-MM-DD');
    $('#dateRequired').val(today);

    selectYears(15);

    iniciateTablesDT();
    modalComprasSinci();
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
    await fetch(urlData + "/obtainDataProveedores?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctProveedor', 'Sin proveedor'); }).catch(() => { IsLogedIn(); });
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
    let unidad = $('#slctUnidad option:selected').text();
    let material = $('#txtMaterial').val();
    let proveedorId = $('#slctProveedor').val();
    let proveedor = $('#slctProveedor option:selected').text();
    let marca = $('#txtMarca').val();
    let catalogo = $('#txtCatalogo').val();

    let consecutivo = $('#tableMaterials tbody tr').length;

    let newRowMaterial = "<tr>" +
        "<td id='consecutivo' data-mtrlvalue='" + consecutivo + "'>" + consecutivo + "</td>" +
        "<td id='cantidad' data-mtrlvalue='" + cantidad + "'>" + cantidad + "</td>" +
        "<td id='unidad' data-mtrlvalue='" + unidad + "'>" + unidad + "</td>" +
        "<td id='material' data-mtrlvalue='" + material + "'>" + material + "</td>" +
        "<td id='proveedor' data-mtrlvalue='" + proveedorId + "'>" + proveedor + "</td>" +
        "<td id='marca' data-mtrlvalue='" + marca + "'>" + marca + "</td>" +
        "<td id='catalogo' data-mtrlvalue='" + catalogo + "'>" + catalogo + "</td>" +
        "<td> <i class='material-icons opacity-10' id='removeMaterial'>clear</i> </td>" +
        "</tr>";

    // $('#materialsRequired').before(newRowMaterial);
    $('#materialsRequired').after(newRowMaterial);

    iniciateRemovematerials();
});

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

    $('#tableMaterials tbody tr #removeMaterial').each(function() {
        $(this).click(function() { removeMaterial(this); });
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 15:59:04
 * @Desc: In this function the data selected to delete for the user was removed from the table
 */

let removeMaterial = (row) => {

    $(row).parent().parent().remove();
    iniciateRemovematerials();
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

                    // dataRow.push($(this).text());
                    dataRow.push($(this).data('mtrlvalue'));
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
    let idCompra = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;

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
 * @Date: 2022-04-26 13:52:05
 * @Desc:
 */
$('#btnEditarRequisicion').click(async() => {

    $('#btnSaveEvent').addClass('displayButton');
    $('#btnEditEvent').removeClass('displayButton');

    let dl = dataLogin();
    let folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;

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
            "<td id='consecutivo' data-mtrlvalue='" + valor.CONSECUTIVO + "'>" + valor.CONSECUTIVO + "</td>" +
            "<td id='cantidad' data-mtrlvalue='" + valor.CANTIDAD + "'>" + valor.CANTIDAD + "</td>" +
            "<td id='unidad' data-mtrlvalue='" + valor.UNIDAD + "'>" + valor.UNIDAD + "</td>" +
            "<td id='material' data-mtrlvalue='" + valor.MATERIAL + "'>" + valor.MATERIAL + "</td>" +
            "<td id='proveedor' data-mtrlvalue='" + valor.ID_PROVEEDOR + "'>" + valor.PROVEEDOR + "</td>" +
            "<td id='marca' data-mtrlvalue='" + valor.MARCA + "'>" + valor.MARCA + "</td>" +
            "<td id='catalogo' data-mtrlvalue='" + valor.CATALOGO + "'>" + valor.CATALOGO + "</td>" +
            "<td> <i class='material-icons opacity-10' id='removeMaterial'>clear</i> </td>" +
            "</tr>";
    });

    $('#materialsRequired').after(RowsMaterial);

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

    $('#tableMaterials tbody tr #removeMaterial').each(function() {
        $(this).click();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-26 13:06:51
 * @Desc:
 */
var modalConfirmCompras = function(callback) {

    // alert("Funcion para abrir modal de confirmacion");

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
 * @Author: flydreame
 * @Date: 2022-03-24 12:06:26
 * @Desc: This event show the details of a row selected from a table
 */

$('#btnCancelar').click(() => {

    let dl = dataLogin();
    let folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;

    $("#mi-modal .modal-header h4").text("Confirmar Cancelación");
    $("#mi-modal .modal-body").html("<p>Está a punto de cancelar este registro.</p><p>¿Desea continuar con la cancelación?</p>");
    $("#mi-modal").modal('show');

    modalConfirm(async function(confirm) {
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
    let folio = $('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText;

    $("#mi-modal .modal-header h4").text("Confirmar Eliminación");
    $("#mi-modal .modal-body").html("<p>Está a punto de eliminar este registro, al hacerlo la información se perderá y no podrá ser recuperada.</p><p>¿Desea continuar con la eliminación?</p>");
    $("#mi-modal").modal('show');

    modalConfirm(async function(confirm) {
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
