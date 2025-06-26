$(document).ready(function () {
    $('#inicio').prop('disabled', true);
    $('#generar').hide();
    $('#guardar').hide();
    //se puede escalar '#equipos, #materiales, #mobiliarios, #reactivos, #todos';
    $('#todos').on('change', function() {
        marcado = $('#todos').is(':checked');
        $('#inicio').prop('disabled', !marcado);
    });
    
    $('#inicio').click(function (e) { 
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "registroInventario",
            dataType: "json",
            success: function (response) {
                if (parseInt(response.realizado) > 0) {
                    alert(response.mensaje);
                    return;
                }
                let detalleInventario = '';
                let listaObjetos = [];
                let cont = 0;
                
                response.categorias.forEach(function (categoria) {
                    switch (categoria.id_categ) {
                        case "1": // Equipo
                            listaObjetos = response.objetos.equipos;
                            break;
                        case "2": // Material
                            listaObjetos = response.objetos.materiales;
                            break;
                        case "3": // Mobiliario
                            listaObjetos = response.objetos.mobiliarios;
                            break;
                        case "4": // Reactivo
                            listaObjetos = response.objetos.reactivos;
                            break;
                    }
                    listaObjetos.forEach(function (objeto) {
                        let nombre = '';
                        let cantidad = '';
                        let id = '';

                            // Según el tipo de objeto, obtén los campos correctos
                        if (categoria.id_categ === "1") {
                            nombre = objeto.nombr_equip;
                            id = objeto.id_equip;
                            cantidad = objeto.canti_equip;
                        } else if (categoria.id_categ === "2") {
                            nombre = objeto.mat_nombr;
                            id = objeto.id_mater;
                            cantidad = objeto.canti;
                        } else if (categoria.id_categ === "3") {
                            nombre = objeto.nombr;
                            id = objeto.id_mobil;
                            cantidad = objeto.canti;
                        } else if (categoria.id_categ === "4") {
                            nombre = objeto.react_nombr;
                            id = objeto.id_react;
                            cantidad = objeto.cant;
                        }
                        // Crear estructura de detalle
                        let detalle = {
                            idCategoria: categoria.id_categ,
                            categoria: categoria.nombr,
                            idObjeto: id,
                            nombreObjeto: nombre,
                            enSistema: cantidad,
                        };
                        cont++;
                        detalleInventario += agregaDetalle(detalle, cont);
                        
                    });
                });
                $('#generar').show();
                $('#filas').append(detalleInventario);
                $('#guardar').show();
            }
        });
    });

    $('#generar').click(function (e) { 
        e.preventDefault();

        const data = {
            numero: [],
            categoria: [],
            nombreObjeto: [],
            enSistema: [],
        }
        $('#filas tr').each(function () {   
            data.numero.push($(this).find('input[name="numero[]"]').val())      
            data.categoria.push($(this).find('input[name="categoria[]"]').val());
            data.nombreObjeto.push($(this).find('input[name="objeto[]"]').val());
            data.enSistema.push($(this).find('input[name="enSistema[]"]').val());
        });
        generaReporte(data, 'reporteInventario');
    });

    $('#formControl').validate({
        ignore: [],
        rules: {
            'existente[]': {
                required: true,
                number: true,
                min: 0,
            }
        },
        messages: {
            'existente[]': {
                required: "Ingrese una cantidad",
                number: "Debe ser un número",
                min: "Debe ser mayor o igual a 0"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest("td").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        }
    });
    //calcula la diferencia entre el conteo fisico y el registrado en el sistema
    $(document).on('input', 'input[name="existente[]"]', function() {
        const input = $(this);
        const fila = input.closest('tr');
        const filaId = fila.attr('id').replace('renglon', '');

        const existente = parseInt(input.val()) || 0;
        const enSistema = parseInt($('#enSistema' + filaId).val()) || 0;
        let diferencia = existente - enSistema;

        if (diferencia > 0) {
            diferencia = '+' + diferencia;
        }
        $('#verDiferencia' + filaId).text(diferencia);
        $('#diferencia' + filaId).val(diferencia);
    });

    $('#guardar').on('click', function(e) {
        e.preventDefault();
        let esValido = true;//forzar la validacion

        $('input[name="existente[]"]').each(function () {
            if (!$(this).valid()) {
                esValido = false;
                return;
            }
        });
        if (esValido) {
            //console.log('Formulario válido. Enviar datos...');
            // Aquí podrías enviar el formulario o los datos por AJAX
            const data = {
                numero: [],
                idCategoria: [],
                categoria: [],
                idObjeto: [],
                nombreObjeto: [],
                enSistema: [],
                existente: [],
                diferencia: [],
            }
            $('#filas tr').each(function () {   
                data.numero.push($(this).find('input[name="numero[]"]').val())
                data.idCategoria.push($(this).find('input[name="idCategoria[]"]').val());      
                data.categoria.push($(this).find('input[name="categoria[]"]').val());
                data.idObjeto.push($(this).find('input[name="idObjeto[]"]').val());
                data.nombreObjeto.push($(this).find('input[name="objeto[]"]').val());
                data.enSistema.push($(this).find('input[name="enSistema[]"]').val());
                data.existente.push($(this).find('input[name="existente[]"]').val());
                data.diferencia.push($(this).find('input[name="diferencia[]"]').val());
            });

            $.ajax({
                type: "POST",
                url: "guardarDesgloseInventario",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        generaReporte(data, 'reporteDesgloseInventario');
                        alert(response.mensaje);
                        location.reload();
                    }
                }
            });
        }
    });
});

