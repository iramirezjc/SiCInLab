$(document).ready(function () {
    $('#asunto').val('');
    $('#asunto').prop('disabled', true);
    $('#reservar').prop('disabled', true);
    $('#horaEntrada').selectpicker();
    $('#horaSalida').prop('disabled', true);

    var calendario = new FullCalendar.Calendar(
        document.getElementById('calendario'),
        { 
            locale: 'es',
            initialView: 'dayGridMonth',
            selectable: true,
            buttonText: {
                today: 'hoy',
                month: 'mes',
                week:  'semana',
                day:   'dia',
                list:  'lista'
            },
            headerToolbar: {
                start: 'today prev,next', 
                center: 'title',
                end: 'timeGridDay dayGridMonth'
            },            
            dateClick: function(info) {
                $('#fecha').prop('readonly', false);
                $('#fecha').val(info.dateStr);
                
                $('#horaEntrada').selectpicker('destroy');
                $('#horaEntrada').empty();
                $('#horaEntrada').append('<option selected disabled>Selecciona una Hora</option>');
                
                const fecha = $('#fecha').val();

                $.ajax({
                    type: "GET",
                    url: "horasDisponibles",
                    data: {dia: fecha},
                    dataType: "json",
                    success: function (response) {
                        response.horasDisponibles.forEach(hora => {
                            $('#horaEntrada').append(`<option value="${hora}">${hora}</option>`);
                        });
                        $('#horaEntrada').selectpicker();
                        $('#asunto').val('');
                        $('#asunto').prop('disabled', true);
                        $('#reservar').prop('disabled', true);
                        $('#horaSalida').val('');
                        $('#horaSalida').prop('disabled', true);
                    }
                });
            },
            events: 'listaReservaciones'
        }
    );
    calendario.render();

    $('#horaEntrada').on('change', function () {
        const entrada = $(this).val(); 
        var [horaMinutos, meridiem] = entrada.trim().split(' ');
        const [horas, minutos] = horaMinutos.split(':').map(Number);
        
        const entradaDate = new Date();
        entradaDate.setHours(horas);
        entradaDate.setMinutes(minutos);
        
        if ( meridiem == 'AM' && entradaDate.getHours() >= 11) {
            meridiem = 'PM'
        }
        entradaDate.setHours(entradaDate.getHours() + 1);
        const salida = entradaDate.toTimeString().slice(0, 5);

        $('#horaSalida').val(salida + ' ' + meridiem);
        $('#horaSalida').prop('disabled', false);
        $('#asunto').prop('disabled', false);
        $('#reservar').prop('disabled', false);
    });

    $('#formaGenerica').validate({
        rules: {
            solicita: {
                required: true,
                notDefault: true
            },
            fecha: {
                required: true,
                notDefault: true
            },
            horaSalida: {
                required: true,
                notDefault: true,
            },
            asunto: {
                required: true,
                notDefault: true,
            }
        },
        messages: {
            solicita: {
                required: 'La matricula es requerida',
                notDefault: 'Ingrese la matricula'
            },
            fecha: {
                required: 'Seleccione una fecha',
                notDefault: 'Eliga una fecha válida'
            },
            horaSalida: {
                required: 'Ingrese la hora de Salida',
                notDefault: 'Ingrese una hora de salida'
            },
            asunto: {
                required: 'Escribe la razón de la solicitud',
                notDefault: 'Ingrese el asunto de solicitud'
            },
        }
    });

    $.validator.addMethod("notDefault", function (value) {
        return value !== "Seleccione una hora" && value.trim() !== "";
    }, "Seleccione una hora válida");    
    
    $('#reservar').click(function (e) {
        e.preventDefault();
        if ($('#formaGenerica').valid() == false) { return; }
        const data = {
            fk_matri: $('#usuario').val(),
            solicitante: $('#solicita').val(),
            fecha: $('#fecha').val(),
            asunto: $('#asunto').val(),
            horaEntrada: $('#horaEntrada').val(),
            horaSalida: $('#horaSalida').val(),
        }
        $.ajax({
            type: "POST",
            url: "registrarReservacion",
            data: data,
            dataType: "json",
            success: function (response) {
                if (!response.success) {
                    alert(response.mensaje);
                    return;
                }
                alert(response.mensaje);
                location.reload();
            }
        });
    });
});


