var updateEvent = false;

// var urlData = "//localhost:1880";
var urlData = "//10.10.103.206:1880"; // Servidor de Pruebas
// var urlData = "//10.10.102.112:1880"; // Servidor de Produccion
// var urlData = window.location.href.split("/")[2];

var idEventUpdate;

var isAdmin;
var userId;

$(document).ready(function() {

    isAdmin = window.localStorage.getItem('isAdmin');
    userId = window.localStorage.getItem('idUser');

    calendarSinci();
});

async function calendarSinci() {

    let dataEvents = [];

    /**
     * This Fetch petition obtain the calendar events registerd for the login user
     */
    let dataDB;
    if (isAdmin == 0) {
        dataDB = await fetch(urlData + "/obtainUserEventsCalendarById?userId=" + userId).then(data => data.json()).then(data => { return data; });
    } else {
        dataDB = await fetch(urlData + "/obtainEventsCalendar").then(data => data.json()).then(data => { return data; });
    }
    // let dataDB = await fetch(urlData + "/obtainEventsCalendar").then(data => data.json()).then(data => { return data; });

    let event;
    $.each(dataDB, function(index, value) {

        value.FECHA_INICIO = value.FECHA_INICIO.replace('T', ' ');
        value.FECHA_INICIO = value.FECHA_INICIO.replace('Z', ' ');
        value.FECHA_FIN = value.FECHA_FIN.replace('T', ' ');
        value.FECHA_FIN = value.FECHA_FIN.replace('Z', ' ');

        value.Hora_inicio = value.Hora_inicio.replace('T', ' ');
        value.Hora_inicio = value.Hora_inicio.replace('Z', ' ');
        value.Hora_fin = value.Hora_fin.replace('T', ' ');
        value.Hora_fin = value.Hora_fin.replace('Z', ' ');

        var startDate = new Date(value.FECHA_INICIO);
        var sDay = startDate.getDate();
        var sMonth = startDate.getMonth();
        var sYear = startDate.getFullYear();

        var startHour = new Date(value.Hora_inicio);
        var horaInicio = (startHour.getHours() < 10 ? "0" + startHour.getHours() : startHour.getHours());
        var mMinutosInicio = (startHour.getMinutes() < 10 ? "0" + startHour.getMinutes() : startHour.getMinutes());

        var endDate = new Date(value.FECHA_FIN);
        var eDay = endDate.getDate();
        var eMonth = startDate.getMonth();
        var eYear = endDate.getFullYear();

        var endHour = new Date(value.Hora_fin);
        var HoraFin = (endHour.getHours() < 10 ? "0" + endHour.getHours() : endHour.getHours());
        var minutosFin = (endHour.getMinutes() < 10 ? "0" * endHour.getMinutes() : endHour.getMinutes());

        // let titleHTML = value.LOCATION + "<hr>" + value.NOTAS;

        event = {
            id: value.ID_PROYECTOS_AVANCE,
            title: value.LOCATION + "\n -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- \n " + value.NOTAS,
            start: new Date(sYear, sMonth, sDay, horaInicio, mMinutosInicio),
            end: new Date(eYear, eMonth, eDay, HoraFin, minutosFin),
            allDay: false,
            className: 'info',
            editable: false,
        };

        dataEvents.push(event);
    });
    // END

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

        axisFormat: 'h:mm',
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

            let todayDate = new Date();

            // Function to obtaind the data from the modal
            if (start <= todayDate) {

                $("#dataEvent")[0].reset();
                // $('.modalForm').prop("disabled", false);

                let date = new Date();

                let today = start.getFullYear() + "-" + (start.getMonth() < 9 ? "0" + (start.getMonth() + 1) : start.getMonth() + 1) + "-" + (start.getDate() < 10 ? "0" + (start.getDate()) : start.getDate());
                // today += " " + (start.getHours() < 10 ? "0" + start.getHours() : start.getHours()) + ":" + (start.getMinutes() < 10 ? "0" + start.getMinutes() : start.getMinutes());
                today += " " + start.getHours() + 8 + ":" + "30";

                $('.datetimepicker').val(today);

                if (isAdmin == 0) {

                    $('#slctUsuario').attr('disabled', true);
                    $('#slctUsuario').val(userId);
                }

                $('#createEventCalendar').modal('show');
            }

            // END

            // var title = prompt('Event Title:');

            // // if (title) {
            // calendar.fullCalendar('renderEvent', {
            //         title: title,
            //         start: start,
            //         end: end,
            //         allDay: allDay
            //     },
            //     true // make the event "stick"
            // );
            // }
            // calendar.fullCalendar('unselect');
        },
        droppable: false, // this allows things to be dropped onto the calendar !!!
        // drop: function(date, allDay) { // this function is called when something is dropped

        //     // retrieve the dropped element's stored Event Object
        //     var originalEventObject = $(this).data('eventObject');

        //     // we need to copy it, so that multiple events don't have a reference to the same object
        //     var copiedEventObject = $.extend({}, originalEventObject);

        //     // assign it the date that was reported
        //     copiedEventObject.start = date;
        //     copiedEventObject.allDay = allDay;

        //     // render the event on the calendar
        //     // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        //     $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        //     // is the "remove after drop" checkbox checked?
        //     if ($('#drop-remove').is(':checked')) {
        //         // if so, remove the element from the "Draggable Events" list
        //         $(this).remove();
        //     }

        // },

        events: dataEvents,
    });

    modalCalendarSinci();
    iniciateModalUpdate();
}

