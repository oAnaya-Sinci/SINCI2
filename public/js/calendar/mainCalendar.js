var updateEvent = false;

$(document).ready(function() {

    calendarSinci();

    $('.datetimepicker').datetimepicker({
        // Formats
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
        }
    });
});

async function calendarSinci() {

    let dataEvents = [];

    /**
     * This Fetch petition obtain the calendar events registerd for the login user
     */
    let dataDB = await fetch("//localhost:1880/obtainEventsCalendar").then(data => data.json()).then(data => { return data; });

    let event;
    $.each(dataDB, function(index, value) {

        var startDate = new Date(value.FECHA_INICIO);
        var sDay = startDate.getDate();
        var sMonth = startDate.getMonth();
        var sYear = startDate.getFullYear();

        var endDate = new Date(value.FECHA_FIN);
        var eDay = endDate.getDate();
        var eMonth = startDate.getMonth();
        var eYear = endDate.getFullYear();

        event = {
            id: value.ID_PROYECTOS_AVANCE,
            title: value.LOCATION + " \n ------------------------------------------------- \n " + value.NOTAS,
            start: new Date(sYear, sMonth, sDay + 1, 12, 0),
            end: new Date(eYear, eMonth, eDay + 1, 15, 0),
            allDay: false,
            className: 'success',
            editable: true,
        };

        dataEvents.push(event);
    });
    // END

    /*  className colors
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
    */

    // var testFunc = async() => { return await fetch("//localhost:1880/obtainDataFromNodeRed").then(data => data.json()).then(data => { return data }); }

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

            // console.log(start);
            // console.log(todayDate);

            // Function to obtaind the data from the modal
            if (start <= todayDate)
                registerEventModal();

            // let event = registerEventModal();

            // END

            // var title = prompt('Event Title:');

            // var title;
            // bootbox.prompt("This is the default prompt!", function(result) {
            //     console.log(result);
            //     title = result;
            // });

            // // console.log(title);

            // var title = "Test Title for add Events"

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

    $('.fc-content .fc-event-container .fc-event-inner').click(function() {

        idEvent = { "idEvent": '148276' };

        $.ajax({
            type: "GET",
            url: "//localhost:1880/obtainEventsCalendarById",
            data: idEvent,
            success: function(response) {
                console.log(response);

            },
            error: function(exception) {

                console.log(exception);
            }
        });

        updateEvent = true;
        $('.modalForm').prop("disabled", true);

        registerEventModal();
    });

    modalCalendarSinci();
}

async function modalCalendarSinci() {

    // let allData = await fetch("//localhost:1880/obtainDataForModalCalendar").then(data => data.json()).then(data => { return data; });
    // processDataToSelect(allData);

    let dataProyecto = await fetch("//localhost:1880/obtainDataProyecto_test").then(data => data.json()).then(data => { return data; });
    processDataToSelect(dataProyecto, '#slctProyecto');

    let dataUsuario = await fetch("//localhost:1880/obtainDataUsuario_test").then(data => data.json()).then(data => { return data; });
    processDataToSelect(dataUsuario, '#slctUsuario');

    // let dataTipo = await fetch("//localhost:1880/obtainDataTipo_test").then(data => data.json()).then(data => { return data; });
    // processDataToSelect(dataTipo, '#slctTipo');

    let dataAsignar = await fetch("//localhost:1880/obtainDataAsignar_test").then(data => data.json()).then(data => { return data; });
    processDataToSelect(dataAsignar, '#slctAsignar');
}

function processDataToSelect(data, select) {

    let options = "";

    $(select).empty();
    options = "<option value0''>Seleccione opcion</option>";
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

    // console.log(defaultView);

    let date;

    if (defaultView == "month") {

        date = $('#calendar .fc-content .fc-view-month table .fc-week.fc-first .fc-first')[0].dataset['date'];
    } else {

        date = null;
    }

    let weekNumber = getWeekNumber(new Date(date));
    showWeeksNumbers(weekNumber);
}

function registerEventModal() {

    /**
     * Queda pendiente el poder agregar la informcion sin tener que recargar la pagina para ello utilizando la funcion de select en el fullcalendar.
     */

    let urlEvent = "";

    $('#createEventCalendar').modal('show');

    $('#btnSaveEvent').click(function() {

        var event = $('#dataEvent').serializeArray();

        // event = JSON.stringify(event);

        event.push({ name: "usuarioNombre", value: $("#slctUsuario option:selected").text() });

        // console.log(event);

        if (updateEvent) {
            urlEvent = "//localhost:1880/updateDataFromCalendar";
        } else {
            urlEvent = "//localhost:1880/saveDataFromCalendar";
        }

        $.ajax({
            type: "POST",
            url: urlEvent,
            data: event,
            success: function() {

                $('.modal').modal('hide');

                updateEvent = false;
                $('.modalForm').prop("disabled", false);

                /**
                 * This block of code is temporal, the register of the event changues ahead to not refresh the page completly
                 */
                var timeout = 1500;

                setTimeout(() => {
                    window.location.reload();
                }, timeout);
            },
            error: function(exception) {

                console.log(exception);
            }
        });
    });

    // return await [];
}

$('.fc-content .fc-event-container .fc-event-inner').click(function() {

    console.log("OMAR");
});

/**
 * This function close the modals
 */

$(".modal .modal-dialog .modal-header .close").click(function() {

    $('.modal').modal('hide');
});

$('.btnCancelModal').click(function() {

    $('.modal').modal('hide');
});

/**
 * This Functions are to test the promises results on the ajax or fetch petitions
 */

// async function testObtainDataNodeRed() {

//     const dataResponse = await $.ajax({
//         type: "GET",
//         url: "//localhost:1880/obtainEventsCalendar",
//         // success: function(response) {

//         //     dataResponse = response;
//         // },
//         // error: function() {}
//     });

//     console.log(dataResponse);

//     $.each(dataResponse, function(index, value) {

//         value.start = new Date(value.start);

//         // console.log(index, new Date(value.start));
//     });

//     return dataResponse;
// }

// async function testPromise() {

//     dataEvents = await fetch("//localhost:1880/obtainEventsCalendar")
//         .then(data => data.json())
//         .then(data => {

//             return data;
//         });

//     $.each(dataEvents, function(index, value) {

//         value.start = new Date(value.start);
//     });

//     console.log(dataEvents);

//     return dataEvents;
// }   return dataEvents;
// }
//     return dataEvents;
// }   return dataEvents;
// }   return dataEvents;
// }   return dataEvents;
// }