$(document).ready(function() { calendarSinci(); });

async function calendarSinci() {

    /**
     * This Fetch petition obtain the calendar events registerd for the login user
     */
    let dataEvents = await fetch("//localhost:1880/obtainDataFromNodeRed?data='OmarAnaya'")
        .then(data => data.json())
        .then(data => {

            return data;
        });

    $.each(dataEvents, function(index, value) {

        value.start = new Date(value.start);
    });
    // END

    /*  className colors
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
    */

    // var testFunc = async() => { return await fetch("//localhost:1880/obtainDataFromNodeRed?data='OmarAnaya'").then(data => data.json()).then(data => { return data }); }

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

            // Function to obtaind the data from the modal
            let event = registerEventModal();

            // console.log(start);

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
            calendar.fullCalendar('unselect');
        },
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }

        },

        events: dataEvents,
    });

    let weekNumer = obtainWeekNumber();

    $('.fc-header .fc-header-center').html("<span class=''><h5> Semana " + weekNumer + "</h5></span>");
}

function obtainWeekNumber() {

    currentdate = new Date();

    var oneJan = new Date(currentdate.getFullYear(), 0, 1);
    var numberOfDays = Math.floor((currentdate - oneJan) / (24 * 60 * 60 * 1000));
    var result = Math.ceil((currentdate.getDay() + 1 + numberOfDays) / 7);

    return result - 1;
    // return result;
}

async function registerEventModal() {


    /**
     * Queda pendiente el poder agregar la informcion sin tener que recargar la pagina para ello utilizando la funcion de select en el fullcalendar.
     */

    $('#createEventCalendar').modal('show');

    $('#btnSaveEvent').click(function() {

        var dataForm = $('#dataEvent').serializeArray();

        console.log(JSON.stringify(dataForm));
        console.log(new Date());

        $('#calendar').select(function() {

            $('#calendar').select(function() {

                $('#calendar').fullCalendar('renderEvent', {
                        title: 'ANAYA',
                        start: new Date(),
                        end: new Date(),
                        allDay: allDay
                    },
                    true // make the event "stick");
                );

                return dataForm;
            });
        });

        return dataForm;
    });

    return await [];
}

/**
 * This function close the modals
 */

$(".modal .modal-dialog .modal-header .close").click(function() {

    $('.modal').modal('hide');
});

/**
 * This Functions are to test the promises results on the ajax or fetch petitions
 */

async function testObtainDataNodeRed() {

    const dataResponse = await $.ajax({
        type: "GET",
        url: "//localhost:1880/obtainDataFromNodeRed?data='OmarAnaya'",
        // success: function(response) {

        //     dataResponse = response;
        // },
        // error: function() {}
    });

    console.log(dataResponse);

    $.each(dataResponse, function(index, value) {

        value.start = new Date(value.start);

        // console.log(index, new Date(value.start));
    });

    return dataResponse;
}

async function testPromise() {

    dataEvents = await fetch("//localhost:1880/obtainDataFromNodeRed?data='OmarAnaya'")
        .then(data => data.json())
        .then(data => {

            return data;
        });

    $.each(dataEvents, function(index, value) {

        value.start = new Date(value.start);
    });

    console.log(dataEvents);

    return dataEvents;
}

setTimeout(() => {

    // console.log("Set Time Out");


    // calendar.fullCalendar('renderEvent', {
    //         title: "Test Event Title",
    //         start: 3,
    //         end: 5,
    //         allDay: true
    //     },
    //     true // make the event "stick"

    // );
}, 2000);