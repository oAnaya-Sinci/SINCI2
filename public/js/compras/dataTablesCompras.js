/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-05 11:31:14
 * @Desc: This function inciate all the tables of the requisicion part
 */
let inciateTablesDT = async() => {

    let dl = dataLogin();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let pageLength = 10;
    let searching = true;

    tableRequisicion(dl, pageLength, searching);
    tableRequisicionAuth(dl, pageLength, searching);
    tableOrdenCompra(dl, pageLength, searching);
    tableCanceladas(dl, pageLength, searching);

    return true;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-04 15:30:37
 * @Desc: this function inciate the dataTable for the "Requisicion Data" table;
 */
let tableRequisicion = async(dl, pageLength, searching) => {

    await $('#tableRequisiciones').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataRequisicion?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: function() {
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
let tableRequisicionAuth = async(dl, pageLength, searching) => {

    await $('#tableRequisicionesAuth').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataRequisicionAuth?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: function() {
                console.time('tableRequisicionesAuth');
            },
            complete: function() {

                console.timeEnd('tableRequisicionesAuth');

                requisicionesAuthInciatePagesTables();
            }
        },

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
            { data: "NOTAS_ORDENCOMPRA", visible: false, className: "notaOrdenCompraRA" },
            { data: "NOTAS_REQUISICION", visible: false, className: "notaRequisicionRA" },
            { data: "ENTREGAR_EN", visible: false, className: "notaEntregarEnRA" },
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
let tableOrdenCompra = async(dl, pageLength, searching) => {

    await $('#tableOrdenesCompra').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataOrdenesCompra",
            type: "GET",
            data: function(d) {
                return $.extend({}, d, {
                    "isLogedIn": dl,
                    "yearSearch": $('#slctYearOrdenCompra').val()
                });
            },
            dataSrc: 'data',
            beforeSend: function() {
                console.time('tableOrdenesCompra');

                inLoader();
            },
            complete: function() {

                console.timeEnd('tableOrdenesCompra');

                ordenCompraInciatePagesTables();

                outLoader();
            }
        },

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
            { data: "NOTAS_ORDENCOMPRA", visible: false, className: "notaOrdenCompraOC" },
            { data: "NOTAS_REQUISICION", visible: false, className: "notaRequisicionOC" },
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
let tableCanceladas = async(dl, pageLength, searching) => {

    await $('#tableCanceladas').DataTable({
        dom: 'Bfrtip',

        ajax: {
            url: urlData + "/obtainDataCanceladas?isLogedIn=" + dl,
            type: "GET",
            dataSrc: 'data',
            beforeSend: function() {
                console.time('tableCanceladas');
            },
            complete: function() {

                console.timeEnd('tableCanceladas');

                canceladasInciatePagesTables();
            }
        },

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

    $('.paginate_button').click(function() {

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

        $(this).click(function() {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");

            let folio = $(this).parent().children()[11].textContent;
            let tipo = $('#slctRequisicionAuth').val();

            fetch(urlData + "/obtainNotasRequisicionAuth?folio=" + folio + "&slctTipo=" + tipo).then(data => data.json()).then(nota => { $('#notesRequisicionAuth').val(nota[0].RESPONSE); }).catch(() => { IsLogedIn(); });
        });
    });

    $('.paginate_button').click(function() {

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

        $(this).click(function() {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");

            let folio = $(this).parent().children()[12].textContent;
            let tipo = $('#slctOrdenCompra').val();

            fetch(urlData + "/obtainNotasOrdenCompra?folio=" + folio + "&slctTipo=" + tipo).then(data => data.json()).then(nota => { $('#notesOrdenesCompra').val(nota[0].RESPONSE); }).catch(() => { IsLogedIn(); });
        });
    });

    $('.paginate_button').click(function() {

        ordenCompraInciatePagesTables();
    });
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-04-14 13:49:10
 * @Desc:
 */
let canceladasInciatePagesTables = () => {

    $('#tableCanceladas_wrapper tbody tr td').each(function() {

        $(this).click(function() {

            $('.dataTables_wrapper tbody tr').removeClass("rowSelected");
            $(this).parent().addClass("rowSelected");
        });
    });

    $('.paginate_button').click(function() {

        canceladasInciatePagesTables();
    });
}


/**
 * javascript comment
 * @Author: flydreame
 * @Date: 2022-03-24 12:06:26
 * @Desc: This event show the details of a row selected from a table
 */

$('#btnVerDetalle').click(async function() {

    // console.log($('.dataTables_wrapper tbody tr.rowSelected td.folio')[0].innerText);

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

        }
    });
});
