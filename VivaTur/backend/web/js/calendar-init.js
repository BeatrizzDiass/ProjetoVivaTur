$(document).ready(function() {
    console.log('Calendar script loaded');

    var calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
        console.error('Calendar element not found!');
        return;
    }

    console.log('Calendar element found');

    if (typeof FullCalendar === 'undefined') {
        console.error('FullCalendar not loaded!');
        return;
    }

    console.log('FullCalendar loaded');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
    });

    calendar.render();
    console.log('Calendar rendered');
});