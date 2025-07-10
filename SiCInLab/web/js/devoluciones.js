$(document).ready(function () {
    $('#registrar').hide();

    $('#buscaMatricula').validate({
        rules: {
            matricula: {
                required: true,
                number: true,
                minlength: 4,
            }
        },
        messages: {
            matricula: {
                required: 'Ingrese una matricula',
                number: 'Debe ser una matricula',
                minlength: 'Ingrese una matricula de 4 dígitos'
            }
        },// Coloca el error después del contenedor de la input-group
        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.input-group').parent());
        }
    });

    $('#buscar').click(function (e) {
        e.preventDefault();
        
        if($('#buscaMatricula').valid() == false) { return; }
        matricula = $('#matricula').val();

        $.ajax({
            type: "GET",
            url: "buscarPrestamos",
            data: { prestamos: matricula },
            dataType: "json",
            success: function (response) {
                $('#filas').html('');
                let detallePrestamos = '';
                let objeto;
                let cont = 0;

                if (response.mensaje) {
                    $('#filas').html(response.mensaje);
                    $('#registrar').hide();
                    return;
                }
                response.detalles.forEach(function (detalle) {
                    switch (detalle.fk_categ) {
                        case "1": // Equipo
                            objeto = response.objetos.find(obj => obj.id_equip === detalle.fk_objeto_id);
                            break;
                        case "2": // Material
                            objeto = response.objetos.find(obj => obj.id_mater === detalle.fk_objeto_id);
                            break;
                        case "3": // Mobiliario
                            objeto = response.objetos.find(obj => obj.id_mobil === detalle.fk_objeto_id);
                            break;
                    }
                    if (objeto) {
                        detalle.nombr_obj = objeto.nombr_equip || objeto.mat_nombr || objeto.nombr || 'Sin nombre';
                        detalle.id_obj = objeto.id_equip || objeto.id_mater || objeto.id_mobil || '0';
                        cont++;
                        detallePrestamos += agregaDetalle(detalle, cont);
                    }
                });
                $('#filas').append(detallePrestamos);
                $('#registrar').show();
            }
        });
    });
    
    $('#devoluciones').validate({
        rules: {
            'devolucion[]': {
                required: true,
                number: true,
                min: 1,
                maxPrestado: true,
                totalValido: true
            }
        },
        messages: {
            'devolucion[]': {
                required: "Ingrese una cantidad",
                number: "Debe ser un número",
                min: "Debe ser mayor que 0"
            }
        }
    });

    $.validator.addMethod("maxPrestado", function(value, element) {
        const $fila = $(element).closest('tr');
        const prestado = parseInt($fila.find('input[name="prestado[]"]').val(), 10);
        const devolucion = parseInt(value, 10);

        if (isNaN(devolucion)) { return false; }

        return devolucion <= prestado;
    }, "Cantidad mayor a la prestada");

    $.validator.addMethod("totalValido", function(value, element) {
        const $fila = $(element).closest('tr');
        const devuelto = parseInt($fila.find('input[name="devuelto[]"]').val(), 10);
        const prestado = parseInt($fila.find('input[name="prestado[]"]').val(), 10);
        let devolucion = parseInt(value, 10) + devuelto;

        if (isNaN(devolucion)) { return false; }

        return devolucion <= prestado;
    }, "Cantidad mayor a la prestada");
    
    //validar cada input dentro de la tabla dimanicamente
    $(document).on('change', 'input[name="devolver[]"]', function () {
        const $fila = $(this).closest('tr');

        if ($(this).is(":checked")) {
            let valid = true; // Fuerza la validación de los campos en esa fila

            $fila.find('input[name="devolucion[]"]').each(function () {
                if (!$(this).valid()) { valid = false; }
            });
            if (!valid) { $(this).prop('checked', false); }
        }
    });

    $('#registrar').click(function (e) {
        e.preventDefault();
        let valid = true;

        $('#filas input[name="devolver[]"]:checked').each(function () {
            const $fila = $(this).closest('tr');
             
            $fila.find('input[name="devolucion[]"]').each(function () {
                if (!$(this).valid()) { valid = false; }
            });
        });
        if (!valid) { 
            alert('Corrige los campos inválidos antes de registrar.');
            return;
         }
        const seleccionado = $('#filas input[name="devolver[]"]:checked').length;
        
        if (seleccionado === 0) {
            alert('No hay devoluciones seleccionadas para procesar');
            return;
        }
        $('#observacion').modal('show');
    });

    $('#confirmar').click(function (e) {
        e.preventDefault();

        const observacionGeneral = $('#observacionGeneral').val();
        const fechaDevolucion = $('#fechaDevolucion').val();

        const data = {
            observacion: observacionGeneral,
            fechaDevol: fechaDevolucion,
            categorias: [],
            objetos: [],
            cantPrest: [],//cantidad prestada
            cantDevol: [],//cantidad a devolver
            fk_prest: [],
        }
        $('#filas tr').each(function () {
            if ($(this).find('input[name="devolver[]"]').is(":checked")) {            
                data.categorias.push($(this).find('input[name="categoria[]"]').val());
                data.objetos.push($(this).find('input[name="objeto[]"]').val());
                data.cantDevol.push($(this).find('input[name="devolucion[]"]').val());
                data.fk_prest.push($(this).find('input[name="fk_prest[]"]').val());
                data.cantPrest.push($(this).find('input[name="prestado[]"]').val());
            }
        });

        $.ajax({
            type: "POST",
            url: "registrarDevolucion",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#observacion').modal('hide');
                alert(response.mensaje);
                location.reload();
            },
            error: function (xhr) {
                $('#observacion').modal('hide');
                // xhr.responseText contiene el JSON enviado desde PHP
                let respuesta;
                try {
                    respuesta = JSON.parse(xhr.responseText);
                    alert(respuesta.error); // Muestra el mensaje
                } catch (e) {
                    alert("Ocurrió un error inesperado.");
                    console.error("Error parsing JSON:", e);
                }
            }
        });
    });
});

