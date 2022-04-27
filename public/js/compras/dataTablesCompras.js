/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-05 11:31:14
 * @Desc: This function inciate all the tables of the requisicion part
 */
let iniciateTablesDT = () => {

    let dl = dataLogin();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let pageLength = 25;
    let searching = true;
    let tableScrollX = true;
    let tableScrollY = false;

    tableRequisicion(dl, pageLength, searching, tableScrollX, tableScrollY);
    tableRequisicionAuth(dl, pageLength, searching, tableScrollX, tableScrollY);
    tableOrdenCompra(dl, pageLength, searching, tableScrollX, tableScrollY);
    tableCanceladas(dl, pageLength, searching, tableScrollX, tableScrollY);

    return true;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-04 15:30:37
 * @Desc: this function inciate the dataTable for the "Requisicion Data" table;
 */
let tableRequisicion = async(dl, pageLength, searching, tableScrollX, tableScrollY) => {

    await $('#tableRequisiciones').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataRequisicion?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: () => {
                console.time('tableRequisiciones');
            },
            // data: function(d) {
            //     return $.extend({}, d, {
            //         "fechainicio": $('#i_dia').val() == "" ? moment().add(1, 'days').format("YYYY-MM-DD") : $('#i_dia').val()
            //     });
            // },
            complete: function(response) {

                console.timeEnd('tableRequisiciones');

                requisicionesInciatePagesTables();
            }
        },

        scrollX: tableScrollX,
        scrollY: tableScrollY,

        columns: [
            { data: "FOLIO", className: "folio" },
            { data: "FECHA_SOLICITUD" },
            { data: "FECHA_REQUISICION" },
            { data: "FECHA_PORENTREGA" },
            { data: "PROYECTO" },
            { data: "OFICINA_Texto" },
            { data: "PEDIDOPOR" },
            { data: "COMPANIA" },
            { data: "CIUDAD" },
            { data: "Area" },
            { data: "AplicaV2" },
            { data: "Prioridad" }
        ],

        columnDefs: [{
            targets: [1, 2, 3],
            render: function(value) {

                if (value != null) {

                    let dateFormated = formatDates(value);
                    return moment(dateFormated).format("DD-MMM-YYYY");
                } else {

                    return "";
                }
            }
        }],

        order: [
            [1, 'asc']
        ],

        "pageLength": pageLength,
        "searching": searching,
        buttons: [
            'excel'
        ]
    });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-04 15:30:41
 * @Desc:this function inciate the dataTable for the "Requisiscion authorizadas" table
 */
let tableRequisicionAuth = async(dl, pageLength, searching, tableScrollX, tableScrollY) => {

    await $('#tableRequisicionesAuth').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataRequisicionAuth?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: () => {
                console.time('tableRequisicionesAuth');
            },
            complete: () => {

                console.timeEnd('tableRequisicionesAuth');

                requisicionesAuthInciatePagesTables();
            }
        },

        scrollX: tableScrollX,
        scrollY: tableScrollY,

        columns: [
            { data: "STATUS" },
            { data: "FOLIO_ORDENCOMPRA" },
            { data: "PROVEEDOR" },
            { data: "FECHA_ORDENCOMPRA" },
            { data: "FECHA_PORENTREGA" },
            { data: "MONEDA" },
            { data: "TOTAL" },
            { data: "CONDICIONES_PAGO" },
            { data: "AplicaV2" },
            { data: "Prioridad" },
            { data: "OFICINA_Texto" },
            { data: "FOLIO", className: "folio" },
            { data: "CODIGO" },
            { data: "FECHA_SOLICITUD" },
            { data: "SOLICITADOPOR" },
            { data: "AUTORIZADOPOR" },
            { data: "FECHA_AUTORIZACION" },
            { data: "ORDENCOMPRAPOR" },
            // { data: "NOTAS_ORDENCOMPRA", visible: false, className: "notaOrdenCompraRA" },
            // { data: "NOTAS_REQUISICION", visible: false, className: "notaRequisicionRA" },
            // { data: "ENTREGAR_EN", visible: false, className: "notaEntregarEnRA" },
        ],
        columnDefs: [{
                targets: [3, 4, 13, 16],
                render: function(value) {

                    if (value != null) {

                        let dateFormated = formatDates(value);
                        return moment(dateFormated).format("DD-MMM-YYYY");
                    } else {

                        return "";
                    }
                }
            },
            {
                targets: 6,
                render: function(numero) {

                    if (numero == null)
                        numero = 0;

                    return '$' + numero.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                }
            }
        ],

        order: [
            [3, 'asc']
        ],

        "pageLength": pageLength,
        "searching": searching,
        buttons: [
            'excel'
        ]
    });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-04 15:30:44
 * @Desc: this function inciate the datatable for the "Orden de Compra" table
 */
