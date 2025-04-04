var updateEvent = false;
var idEventUpdate;

let calendar;

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 13:53:19
 * @Desc: Here the date inputs was bloqueck to not use the keyborad
 */
$(document).ready(function() {

    let encuestario = Number(window.localStorage.getItem('encuestador'));

    if(encuestario == 2){
        window.location.href = '/dashboard'
    }

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

    document.getElementById("startDate").addEventListener("keyup", preventDef, false);
    document.getElementById("startDate").addEventListener("keydown", preventDef, false);

    document.getElementById("endDate").addEventListener("keyup", preventDef, false);
    document.getElementById("endDate").addEventListener("keydown", preventDef, false);

    calendarSinci();
});

function preventDef(event) {
    event.preventDefault();
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 13:54:38
 * @Desc: This function inciate the calendar in the proyect and show all the data to the users
 */
async function calendarSinci() {

    inLoader();
    /**
     * This Fetch petition obtain the calendar events registerd for the login user
     */
    let dataEvents = [];

    let dataDB = await fetch(urlData + "/obtainEventsCalendar?isLogedIn=" + dataLogin()).then(data => data.json()).then(data => { return data; }).catch(() => { IsLogedIn(); });
    dataEvents = eventsCalendar(dataDB);

    /*  className colors
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
    */

    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });

    /* initialize the calendar
    -----------------------------------------------------------------*/

    calendar = $('#calendar').fullCalendar({
        header: {
            left: 'title',
            // center: 'agendaDay,agendaWeek,month today',
            right: 'today agendaDay,agendaWeek,month prev,next'
        },
        editable: true,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: true,
        defaultView: 'month',

        axisFormat: 'H:mm',
        columnFormat: {
            month: 'ddd', // Mon
            week: 'ddd d', // Mon 7
            day: 'dddd M/d', // Monday 9/7
            agendaDay: 'dddd d'
        },
        titleFormat: {
            month: 'MMMM yyyy', // September 2009
            week: "MMMM yyyy", // September 2009
            day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: true,
        select: function(start, end, allDay) {

            /**
             * Carlos Omar Anaya Barajas
             * the form of obtain the title of the event will changue ahead, this elment will be changed with a modal to obtain the information
             */

            $('.selectpicker').val('');
            $('.selectpicker').selectpicker('refresh');

            idEventUpdate = null;
            updateEvent = false;

            let todayDate = new Date();

            var numberOfMlSeconds = todayDate.getTime();
            var addMlSeconds = (1 * 60) * 60000;
            todayDate = new Date(numberOfMlSeconds + addMlSeconds);

            // Function to obtaind the data from the modal
            if (start <= todayDate) {

                $("#dataEvent")[0].reset();

                let today = start.getFullYear() + "-" + (start.getMonth() < 9 ? "0" + (start.getMonth() + 1) : start.getMonth() + 1) + "-" + (start.getDate() < 10 ? "0" + (start.getDate()) : start.getDate());
                let Hours = (start.getHours() < 10 ? "0" + start.getHours() : start.getHours()) + ":" + (start.getMinutes() < 10 ? "0" + start.getMinutes() : start.getMinutes());
                today += Hours == "00:00" ? " 08" + ":" + "30" : " " + Hours;

                let todayEnd = end.getFullYear() + "-" + (end.getMonth() < 9 ? "0" + (end.getMonth() + 1) : end.getMonth() + 1) + "-" + (end.getDate() < 10 ? "0" + (end.getDate()) : start.getDate());
                Hours = (end.getHours() < 10 ? "0" + end.getHours() : end.getHours()) + ":" + (end.getMinutes() < 10 ? "0" + end.getMinutes() : end.getMinutes());
                todayEnd += Hours == "00:00" ? " 09" + ":" + "30" : " " + Hours;

                $('#startDate').val(today);
                $('#endDate').val(todayEnd);

                $('#btnDeleteEvent').addClass('btnDeleteNone');

                $('#createEventCalendar').modal('show');
            }

            // END
        },
        droppable: false, // this allows things to be dropped into the calendar !!!

        events: dataEvents,
    });

    $('.fc-button.fc-button-agendaWeek').click();

    if ("ontouchstart" in window || navigator.msMaxTouchPoints) {

        $('#calendar .fc-header .fc-header-right .fc-button-agendaDay').html("D");
        $('#calendar .fc-header .fc-header-right .fc-button-agendaWeek').text("S");
        $('#calendar .fc-header .fc-header-right .fc-button-month').text("M");

        $('.asignar_a select').remove();
        $('.asignar_a .dropdown.bootstrap-select.form-control').remove();
        $('.asignar_a label').after("<select id='slctAsignar' name='slctAsignar' class='form-select'><option value = ''> Seleccione una opción < /option></select>");

        // $('.fc-button.fc-button-agendaDay').click();
    }

    modalCalendarSinci();
    iniciateModalUpdate();
    outLoader();
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-15 10:36:04
 * @Desc:
 */

let eventsCalendar = (dataDB) => {

    let eventsToSend = [];

    let event;
    $.each(dataDB, function(index, value) {

        if (window.navigator.vendor == "Google Inc.") {
            value.FECHA_INICIO = value.FECHA_INICIO.replace('T', ' ');
            value.FECHA_INICIO = value.FECHA_INICIO.replace('Z', ' ');
            value.FECHA_FIN = value.FECHA_FIN.replace('T', ' ');
            value.FECHA_FIN = value.FECHA_FIN.replace('Z', ' ');

            value.Hora_inicio = value.Hora_inicio.replace('T', ' ');
            value.Hora_inicio = value.Hora_inicio.replace('Z', ' ');
            value.Hora_fin = value.Hora_fin.replace('T', ' ');
            value.Hora_fin = value.Hora_fin.replace('Z', ' ');
        } else {

            let sD = new Date(value.FECHA_INICIO);
            let eD = new Date(value.FECHA_FIN);
            value.FECHA_INICIO = sD.setTime(sD.getTime() + sD.getTimezoneOffset() * 60 * 1000);
            value.FECHA_FIN = eD.setTime(eD.getTime() + eD.getTimezoneOffset() * 60 * 1000);

            let sH = new Date(value.Hora_inicio);
            let eH = new Date(value.Hora_fin);
            value.Hora_inicio = sH.setTime(sH.getTime() + sH.getTimezoneOffset() * 60 * 1000);
            value.Hora_fin = eH.setTime(eH.getTime() + eH.getTimezoneOffset() * 60 * 1000);
        }

        var startDate = new Date(value.FECHA_INICIO);
        var sDay = startDate.getDate();
        var sMonth = startDate.getMonth();
        var sYear = startDate.getFullYear();

        var startHour = new Date(value.Hora_inicio);
        var horaInicio = (startHour.getHours() < 10 ? "0" + startHour.getHours() : startHour.getHours());
        var minutosInicio = (startHour.getMinutes() < 10 ? "0" + startHour.getMinutes() : startHour.getMinutes());

        var endDate = new Date(value.FECHA_FIN);
        var eDay = endDate.getDate();
        var eMonth = startDate.getMonth();
        var eYear = endDate.getFullYear();

        var endHour = new Date(value.Hora_fin);
        var HoraFin = (endHour.getHours() < 10 ? "0" + endHour.getHours() : endHour.getHours());
        var minutosFin = (endHour.getMinutes() < 10 ? "0" * endHour.getMinutes() : endHour.getMinutes());

        let titleBtcr = "";
        if ("ontouchstart" in window || navigator.msMaxTouchPoints) {

            let proyectCode = value.LOCATION.split("(");
            titleBtcr = proyectCode[0];
        } else {

            titleBtcr = value.LOCATION
        }

        event = {
            id: value.ID_PROYECTOS_AVANCE,
            title: titleBtcr,
            body: "-- ".repeat(13) + "\n" + value.NOTAS,
            start: new Date(sYear, sMonth, sDay, horaInicio, minutosInicio),
            end: new Date(eYear, eMonth, eDay, HoraFin, minutosFin),
            allDay: false,
            // className: 'sinci',
            className: 'info',
            editable: false,
        };

        eventsToSend.push(event);
    });

    return eventsToSend;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-03-03 13:55:50
 * @Desc: Here the selects was inciated with the information required to dd the registers
 */

async function modalCalendarSinci() {

    let dl = dataLogin();

    // await fetch(urlData + "/obtainDataProyecto?isLogedIn=" + dl).then(data => data.json()).then(dataProyecto => { processDataToSelect(dataProyecto, '#slctProyecto'); }).catch(() => { IsLogedIn(); });
    // await fetch(urlData + "/obtainDataUser?isLogedIn=" + dl).then(data => data.json()).then(dataUsuario => { processDataToSelect(dataUsuario, '#slctUsuario'); }).catch(() => { IsLogedIn(); });
    // await fetch(urlData + "/obtainDataAsignar?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { processDataToSelect(dataAsignar, '#slctAsignar'); }).catch(() => { IsLogedIn(); });

    let dataUsuario = await fetch(urlData + "/obtainDataUser?isLogedIn=" + dl).then(data => data.json()).then(dataUsuario => { return dataUsuario }).catch(() => { IsLogedIn(); });
    processDataToSelect(dataUsuario, '#slctUsuario');

    let dataProyecto = await fetch(urlData + "/obtainDataProyecto?isLogedIn=" + dl).then(data => data.json()).then(dataProyecto => { return dataProyecto }).catch(() => { IsLogedIn(); });
    processDataToSelect(dataProyecto, '#slctProyecto');

    let dataAsignar = await fetch(urlData + "/obtainDataAsignar?isLogedIn=" + dl).then(data => data.json()).then(dataAsignar => { return dataAsignar }).catch(() => { IsLogedIn(); });
    processDataToSelect(dataAsignar, '#slctAsignar');

    $('.selectpicker').selectpicker('refresh');
}

function processDataToSelect(data, select) {

    let options = "";

    if (data.length == 1) {
        $('#slctUsuario').remove();
        let select = '<label id="lblUsuario" for="recipient-name" class="col-form-label">Usuario:</label> <select class="form-select" name="slctUsuario" id="slctUsuario">';
        $('#divUsuarios').html(select);
    }

    $(select).empty();
    data.length > 1 ? options = "<option value=''>Seleccione una opción</option>" : null;
    $.each(data, function(index, value) {

        options += '<option value="' + value.VALUE_SELECT + '">' + value.OPTION_SELECT + '</option>';
    });

    $(select).append(options);
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-02-22 11:11:51
 * @Desc: This function obtain the week number
 */
function getWeekNumber(d) {

    // Copy date so don't modify original
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    // Set to nearest Thursday: current date + 4 - current day number
    // Make Sunday's day number 7
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
    // Get first day of year
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    // Calculate full weeks to nearest Thursday
    var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    // Return array of year and week number
    return weekNo;
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-02-22 11:11:18
 * @Desc:  This unction display the week number in the calendar
 */

function showWeeksNumbers(weekNumber, isWeek, isDay, dayNum = 0) {

    let howWeek = "";

    if ("ontouchstart" in window || navigator.msMaxTouchPoints)
        howWeek = "S";

    else
        howWeek = "Semana ";

    $('#calendar .fc-header .fc-header-center').text('');

    $('#calendar .fc-content .fc-view-month table .fc-week').each(function(index) {

        let html = "";

        if (weekNumber == 52) {
            html = '<div class="weekNumber"> ' + howWeek + weekNumber + '</div>';
            weekNumber = 0;
        }

        weekNumber++;
        html = '<div class="weekNumber"> ' + howWeek + weekNumber + '</div>';

        $(this.firstChild.firstChild.firstChild).after(html);
    });

    if ("ontouchstart" in window || navigator.msMaxTouchPoints) {

        isWeek ? $('#calendar .fc-content .fc-agenda-days thead .fc-first .fc-agenda-axis').html("<h6 style='color: #344767;'>S-" + (weekNumber < 52 ? (weekNumber + 1) : 1) + "</h6>") : null;
        isDay ? $('#calendar .fc-content .fc-agenda-days thead .fc-first .fc-agenda-axis').html("<h6 style='color: #344767;'>S-" + (weekNumber < 52 ? ((dayNum == 0 || dayNum == 1) ? weekNumber + 1 : weekNumber) : 1) + "</h6>") : null;
        $('#calendar .fc-content .fc-agenda-days .fc-first .fc-agenda-axis').css("text-align", "center")
    } else {

        isWeek ? $('#calendar .fc-header .fc-header-center').html("<p style='font-size: 21px; font-weight: 500; margin:-5px 0 0 0; color: #344767;'>Semana " + (weekNumber < 52 ? (weekNumber + 1) : 1) + "</p>") : null;
        // isDay ? $('#calendar .fc-header .fc-header-center').html("<p style='font-size: 21px; font-weight: 500; margin:-5px 0 0 0; color: #344767;'>Semana " + (weekNumber < 52 ? ((dayNum == 0 || dayNum == 1) ? weekNumber + 1 : weekNumber) : 1) + "</p>") : null;
        isDay ? $('#calendar .fc-header .fc-header-center').html("<p style='font-size: 21px; font-weight: 500; margin:-5px 0 0 0; color: #344767;'>Semana " + (weekNumber < 52 ? (weekNumber + 1) : 1) + "</p>") : null;
    }
}

function buttonsNav(defaultView) {

    iniciateModalUpdate();

    let isWeek = false;
    let isDay = false;

    let months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    let headerMonth = $('#calendar .fc-header .fc-header-left .fc-header-title').text().split(' ');
    let year = headerMonth[1];

    let date;
    let day;
    let dayDate;
    let dayNum;

    try {

        date = $('#calendar .fc-content .fc-view-month table .fc-week.fc-first .fc-first')[0].dataset['date'];

    } catch (error) {

        let monthNum;
        $.each(months, function(index, value) {

            if (headerMonth[0] == value) {

                if (index < 9) {
                    monthNum = "0" + (index + 1);
                } else {
                    monthNum = index + 1;
                }
            }
        });

        try {

            day = $('#calendar .fc-content .fc-view-agendaWeek table .fc-first .fc-sun').text().split(' ')[1].replace(/\s+/g, '');
            date = year + "-" + monthNum + "-" + day;
            isWeek = true;

        } catch (error) {

            day = $('#calendar .fc-content .fc-view-agendaDay table .fc-first .fc-widget-header').text().split(' ')[1].replace(/\s+/g, '');

            dayDate = new Date(year + "-" + monthNum + "-" + day);
            dayDate = day >= 10 ? new Date(dayDate.setDate(dayDate.getDate() + 1)) : dayDate;
            dayNum = dayDate.getDay();
            let newDate = new Date(dayDate.setDate(dayDate.getDate() - dayNum));
            isDay = true;

            date = year + "-" + (newDate.getMonth() + 1) + "-" + newDate.getDate();
        }
    }

    let weekNumber = getWeekNumber(new Date(date));
    showWeeksNumbers(weekNumber, isWeek, isDay, dayNum);
}

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-01-12 17:31:20
 * @Desc:  This funciton iniciate the modal to update the data in the calendar
 */

function iniciateModalUpdate() {

    $('.fc-content .fc-event-container .fc-event .fc-event-inner').click(function() {

        inLoader()

        $("#dataEvent")[0].reset();

        idEventUpdate = this.lastChild.lastChild.textContent;

        $.ajax({
            type: "GET",
            url: urlData + "/obtainEventsCalendarById",
            data: { "idEvent": idEventUpdate, "isLogedIn": dataLogin() },
            success: function(response) {

                response = JSON.parse(response)[0];

                if (window.navigator.vendor == "Google Inc.") {
                    response.FECHA_INICIO = response.FECHA_INICIO.replace('T', ' ');
                    response.FECHA_INICIO = response.FECHA_INICIO.replace('Z', ' ');
                    response.FECHA_FIN = response.FECHA_FIN.replace('T', ' ');
                    response.FECHA_FIN = response.FECHA_FIN.replace('Z', ' ');

                    response.Hora_inicio = response.Hora_inicio.replace('T', ' ');
                    response.Hora_inicio = response.Hora_inicio.replace('Z', ' ');
                    response.Hora_fin = response.Hora_fin.replace('T', ' ');
                    response.Hora_fin = response.Hora_fin.replace('Z', ' ');
                } else {

                    let sD = new Date(response.FECHA_INICIO);
                    let eD = new Date(response.FECHA_FIN);
                    response.FECHA_INICIO = sD.setTime(sD.getTime() + sD.getTimezoneOffset() * 60 * 1000);
                    response.FECHA_FIN = eD.setTime(eD.getTime() + eD.getTimezoneOffset() * 60 * 1000);

                    let sH = new Date(response.Hora_inicio);
                    let eH = new Date(response.Hora_fin);
                    response.Hora_inicio = sH.setTime(sH.getTime() + sH.getTimezoneOffset() * 60 * 1000);
                    response.Hora_fin = eH.setTime(eH.getTime() + eH.getTimezoneOffset() * 60 * 1000);
                }

                var startDate = new Date(response.FECHA_INICIO);
                var sDay = startDate.getDate() - 1;
                var sMonth = startDate.getMonth();
                var sYear = startDate.getFullYear();

                var startHour = new Date(response.Hora_inicio);
                var sHoraInicio = (startHour.getHours() < 10 ? "0" + startHour.getHours() : startHour.getHours()) + ":" + (startHour.getMinutes() < 10 ? "0" + startHour.getMinutes() : startHour.getMinutes());

                var endDate = new Date(response.FECHA_FIN);
                var eDay = endDate.getDate() - 1;
                var eMonth = startDate.getMonth();
                var eYear = endDate.getFullYear();

                var endHour = new Date(response.Hora_fin);
                var sHoraFin = (endHour.getHours() < 10 ? "0" + endHour.getHours() : endHour.getHours()) + ":" + (endHour.getMinutes() < 10 ? "0" + endHour.getMinutes() : endHour.getMinutes());

                $('#message-text').val(response.NOTAS);
                $('#slctProyecto').val(response.ID_PROYECTO);
                $('#slctUsuario').val(response.ID_PERSONAL);

                $('#startDate').val(sYear + "-" + (sMonth < 9 ? "0" + (sMonth + 1) : sMonth + 1) + "-" + ((sDay + 1) < 10 ? "0" + (sDay + 1) : sDay + 1) + " " + sHoraInicio);
                $('#endDate').val(eYear + "-" + (eMonth < 9 ? "0" + (eMonth + 1) : eMonth + 1) + "-" + ((eDay + 1) < 10 ? "0" + (eDay + 1) : eDay + 1) + " " + sHoraFin);

                $('#slctTipo').val(response.TIPO);
                $('#slctAsignar').val(response.TIPO_RESUMEN);

                $('.selectpicker').selectpicker('refresh');

                outLoader();
            },
            error: function(exception) {

                showMessage('danger', 'Error', exception.statusCode.name + " - " + exception.statusText);
                resetcalendar();
            }
        });

        updateEvent = true;
        $('#btnDeleteEvent').removeClass('btnDeleteNone')
        $('#createEventCalendar').modal('show');

        $(this).parent().addClass('removeEvent');
    });
}

/**
 * Queda pendiente el poder agregar la informcion sin tener que recargar la pagina para ello utilizando la funcion de select en el fullcalendar.
 */

$('#btnSaveEvent').click(function() {

    // setTimeout(() => {

    //     outLoader();
    //     showMessage('danger', 'Error', "Ocurrio un error al tratar de guardar la información, \n por favor realize otro intento");
    // }, 12000);

    $('#slctUsuario').attr('disabled', false);
    let urlEvent = "";
    var event = $('#dataEvent').serializeArray();
    let datesChecked = checkDateToSave(event[3].value, event[4].value);

    if (validateModal(event)) {
        return false;
    } else if (datesChecked[0]) {

        showMessage('danger', 'Error', datesChecked[1]);
        return false
    }

    event.push({ name: "usuarioNombre", value: $("#slctUsuario option:selected").text() });
    event.push({ name: "totalHoras", value: calculeTotalTime(event[3].value, event[4].value) });
    event.push({ name: "idEvent", value: idEventUpdate });
    event.push({ name: "isLogedIn", value: dataLogin() });

    let message = "";
    if (updateEvent) {

        urlEvent = urlData + "/updateDataFromCalendar";
        message = "Información actualizada exitosamente";
    } else {

        urlEvent = urlData + "/saveDataFromCalendar";
        message = "Información guardada exitosamente ";
    }

    inLoader();

    $.ajax({
        type: "POST",
        url: urlEvent,
        data: event,
        success: function(response) {

            outLoader();

            response = JSON.parse(response)[0];

            if (response.cantSaveData == "true") {

                showMessage('danger', 'Error', "Error ya existe registros en el rango de horas seleccionadas, favor de revisar la información a registrar");
                showEvent();

                return false;
            }

            $('.fc-event.fc-event-vert.fc-event-start.fc-event-end.info.removeEvent').remove();

            $('#createEventCalendar').modal('hide');
            $('#btnDeleteEvent').addClass('btnDeleteNone');

            showMessage('success', 'Mensaje', message);

            if (!updateEvent) {

                let eventSaved = eventsCalendar([response])[0];

                calendar.fullCalendar('renderEvent',
                    eventSaved,
                    true // make the event "stick"
                );
            } else {

                // calendar.fullCalendar('renderEvent',
                //     eventSaved,
                //     true // make the event "stick"
                // );

                resetcalendar();
            }

            idEventUpdate = null;
            updateEvent = false;

            iniciateModalUpdate();
        },
        error: function(exception) {

            outLoader();

            let messageError = "Ocurrió un error al momento de guardar el registro, intente de nuevo a guardar la información";

            idEventUpdate = null;
            updateEvent = false;

            showMessage('danger', 'Error', messageError);
        }
    });
});

/**
 * javascript comment
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-02-04 23:44:05
 * @Desc:  Delete Information from the database
 */

$('#btnDeleteEvent').click(function() {

    $("#mi-modal .modal-header h4").text("Confirmar Eliminación");
    $("#mi-modal .modal-body").html("<p>Está a punto de eliminar este registro, al hacerlo la información se perderá y no podrá ser recuperada.</p><p>¿Desea continuar con la eliminación?</p>");
    $("#mi-modal").modal('show');

    modalConfirm(function(confirm) {
        if (confirm) {

            inLoader();

            $.ajax({
                type: "POST",
                url: urlData + "/deleteInformation",
                data: { idEvent: idEventUpdate, "isLogedIn": dataLogin() },
                success: function(response) {

                    response = JSON.parse(response)[0];

                    idEventUpdate = null;
                    updateEvent = false;

                    $('#createEventCalendar').modal('hide');

                    outLoader();
                    showMessage('success', 'Exito', 'Información borrada');
                },
                error: function(exception) {

                    showEvent();
                    outLoader();

                    let messageError = "Ocurrió un error, la pagina se reiniciará para actualizarse.";

                    idEventUpdate = null;
                    updateEvent = false;

                    // showMessage('danger', 'Error', exception.statusCode.name + " - " + exception.statusText);
                    showMessage('danger', 'Error', messageError);

                    setTimeout(() => {
                        resetcalendar();
                    }, 2500);
                }
            });
        } else {
            //Acciones si el usuario no confirma
            console.log(confirm);
        }
    });
});

/**
 * Function to validatre the dates of the proyect
 * @Author: Carlos Omar Anaya Barajas
 * @Date: 2022-02-04 18:07:05
 * @Desc:
 */

function checkDateToSave(start, end) {

    start = new Date(start);
    end = new Date(end);

    let isValidate = false;
    let message = "";

    let todayDate = new Date();

    var numberOfMlSeconds = todayDate.getTime();
    var addMlSeconds = (1 * 60) * 60000;
    todayDate = new Date(numberOfMlSeconds + addMlSeconds);

    if (start > end) {
        isValidate = true;
        message = "La fecha inicial no puede ser mayor a la fecha final";
    } else if (start > todayDate) {
        isValidate = true;
        message = "La fecha inicial no puede ser mayor a la fecha actual";
    } else if (end > todayDate) {
        isValidate = true;
        // message = "La fecha final no puede ser mayor a la fecha actual";
        message = "Esta tratando de registrar una fecha mayor a la actual, o en horas mayores a la hora actual";
    }

    return [isValidate, message];
}

/**
 * Funtion to obtain the hours between 2 dates
 * @Author: Anaya Barajas Carlos Omar
 * @Date: 2022-01-12 10:46:05
 * @Desc: NA
 */ //

function calculeTotalTime(D1, D2) {

    D1 = D1.split(" ");
    D2 = D2.split(" ");

    let Date1 = D1[0];
    let Date2 = D2[0];

    var st = D1[1];
    var et = D2[1];

    var rd = 0;
    var cd = 0;
    var dd = 1;

    Date1 = Date1.split("-");
    rd = Date1[2];
    Date1 = Date1[0] + "-" + Date1[1] + "-" + Date1[2];
    Date1 = new Date(Date1);
    Date1.setDate(Date1.getDate() + 1);

    Date2 = Date2.split("-");
    cd = Date2[2];
    Date2 = Date2[0] + "-" + Date2[1] + "-" + Date2[2];
    Date2 = new Date(Date2);
    Date2.setDate(Date2.getDate() + 1);

    dd = ((parseInt(cd) - parseInt(rd)) * 24);

    Date1 = Date.parse(Date1) / 1000;
    Date2 = Date.parse(Date2) / 1000;

    st = st.split(':');
    et = et.split(':');

    if (Date1 < Date2)
        et[0] = parseInt(et[0]) + parseInt(dd);

    var tt_h = parseInt(et[0]) - parseInt(st[0]);
    var tt_m = 0;

    if (parseInt(et[1]) < parseInt(st[1]) && tt_h > 0) {

        tt_h -= 1;
        tt_m = (parseInt(et[1]) + 60) - parseInt(st[1]);

    } else
        tt_m = parseInt(et[1]) - parseInt(st[1])

    return tt_h;
}

function validateModal(event) {

    let validate = false;

    $.each(event, function(index, value) {

        if (value.value == '' || value.value == '-1') {

            if (value.name == 'slctProyecto')
                $("#slctProyecto+.btn.dropdown-toggle").addClass('requiredNull');

            else if (value.name == 'slctAsignar')
                $("#slctAsignar+.btn.dropdown-toggle").addClass('requiredNull');

            $("[name='" + value.name + "']").addClass('requiredNull');

            showMessage('danger', 'Error', "Favor de llenar los datos faltantes");
            validate = true;
        }
    });

    clearTimeout();

    setTimeout(() => {
        $(".form-control").removeClass('requiredNull');
        $(".form-select").removeClass('requiredNull');
        $(".btn.dropdown-toggle").removeClass('requiredNull');
    }, 7000);

    return validate;
}

$('.btnCancelModal').click(function() {
    showEvent();
})

let showEvent = () => {
    $('.fc-event.fc-event-vert.fc-event-start.fc-event-end.info.removeEvent').removeClass('removeEvent');
}

let resetcalendar = () => {

    calendar = "";
    $('#calendar').empty();
    calendarSinci();
}
