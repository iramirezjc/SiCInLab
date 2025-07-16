$(document).ready(function () {

    $('tr #ingreso').click(function(e) {
        e.preventDefault();
        var fila = $(this).closest('tr');

        // Obtiene los valores de cada celda
        var solicitante = fila.find('td:eq(0)').text().trim();
        var asunto      = fila.find('td:eq(1)').text().trim();
        var autoriza    = fila.find('td:eq(2)').text().trim();
        var id_horario  = $(this).data('id_horario');

        $('#usuario').val(autoriza);
        $('#solicita').val(solicitante);
        $('#asunto').val(asunto);
        $('#id_horario').val(id_horario);
        $('#darAcceso').modal('show');
    });

    $('#reservar').click(function(e) {
        e.preventDefault();

        const data = {
            fecha: $('#fecha').val(),
            id_horario: $('#id_horario').val(),
            solicitante: $('#solicita').val(),
            asunto: $('#asunto').val(),
            autoriza: $('#usuario').val(),
            estado: 'O'
        }

        $.ajax({
            type: "POST",
            url: "registrarAccesoSala",
            data: data,
            dataType: "json",
            success: function (response) {
                alert(response.mensaje);
                location.reload();
            }
        });
    });
});