let tableOrdenCompra = async(dl, pageLength, searching, tableScrollX, tableScrollY) => {

    await $('#tableOrdenesCompra').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataOrdenesCompra",
            type: "GET",
            data: function(d) {
                return $.extend({}, d, {
                    "isLogedIn": dl,
                    "yearSearch": $('#slctYearOrdenCompra').val() == undefined ? moment().format("YYYY") : $('#slctYearOrdenCompra').val()
                });
            },
            dataSrc: 'data',
            beforeSend: () => {
                console.time('tableOrdenesCompra');

                inLoader();
            },
            complete: () => {

                console.timeEnd('tableOrdenesCompra');

                ordenCompraInciatePagesTables();

                outLoader();
            }
        },

        scrollX: tableScrollX,
        scrollY: tableScrollY,

        columns: [
            { data: "CODIGO" },
            { data: "RECEPCION" },
            { data: "FOLIO_ORDENCOMPRA" },
            { data: "FECHA_ORDENCOMPRA" },
            { data: "FECHA_CIERRE" },
            { data: "FECHA_PORENTREGA" },
            { data: "MONEDA" },
            { data: "CONDICIONES_PAGO" },
            { data: "TOTAL" },
            // { data: "APLICA" },
            { data: "AplicaV2" },
            { data: "Prioridad" },
            { data: "OFICINA_Texto" },
            { data: "FOLIO", className: "folio" },
            { data: "FECHA_SOLICITUD" },
            { data: "SOLICITADOPOR" },
            { data: "AUTORIZADOPOR" },
            { data: "ORDENCOMPRAPOR" },
            { data: "FECHA_AUTORIZACION" },
            { data: "FECHA_REQUISICION" },
            { data: "CERRO" },
            // { data: "NOTAS_ORDENCOMPRA", visible: false, className: "notaOrdenCompraOC" },
            // { data: "NOTAS_REQUISICION", visible: false, className: "notaRequisicionOC" },
        ],

        columnDefs: [{
                targets: [3, 5, 13, 18],
                render: function(value) {

                    if (value != null) {

                        let dateFormated = formatDates(value);
                        return moment(dateFormated).format("DD-MMM-YYYY");
                    } else {

                        return "";
                    }
                }
            },
            {
                targets: [4, 17],
                render: function(value) {

                    if (value != null) {

                        let dateFormated = formatDates(value);
                        return moment(dateFormated).format("DD-MMM-YYYY hh:mm a");
                    } else {

                        return "";
                    }
                }
            },
            {
                targets: 8,
                render: function(numero) {

                    if (numero == null)
                        numero = 0;

                    return '$' + numero.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                }
            }
        ],

        order: [
            [3, 'asc']
        ],

        "pageLength": pageLength,
        "searching": searching,
        buttons: [
            'excel'
        ]
    });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-04 15:30:47
 * @Desc: this function iniciate the dataTable of the "Canceladas" Table
 */
let tableCanceladas = async(dl, pageLength, searching, tableScrollX, tableScrollY) => {

    await $('#tableCanceladas').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataCanceladas?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: () => {
                console.time('tableCanceladas');
            },
            complete: () => {

                console.timeEnd('tableCanceladas');

                canceladasInciatePagesTables();
            }
        },

        scrollX: tableScrollX,
        scrollY: tableScrollY,

        columns: [
            { data: "FOLIO", className: "folio" },
            { data: "FECHA_SOLICITUD" },
            { data: "PROYECTO" },
            { data: "SOLICITADOPOR" },
            { data: "AUTORIZADOPOR" },
            { data: "ORDENCOMPRAPOR" },
            { data: "FOLIO_ORDENCOMPRA" },
            { data: "FECHA_ORDENCOMPRA" },
            { data: "FECHA_PORENTREGA" },
            { data: "FECHA_CIERRE" },
            { data: "AplicaV2" },
            { data: "OFICINA_Texto" }
        ],

        columnDefs: [{
            targets: [1, 7, 8, 9],
            render: function(value) {

                if (value != null) {

                    let dateFormated = formatDates(value);
                    return moment(dateFormated).format("DD-MMM-YYYY");
                } else {

                    return "";
                }
            }
        }],

        order: [
            [1, 'asc']
        ],

        "pageLength": pageLength,
        "searching": searching,
        buttons: [
            'excel'
        ]

    });
};

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:50:10
 * @Desc:
 */
