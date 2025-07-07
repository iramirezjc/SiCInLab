$(document).ready(function () {
    $('#categoria').val('').prop('selectedIndex', 0);
    $('#regCategoria').hide();
    $('#cantidad').val('0');
    $('#formaTabla').hide();

    $('#registrar').on('click', function () {
        $('#regCategoria').toggle();
    });
    
    $('#categoria').on('change', function () {
        const idCateg = $(this).val();

        if (!idCateg || idCateg === 'Seleccione una opcion') {
            $('#cantidad').val('0');
            $('#opciones').html('<option selected>Seleccione una opción</option>');
            return;
        }
        
        $.ajax({
            type: "GET",
            url: 'obtenerObjetos',
            data: { opciones: idCateg},
            dataType: "json",
            success: function (response) {
                let opcionesHTML = '<option selected>Seleccione una opcion</option>';
                
                response.forEach(function (obj) {
                    let value = obj.id_equip || 
                                obj.id_mater ||
                                obj.id_mobil ||
                                obj.id_react || '';// Buscar id según objeto
                    let text =  obj.nombr_equip ||
                                obj.mat_nombr ||
                                obj.nombr || 
                                obj.react_nombr || '---';

                    opcionesHTML += `<option value="${value}">${text}</option>`;
                });

                $('#opciones').html(opcionesHTML);
            }
        });
    });

    $('#formaGenerica').validate({
        rules: {
            categoria: {
                required: true,
                notDefault: true
            },
            opciones: {
                required: true,
                notDefault: true
            },
            cantidad: {
                required: true,
                number: true,
                min: 1
            }
        },
        messages: {
            categoria: {
                required: 'Seleccione una categoría',
                notDefault: 'Seleccione una categoría válida'
            },
            opciones: {
                required: 'Seleccione un objeto',
                notDefault: 'Seleccione una opción válida'
            },
            cantidad: {
                required: 'Ingrese una cantidad',
                number: 'Debe ser un número',
                min: 'Debe ser mayor a 0'
            }
        },
        submitHandler: function (form) {
            $('#formaTabla').show();
            agregaDetalle('#miTabla');
            return false; // Previene el envío real del formulario
        }
    });

    $.validator.addMethod("notDefault", function (value) {
        return value !== "Seleccione una opcion";
    }, "Seleccione una opción válida");

    $('#finalizar').click(function (e) { 
        e.preventDefault();
        
        const data = {
            categoria: [],
            opciones: [],
            cantidad: [],
            fk_compr: $('#fk_compr').val(),
        }
        
        $('#miTabla tbody tr').each(function () {
            data.categoria.push($(this).find('input[name="categoria[]"]').val());
            data.opciones.push($(this).find('input[name="opciones[]"]').val());
            data.cantidad.push($(this).find('input[name="cantidad[]"]').val());
        });

        $.ajax({
            method: 'POST',
            url: 'registrarCompras',
            data: data,
            dataType: "json",
            success: function (response) {
                window.location.href = response.redirect;
            },
            error: function () {
                alert('Error al enviar los datos');
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
                "<span>" + $('#categoria option:selected').text() + "</span>" +
                "<input type=\"hidden\" id=\"categoria" + numeroFila + "\" name=\"categoria[]\" value=\""+$('#categoria').val()+"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + $('#opciones option:selected').text() + "</span>" +
                "<input type=\"hidden\" id=\"opciones" + numeroFila + "\" name=\"opciones[]\" value=\""+$('#opciones').val()+"\"/>" +
            "</td>"+
            "<td class=\"text-end\">" +
                "<span>" + $('#cantidad').val() + "</span>" +
                "<input type=\"hidden\" id=\"cantidad" + numeroFila + "\" name=\"cantidad[]\" value=\""+$('#cantidad').val()+"\"/>" +
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