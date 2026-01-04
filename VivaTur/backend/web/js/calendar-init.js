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

    // Pegar eventos do atributo data-eventos
    var eventosData = calendarEl.getAttribute('data-eventos');
    var eventos = eventosData ? JSON.parse(eventosData) : [];
    console.log('Eventos:', eventos);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        events: eventos,
        eventClick: function(info) {
            info.jsEvent.preventDefault();

            // Preencher o modal com os dados
            $('#modal-nome').text(info.event.title);

            // Formatar a data
            var dataInicio = new Date(info.event.start);
            var dataFormatada = dataInicio.toLocaleDateString('pt-PT', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
            $('#modal-data').text(dataFormatada);

            // Formatar o horário
            var horaInicio = dataInicio.toLocaleTimeString('pt-PT', {
                hour: '2-digit',
                minute: '2-digit'
            });
            var horaFim = '';
            if (info.event.end) {
                var dataFim = new Date(info.event.end);
                horaFim = dataFim.toLocaleTimeString('pt-PT', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
            $('#modal-horario').text(horaInicio + (horaFim ? ' - ' + horaFim : ''));

            // Local
            $('#modal-local').text(info.event.extendedProps.local || 'Não especificado');

            // Link para ver detalhes
            $('#modal-ver-detalhes').attr('href', info.event.url);

            // Mostrar o modal
            $('#experienciaModal').modal('show');
        }
    });

    calendar.render();
    console.log('Calendar rendered');
});