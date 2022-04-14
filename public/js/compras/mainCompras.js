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

    let today = date.getFullYear() + "-" + (date.getMonth() < 9 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1) + "-" + (date.getDate() < 10 ? "0" + (date.getDate()) : date.getDate());
    $('#dateRequired').val(today);

    selectYears(15);

    inciateTablesDT();
    modalComprasSinci();

    // $('#registrarRequisicion').modal('show');
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
    // await fetch(urlData + "/obtainDataUser?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctUsuario'); }).catch(() => { IsLogedIn(); });
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
    let proveedor = $('#slctProveedor option:selected').text();
    let marca = $('#txtMarca').val();
    let catalogo = $('#txtCatalogo').val();

    let newRowaterial = "<tr>" +
        "<td>--</td>" +
        "<td name='cantidadMaterial'>" + cantidad + "</td>" +
        "<td id='unidad' value='" + unidad + "'>" + unidad + "</td>" +
        "<td id='material' value='" + material + "'>" + material + "</td>" +
        "<td id='proveedor' value='" + proveedor + "'>" + proveedor + "</td>" +
        "<td id='marca' value='" + marca + "'>" + marca + "</td>" +
        "<td id='catalogo' value='" + catalogo + "'>" + catalogo + "</td>" +
        "<td> <i class='material-icons opacity-10' id='removeMaterial'>clear</i> </td>" +
        "</tr>";

    // $('#materialsRequired').before(newRowaterial);
    $('#materialsRequired').after(newRowaterial);

    iniciateRemovematerials();

    $('#txtCantidad').val(1);
    $('#slctUnidad').val("");
    $('#txtMaterial').val("");
    $('#slctProveedor').val("");
    $('#txtMarca').val("");
    $('#txtCatalogo').val("");
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-22 15:58:27
 * @Desc: This function enable the function to remove the materials registered in the table
 */
let iniciateRemovematerials = () => {

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

    var requisicionData = $('#dataRequisiciones').serializeArray();

    let dataTable = [];
    let dataRow = [];
    var totTd = 1;
    var firstRow = 1;
    $('#tableMaterials tbody tr').each(function(index, tr) {

        if (firstRow != 1) {

            $(tr).find('td').each(function(index, td) {

                if (totTd < 8) {

                    dataRow.push($(this).text());
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


    requisicionData.push(dataTable);
});
