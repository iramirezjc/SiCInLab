let formula ="";
$(document).ready(function () {
    $('#formaTabla').hide();
    $('#disponible').val('0');
    $('#solicitada').val('0').prop('disabled', true); // Deshabilitar si no hay disponible

    $('#reactivos').on('change', function () {
        const idReactivo = $(this).val();

        if (!idReactivo || idReactivo === 'Seleccione una opcion') {
            $('#disponible').val('0');
            $('#solicitada').val('0');
            $('#solicitada').val('0').prop('disabled', true);
            $('#unidad').text('');
            return;
        }
        
        $.ajax({
            type: "GET",
            url: 'obtenerCatidades',
            data: { reactivo: idReactivo},
            dataType: "json",
            success: function (response) {
                let id = response.id_react || '0';// Buscar id según objeto
                let cant = response.cant || '0';
                let unid = response.unid_nombr || '';
                formula = response.formu || '';

                $('#disponible').val(cant);
                $('#unidad').text(unid);
                $('#formula').val(formula);

                if (parseInt(cant) === 0) {
                    $('#solicitada').val('0').prop('disabled', true);
                } else {
                    $('#solicitada').val('0').prop('disabled', false); 
                }
            }
        });
    });

    $('#formaGenerica').validate({
        rules: {
            reactivos: {
                required: true,
                notDefault: true
            },
            solicitada: {
                required: true,
                number: true,
                min: 1,
                maxPrestado: true,
            }
        },
        messages: {
            reactivos: {
                required: 'Seleccione un reactivo',
                notDefault: 'Seleccione un reactivo válido'
            },
            solicitada: {
                required: 'Ingrese una cantidad',
                number: 'Debe ser numérico',
                min: 'Debe ser mayor a 0'
            }
        }
    });

    $.validator.addMethod("notDefault", function (value) {
        return value !== "Seleccione una opcion";
    }, "Seleccione una opción válida");

    $.validator.addMethod("maxPrestado", function (value) {
        disponible = parseInt($('#disponible').val(), 10);
        solicitada = parseInt(value, 10);

        return solicitada <= disponible;
    }, 'Cantidad mayor a la disponible');

    $('#agregar').click(function(e) {
        e.preventDefault();
        
        if ($('#formaGenerica').valid() == false) { return; }
        const idReactivo = $('#reactivos').val();

        if (reactivoElegido(idReactivo)) {
            alert('Este reactivo ya fue agregado. Eliminelo y edite la cantidad si necesita cambiarla.');
            return false;
        }
        $('#formaTabla').show();
        agregaDetalle('#miTabla');
    });

    $('#registrar').click(function (e) {
        e.preventDefault();

        const data = {
            reactivo: [],
            cantidad: [],
            fk_prest_consu: parseInt($('#fk_compr').val()),
        }

        $('#miTabla tbody tr').each(function () {
            data.reactivo.push($(this).find('input[name="nombre[]"]').val());
            data.cantidad.push($(this).find('input[name="solicitada[]"]').val());
        });

        $.ajax({
            type: "POST",
            url: 'guardarPrestamoConsumible',
            data: data,
            dataType: "json",
            success: function (response) {
                window.location.href = response.redirect;
            }
        });

    });
});

function agregaDetalle(idControl) {
    var numeroFila = $(idControl+" > tbody > tr").length;
    numeroFila++
    var nuevaFila = 
        "<tr id=\"renglon" + numeroFila + "\" name=\"renglon\">"+
            "<td>" +
                "<span>" + $('#reactivos option:selected').text() + "</span>" +
                "<input type=\"hidden\" id=\"nombre" + numeroFila + "\" name=\"nombre[]\" value=\""+$('#reactivos').val()+"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + formula + "</span>" +
                "<input type=\"hidden\" id=\"formuna" + numeroFila + "\" name=\"formuna[]\" value=\""+formula+"\"/>" +
            "</td>"+
            "<td class=\"text-end\">" +
                "<label>" + $('#solicitada').val() + "</laber>" +
                "<input type=\"hidden\" id=\"solicitada" + numeroFila + "\" name=\"solicitada[]\" value=\""+$('#solicitada').val()+"\"/>" +
            "</td>"+
            "<td>"+
                "<span>"+$('#unidad').text()+"</span>" +
                "<input type=\"hidden\" name=\"unidad[]\" value=\""+$('#unidad').text()+"\" />"+
            "</td>"+
            "<td class=\"text-center\" style=\"width: 1%; white-space: nowrap;\">" +
                "<button type=\"button\" id=\"eliminar" + numeroFila + "\" name=\"eliminar" + numeroFila + "\" class=\"btn btn-danger\" onclick=\"eliminarFila('renglon" + numeroFila + "')\">" +
                    "<i class=\"bi bi-trash-fill\"></i>" +
                "</button>"+
            "</td>"+
        "</tr>";
    
    $(idControl).append(nuevaFila);
}

function eliminarFila(id) {
	$('#' + id).remove();

    const filasRestantes = $('#miTabla tbody tr').length;
    
    if (filasRestantes === 0) {
        $('#formaTabla').hide(); // Opcional: ocultar la tabla si está vacía
    }
}

function reactivoElegido(idReactivo) {
    let existe = false;

    $('#miTabla tbody tr').each(function () {
        let idExistente = $(this).find('input[name="nombre[]"]').val();
        if (idExistente === idReactivo) {
            existe = true;
            return false; // Rompe el loop
        }
    });

    return existe;
}