async function modalCalendarSinci() {

    // let allData = await fetch(urlData + "/obtainDataForModalCalendar").then(data => data.json()).then(data => { return data; });
    // processDataToSelect(allData);

    let dataProyecto = await fetch(urlData + "/obtainDataProyecto").then(data => data.json()).then(data => { return data; });
    processDataToSelect(dataProyecto, '#slctProyecto');

    let dataUsuario
    if (isAdmin == 0) {

        dataUsuario = await fetch(urlData + "/obtainDataUserById?userId=" + userId).then(data => data.json()).then(data => { return data; });
        processDataToSelect(dataUsuario, '#slctUsuario', false);
    } else {

        dataUsuario = await fetch(urlData + "/obtainDataUser").then(data => data.json()).then(data => { return data; });
        processDataToSelect(dataUsuario, '#slctUsuario');
    }

    // let dataTipo = await fetch(urlData + "/obtainDataTipo").then(data => data.json()).then(data => { return data; });
    // processDataToSelect(dataTipo, '#slctTipo');

    let dataAsignar = await fetch(urlData + "/obtainDataAsignar").then(data => data.json()).then(data => { return data; });
    processDataToSelect(dataAsignar, '#slctAsignar');
}

function processDataToSelect(data, select, firstOption = true) {

    let options = "";

    $(select).empty();
    firstOption ? options = "<option value=''>Seleccione opcion</option>" : null;
    $.each(data, function(index, value) {

        options += '<option value="' + value.VALUE_SELECT + '">' + value.OPTION_SELECT + '</option>';
    });

    $(select).append(options);
}

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

function showWeeksNumbers(weekNumber) {

    $('#calendar .fc-content .fc-view-month table .fc-week').each(function(index) {

        let html = "";

        if (weekNumber == 52) {
            html = '<div class="weekNumber">Semana ' + weekNumber + '</div>';
            weekNumber = 0;
        }

        weekNumber++;
        html = '<div class="weekNumber">Semana ' + weekNumber + '</div>';

        $(this.firstChild.firstChild.firstChild).after(html);
    });
}

function buttonsNav(defaultView) {

    iniciateModalUpdate();

    let date;

    if (defaultView == "month") {

        date = $('#calendar .fc-content .fc-view-month table .fc-week.fc-first .fc-first')[0].dataset['date'];
    } else {

        date = null;
    }

    let weekNumber = getWeekNumber(new Date(date));
    showWeeksNumbers(weekNumber);
}

/** 
 * javascript comment 
 * @Author: flydreame 
 * @Date: 2022-01-12 17:31:20 
 * @Desc:  
 */