function agregaDetalle(detalle, numeroFila) {
    var nuevaFila = 
        "<tr id=\"renglon" + numeroFila + "\" name=\"renglon\">" +
            "<td>" +
                "<span>" + detalle.nombr + "</span>" +
                "<input type=\"hidden\" id=\"categoria" + numeroFila + "\" name=\"categoria[]\" value=\""+ detalle.fk_categ +"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + detalle.nombr_obj + "</span>" +
                "<input type=\"hidden\" id=\"objeto" + numeroFila + "\" name=\"objeto[]\" value=\""+ detalle.id_obj +"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + detalle.cant + "</span>" +
                "<input type=\"hidden\" id=\"prestado" + numeroFila + "\" name=\"prestado[]\" value=\""+ detalle.cant +"\"/>" +
            "</td>"+
            "<td>" + 
                "<span>" + (detalle.cantidad_devuelta || 0) + "</span>" +
                "<input type=\"hidden\" id=\"devuelto" + numeroFila + "\" name=\"devuelto[]\" value=\""+ (detalle.cantidad_devuelta || 0) +"\"/>" +
            "</td>" +
            "<td class=\"text-center\" style=\"width: 1%; white-space: nowrap;\">" +
                "<input type=\"number\" id=\"devolucion" + numeroFila + "\" name=\"devolucion[]\" value=\"0\" class=\"form-control\" style=\"text-align: right; width: 12rem;\"/>" +
            "</td>"+
            "<td class=\"text-center\" style=\"width: 1%; white-space: nowrap;\">" +
                "<input type=\"checkbox\" id=\"devolver" + numeroFila + "\" name=\"devolver[]\" class=\"form-check-input\"/> " +
                "<label for=\"devolver" + numeroFila + "\">Devolver</label>" +
                "<input type=\"hidden\" id=\"fk_prest" + numeroFila + "\" name=\"fk_prest[]\" value=\""+ detalle.fk_prest +"\"/>" +
            "</td>"+
        "</tr>";

    return nuevaFila;
}
