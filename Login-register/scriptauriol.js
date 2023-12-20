function validarContraseñas() {
    var contrasena = document.getElementById("contrasena").value;
    var confirmarPassword = document.getElementById("confirmar-password").value;

    // Verificar si las contraseñas coinciden
    if (contrasena !== confirmarPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden. Por favor, verifica.',
        });
        return false;
    }

    return true;
}

function enviarFormulario() {
    if (validarFormulario() && validarContraseñas()) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción actualizará el usuario.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Continuar con el envío del formulario
                document.getElementById('tu_formulario_id').submit();
            }
        });
    }

    // Cancelar el envío del formulario si la validación falla o si el usuario cancela en SweetAlert
    return false;
}