function iniciateModalUpdate() {

    $('.fc-content .fc-event-container .fc-event .fc-event-inner').click(function() {

        idEventUpdate = this.lastChild.lastChild.textContent;

        $.ajax({
            type: "GET",
            url: urlData + "/obtainEventsCalendarById",
            data: { "idEvent": idEventUpdate },
            success: function(response) {
                // console.log(response);

                response = response[0];


                response.FECHA_INICIO = response.FECHA_INICIO.replace('T', ' ');
                response.FECHA_INICIO = response.FECHA_INICIO.replace('Z', ' ');
                response.FECHA_FIN = response.FECHA_FIN.replace('T', ' ');
                response.FECHA_FIN = response.FECHA_FIN.replace('Z', ' ');

                response.Hora_inicio = response.Hora_inicio.replace('T', ' ');
                response.Hora_inicio = response.Hora_inicio.replace('Z', ' ');
                response.Hora_fin = response.Hora_fin.replace('T', ' ');
                response.Hora_fin = response.Hora_fin.replace('Z', ' ');

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
                var sHoraFin = (endHour.getHours() < 10 ? "0" + endHour.getHours() : endHour.getHours()) + ":" + (endHour.getMinutes() < 10 ? "0" * endHour.getMinutes() : endHour.getMinutes());

                $('#message-text').val(response.NOTAS);
                $('#slctProyecto').val(response.ID_PROYECTO);
                $('#slctUsuario').val(response.ID_PERSONAL);

                $('#startDate').val(sYear + "-" + (sMonth < 9 ? "0" + (sMonth + 1) : sMonth + 1) + "-" + (sDay < 10 ? "0" + (sDay + 1) : sDay + 1) + " " + sHoraInicio);
                $('#endDate').val(eYear + "-" + (eMonth < 9 ? "0" + (eMonth + 1) : eMonth + 1) + "-" + (eDay < 10 ? "0" + (eDay + 1) : eDay + 1) + " " + sHoraFin);

                $('#slctTipo').val(response.TIPO);
                $('#slctAsignar').val(response.TIPO_RESUMEN);

                // $('.modalForm').prop("disabled", true);
            },
            error: function(exception) {

                console.log(exception);
            }
        });

        if (isAdmin == 0) {

            $('#slctUsuario').attr('disabled', true);
            $('#slctUsuario').val(userId);
        }

        updateEvent = true;
        $('#createEventCalendar').modal('show');
    });
}

/**
 * Queda pendiente el poder agregar la informcion sin tener que recargar la pagina para ello utilizando la funcion de select en el fullcalendar.
 */

$('#btnSaveEvent').click(function() {

    $('#slctUsuario').attr('disabled', false);

    let urlEvent = "";

    var event = $('#dataEvent').serializeArray();

    if (validateModal(event)) {

        return false;
    }

    event.push({ name: "usuarioNombre", value: $("#slctUsuario option:selected").text() });
    event.push({ name: "totalHoras", value: calculeTotalTime(event[3].value, event[4].value) });
    event.push({ name: "idEvent", value: idEventUpdate });

    if (updateEvent)
        urlEvent = urlData + "/updateDataFromCalendar";
    else
        urlEvent = urlData + "/saveDataFromCalendar";

    $.ajax({
        type: "POST",
        url: urlEvent,
        data: event,
        success: function(response) {
            // console.log(response);

            idEventUpdate = null;
            updateEvent = false;

            $('.modal').modal('hide');

            /**
             * This block of code is temporal, the register of the event changues ahead to not refresh the page completly
             */
            var timeout = 1000;

            setTimeout(() => {
                window.location.reload();
            }, timeout);
        },
        error: function(exception) {

            idEventUpdate = null;
            updateEvent = false;

            console.log(exception);
        }
    }).done(function() {
        $("#dataEvent")[0].reset();
    });
});

/**
 * This function close the modals
 */

$(".modal .modal-dialog .modal-header .close").click(function() {

    $('.modal').modal('hide');
    $("#dataEvent")[0].reset();
});

$('.btnCancelModal').click(function() {

    $('.modal').modal('hide');
    $("#dataEvent")[0].reset();
});

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

        if (value.value == '') {

            $("[name='" + value.name + "']").addClass('requiredNull');
            $(".invalidRequired").removeClass('hidden');
            validate = true;
        }
    });

    setTimeout(() => {
        $(".form-control").removeClass('requiredNull');
        $(".form-select").removeClass('requiredNull');
        $(".invalidRequired").addClass('hidden');
    }, 8000);

    return validate;
}