let formatDates = (dateSended) => {

    let dateToReturn = "";

    if (window.navigator.vendor == "Google Inc.") {

        dateSended = dateSended.replace('T', ' ');
        dateToReturn = dateSended.replace('Z', ' ');

    } else {

        let dS = new Date(dateSended);
        dateToReturn = dS.setTime(dS.getTime() + dS.getTimezoneOffset() * 60 * 1000);
    }

    return dateToReturn;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:48:33
 * @Desc:
 */
let requisicionesInciatePagesTables = () => {

    $('#tableRequisiciones_wrapper tbody tr td').each(function() {

        $(this).click(function() {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");

            let folio = $(this).parent()[0].firstChild.textContent;

            fetch(urlData + "/obtainNotasRequisicion?folio=" + folio).then(data => data.json()).then(nota => { $('#notesRequisicion').val(nota[0].NOTAS_REQUISICION); }).catch(() => { IsLogedIn(); });
        });
    });

    $('.paginate_button').click(() => {

        requisicionesInciatePagesTables();
    });

    $('#tableRequisiciones_wrapper thead .sorting').click(function() {
        requisicionesInciatePagesTables();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:48:36
 * @Desc:
 */
let requisicionesAuthInciatePagesTables = () => {

    $('#tableRequisicionesAuth_wrapper tbody tr td').each(function() {

        $(this).click(() => {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");

            let folio = $(this).parent().children()[11].textContent;
            let tipo = $('#slctRequisicionAuth').val();

            fetch(urlData + "/obtainNotasRequisicionAuth?folio=" + folio + "&slctTipo=" + tipo).then(data => data.json()).then(nota => { $('#notesRequisicionAuth').val(nota[0].RESPONSE); }).catch(() => { IsLogedIn(); });
        });
    });

    $('.paginate_button').click(() => {

        requisicionesAuthInciatePagesTables();
    });

    $('#tableRequisicionesAuth_wrapper thead .sorting').click(function() {
        requisicionesAuthInciatePagesTables();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:48:46
 * @Desc:
 */
let ordenCompraInciatePagesTables = () => {

    $('#tableOrdenesCompra_wrapper tbody tr td').each(function() {

        $(this).click(() => {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");

            let folio = $(this).parent().children()[12].textContent;
            let tipo = $('#slctOrdenCompra').val();

            fetch(urlData + "/obtainNotasOrdenCompra?folio=" + folio + "&slctTipo=" + tipo).then(data => data.json()).then(nota => { $('#notesOrdenesCompra').val(nota[0].RESPONSE); }).catch(() => { IsLogedIn(); });
        });
    });

    $('.paginate_button').click(() => {
        ordenCompraInciatePagesTables();
    });

    $('#tableOrdenesCompra_wrapper thead .sorting').click(function() {
        ordenCompraInciatePagesTables();
    });
}

$('#slctOrdenCompra').change(function() {

    console.log($('#tableOrdenesCompra_wrapper tbody tr.rowSelected td.folio'));

    let folio = $('#tableOrdenesCompra_wrapper tbody tr.rowSelected td.folio')[0].innerText;
    let tipo = $(this).val();

    fetch(urlData + "/obtainNotasOrdenCompra?folio=" + folio + "&slctTipo=" + tipo).then(data => data.json()).then(nota => { $('#notesOrdenesCompra').val(nota[0].RESPONSE); }).catch(() => { IsLogedIn(); });
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:49:10
 * @Desc:
 */
let canceladasInciatePagesTables = () => {

    $('#tableCanceladas_wrapper tbody tr td').each(function() {

        $(this).click(() => {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");
        });
    });

    $('.paginate_button').click(function() {

        canceladasInciatePagesTables();
    });

    $('#tableCanceladas_wrapper thead .sorting').click(function() {
        canceladasInciatePagesTables();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-19 16:47:14
 * @Desc:
 */
$('#myTab button').click(() => {

    $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
});
