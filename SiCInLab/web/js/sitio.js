$(document).ready(function () {
    $('#formInicioSesion').validate({
        rules: {
            usuario: {
                required: true,
                number: true,
                minlength: 4,
            },
            clave: {
                required: true,
            }
        },
        messages: {
            usuario: {
                required: 'Para iniciar sesión ingrese su matricula',
                number: 'Debe ser una matricula valida',
                minlength: 'Debe ser de minimo 4 dígitos',
            },
            clave: {
                required: 'Para iniciar sesión ingrese su contraseña',
            }
        }
    });

    $('#iniciar').click(function(e) {
        e.preventDefault();

        if ($('#formInicioSesion').valid() == false) { return; }
        $('#iniciar').text('Validando...');

        setTimeout(function() {
            const data = {
                usuario: $('#usuario').val(),
                clave: $('#clave').val(),
            }
            $.ajax({
                type: "POST",
                url: "iniciarSesion",
                data: data,
                dataType: "json",
                success: function (response) {
                    window.location.href = response.redirect;
                },
                error: function (xhr) {
                    $('#iniciar').text('Iniciar Sesion');
                    let respuesta;
                    try {
                        respuesta = JSON.parse(xhr.responseText);
                        if (respuesta.error) {
                            alert(respuesta.error); // Muestra el mensaje
                        }
                    } catch (e) {
                        alert("Ocurrió un error inesperado.");
                        console.error("Error parsing JSON:", e);
                    }
                }
            });
        }, 3000);
    });
});