function agregaDetalle(detalle, numeroFila) {
    var nuevaFila = 
        "<tr id=\"renglon" + numeroFila + "\" name=\"renglon\">" +
            "<td style=\"text-align: right; \">" +
                "<span>" + numeroFila + "</span>" +
                "<input type=\"hidden\" id=\"numero" + numeroFila + "\" name=\"numero[]\" value=\""+ numeroFila +"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + detalle.categoria + "</span>" +
                "<input type=\"hidden\" id=\"categoria" + numeroFila + "\" name=\"categoria[]\" value=\""+ detalle.categoria +"\"/>" +
                "<input type=\"hidden\" id=\"idCategoria" + numeroFila + "\" name=\"idCategoria[]\" value=\""+ detalle.idCategoria +"\"/>" +
            "</td>"+
            "<td>" +
                "<span>" + detalle.nombreObjeto + "</span>" +
                "<input type=\"hidden\" id=\"objeto" + numeroFila + "\" name=\"objeto[]\" value=\""+ detalle.nombreObjeto +"\"/>" +
                "<input type=\"hidden\" id=\"idObjeto" + numeroFila + "\" name=\"idObjeto[]\" value=\""+ detalle.idObjeto +"\"/>" +
            "</td>"+
            "<td style=\"text-align: right; width: 200px; white-space: nowrap;\">" +
                "<span>" + detalle.enSistema + "</span>" +
                "<input type=\"hidden\" id=\"enSistema" + numeroFila + "\" name=\"enSistema[]\" value=\""+ detalle.enSistema +"\"/>" +
            "</td>"+
            "<td class=\"text-center\" style=\"width: 1%; white-space: nowrap;\">" +
                "<input type=\"number\" id=\"existente" + numeroFila + "\" name=\"existente[]\" value=\"\" style=\"text-align: right;\"/>" +
            "</td>"+
            "<td style=\"text-align: right; \">" +
            "<span id=\"verDiferencia" + numeroFila +"\">"+"</span>" +
                "<input type=\"hidden\" id=\"diferencia" + numeroFila + "\" name=\"diferencia[]\" value=\"0\"/>" +
            "</td>"+
        "</tr>";

    return nuevaFila;
}
function generaReporte(data, url) {
    const form = $('<form>', {
        method: 'POST',
        action: url,
        target: '_blank'
    });

    form.append($('<input>', {
        type: 'hidden',
        name: 'detalle',
        value: JSON.stringify(data)
    }));

    $('body').append(form);
    form.submit();
    form.remove();
}