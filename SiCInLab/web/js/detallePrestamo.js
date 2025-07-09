$(document).ready(function () {
    let objetos = [];
    let eleccion = [];
    let idEleccion;
    $('#solicitada').val('0');
    $('#disponible').val('0');
    $('#formaTabla').hide();

    $('input[name="filtrar"]').on('change', function() {
        opcion = $('input[name="filtrar"]:checked').val();
        $.ajax({
            type: "GET",
            url: 'listarObjetos',
            data: { opcion: opcion},
            dataType: "json",
            success: function (response) {
                objetos = response;
                let lista = '';
                
                response.forEach(function (obj) {
                    let categ = obj.id_equip ? 'equip' :
                               obj.id_mater ? 'mater' :
                               obj.id_mobil ? 'mobil' : 'desconocido';
                    let id = obj.id_equip || 
                                obj.id_mater ||
                                obj.id_mobil || '';// Buscar id según objeto
                    let text = obj.nombr_equip ||
                               obj.mat_nombr ||
                               obj.nombr || '---';
                    let value = `${categ}-${id}`;

                    lista += `<option value="${value}">${text}</option>`;
                });

                $('#opciones').html(lista);
            }
        });
    });
    $('#radio0').prop('checked', true).trigger('change');

    $('#busqueda').on('input', function () {
        const [categ, id] = $(this).val().split('-');
        idEleccion = id;
        eleccion = objetos.find(obj => {
            if (categ === 'equip') return obj.id_equip === id;
            if (categ === 'mater') return obj.id_mater === id;
            if (categ === 'mobil') return obj.id_mobil === id;
        });
        if (eleccion) {
            let text = eleccion.nombr_equip ||
                       eleccion.mat_nombr ||
                       eleccion.nombr;
            let cant = eleccion.canti || 
                       eleccion.canti_equip;

            $('#busqueda').val(text)
            $('#disponible').val(cant);
            $('#solicitada').val('0');
        }
    })

    $('#formaGenerica').validate({
        rules: {
            busqueda: {
                required: true,
                minlength: 3,
                opcionValida: true
            },
            solicitada: {
                required: true,
                number: true,
                min: 1,
                cantidadValida: true
            }
        },
        messages: {
            busqueda: {
                required: 'Ingrese un nombre valido',
                minlength: 'Ingrese mas de 3 caracteres',
                opcionValida: 'Seleccione una opción válida',
            },
            solicitada: {
                required: 'Ingrese una cantidad',
                number: 'Debe ser un número',
                min: 'Debe ser mayor a 0',
                cantidadValida: 'Cantidad mayor a la disponible'
            }
        }
    });

    $.validator.addMethod("opcionValida", function (value) {
        return !isNaN(idEleccion);
    }, "Seleccione una opción válida");

    $.validator.addMethod("cantidadValida", function (value) {
        disponible = parseInt($('#disponible').val());
        solicitada = parseInt(value);

        return solicitada <= disponible;
    }, 'Cantidad mayor a la disponible');

    $('#agregar').click(function (e) {
        e.preventDefault();

        if ($('#formaGenerica').valid() == false) { return; }
        if(articuloElegido(idEleccion)) {
            alert('Este articulo ya fue agregado. Eliminelo y edite la cantidad si necesita cambiarla.');
            return;
        }
        $('#formaTabla').show();
        agregaDetalle('#miTabla', eleccion);

        $('#busqueda').val('').removeAttr('placeholder').attr('placeholder', 'Buscar...');
        $('#solicitada').val('0');
        $('#disponible').val('0');
    });

    $('#registrar').click(function(e) {
        e.preventDefault();

        const data = {
            categoria: [],
            articulo: [],
            cantidad: [],
            noPrestamo: $('#idPrestamo').val(),
        }
        $('#miTabla tbody tr').each(function () {
            data.categoria.push($(this).find('input[name="categoria[]"]').val());
            data.articulo.push($(this).find('input[name="articulo[]"]').val());
            data.cantidad.push($(this).find('input[name="cantidad[]"]').val());
        });

        $.ajax({
            type: "POST",
            url: "guardarDetallePrestamo",
            data: data,
            dataType: "json",
            success: function (response) {
                window.location.href = response.redirect;
            }
        });
    });
});
function agregaDetalle(idControl, objeto) {
    const idObj = objeto.id_equip || 
                  objeto.id_mater ||
                  objeto.id_mobil || '';
    var numeroFila = $(idControl+" > tbody > tr").length;
    const categoria = detectarCategoria(objeto);
    numeroFila++
    var nuevaFila = 
        "<tr id=\"renglon" + numeroFila + "\" name=\"renglon\">"+
            "<td>" +
                "<span>" + nombreCategoria(categoria) + "</span>" +
                "<input type=\"hidden\" id=\"categoria" + numeroFila + "\" name=\"categoria[]\" value=\""+ categoria +"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + $('#busqueda').val() + "</span>" +
                "<input type=\"hidden\" id=\"articulo" + numeroFila + "\" name=\"articulo[]\" value=\""+ idObj +"\"/>" +
            "</td>"+
            "<td class=\"text-end\">" +
                "<span>" + $('#solicitada').val() + "</span>" +
                "<input type=\"hidden\" id=\"cantidad" + numeroFila + "\" name=\"cantidad[]\" value=\""+$('#solicitada').val()+"\"/>" +
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
        $('#formaTabla').hide(); 
    }
}
function detectarCategoria(objeto) {
    if ('id_equip' in objeto) return $('#radio1').val();
    if ('id_mater' in objeto) return $('#radio2').val();
    if ('id_mobil' in objeto) return $('#radio3').val();

    return 'desconocido';
}
function nombreCategoria(idCategoria) {
    idCategoria = parseInt(idCategoria);
    switch (idCategoria) {
        case 1: 
            return 'Equipos';
        case 2: 
            return 'Materiales';
        case 3: 
            return 'Mobiliarios';
        default: return 'Categoría desconocida';
    }
}

function articuloElegido(idReactivo) {
    let existe = false;

    $('#miTabla tbody tr').each(function () {
        let idExistente = $(this).find('input[name="articulo[]"]').val();
        if (idExistente === idReactivo) {
            existe = true;
            return false; // Rompe el loop
        }
    });

    return existe;
}