$(document).ready(function () {
    $('#informacion').click(function() {
        $('#contenido').load('editar');
    });
    $('#clave').click(function() {
        $('#contenido').load('cambiar-clave', function() {
            cambiarClaveUsuario();
        });
    });
});

function cambiarClaveUsuario() {
    $('#mensajes').addClass('d-none');

    $('#formaGenerica').validate({
        rules: {
            claveActual: {
                required: true,
            },
            nuevaClave: {
                required: true,
                claveDiferente: true
            },
            repiteClave: {
                required: true,
                claveIgual: true
            }
        },
        messages: {
            claveActual: {
                required: 'Ingrese la contraseña actual'
            },
            nuevaClave: {
                required: 'Escriba una nueva contraseña'
            },
            repiteClave: {
                required: 'Repita la nueva contraseña'
            }
        }
    });

    $.validator.addMethod("claveDiferente", function(value) {
        const actual = $('#claveActual').val();
        const nueva = $('#nuevaClave').val();

        return nueva !== actual;
    }, "La nueva contraseña no puede ser la misma que la actual");

    $.validator.addMethod("claveIgual", function(value) {
        const nueva = $('#nuevaClave').val();
        const repite = $('#repiteClave').val();
        
        return repite === nueva;
    }, "Las contraseñas no coinciden");

    $('#guardar').click(function (e) {
        e.preventDefault();

        if ($('#formaGenerica').valid() == false) { return; }
        const data = {
            claveActual: $('#claveActual').val(),
            claveNueva: $('#nuevaClave').val(),
            repiteClave: $('#repiteClave').val()
        }

        $.ajax({
            type: "POST",
            url: "guardaNuevaContrasenia",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert('Contraseña actualizada correctamente');
                    window.location.href = response.redirect;
                } else {
                    if (response.errores.claveActual) {
                        $('#mensajes').removeClass('d-none');
                        $('#mensaje').text(response.errores.claveActual);
                    }
                    if (response.errores.noIguales) {
                        $('#mensajes').removeClass('d-none');
                        $('#mensaje').text(response.errores.noIguales);
                    }
                }
            }
        });
    });
}