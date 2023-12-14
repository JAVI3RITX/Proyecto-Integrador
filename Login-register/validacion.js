function validarFormulario() {
    var nombreVideo = document.getElementById('nombreVideo').value;
    var urlVideo = document.getElementById('urlVideo').value;
    var categoria = document.getElementById('categoria').value;
    var opcionesTipoVideo = document.getElementsByName('tipo_video');
        // Verificar que al menos una opción esté seleccionada
        var seleccionado = false;
        for (var i = 0; i < opcionesTipoVideo.length; i++) {
            if (opcionesTipoVideo[i].checked) {
                seleccionado = true;
                break;
            }
        }

    // Mostrar un mensaje de error si no se ha seleccionado ninguna opción
    if (!seleccionado) {
        alert('Por favor, selecciona un tipo de video (Público o Privado).');
        return false; // Evitar que el formulario se envíe
    }

    if (nombreVideo.trim() === '') {
        alert('Por favor, ingresa el nombre del video.');
        return false;
    }

    if (urlVideo.trim() === '') {
        alert('Por favor, ingresa la URL del video desde Youtube.');
        return false;
    }

    // Validar la URL utilizando una expresión regular
    var urlRegex = /^(https?:\/\/)?(www\.)?(youtube\.com\/(embed\/|watch\?v=)|youtu\.be\/)\S*$/;
    if (!urlRegex.test(urlVideo)) {
        alert('Por favor, ingresa una URL válida de Youtube.');
        return false;
    }

    if (categoria === '') {
        alert('Por favor, selecciona una categoría.');
        return false;
    }
    


    // Envía el formulario si todas las validaciones pasan

    return true;
    document.getElementById('categoria').value = ''; // Restablecer la selección de la categoría
    document.getElementById('nombreVideo').value = ''; // Limpiar el campo de nombre del video
    document.getElementById('urlVideo').value = ''; // Limpiar el campo de URL del video
}

    function editarVideo(idVideo) {
        // Puedes utilizar AJAX para obtener los detalles del video del servidor
        // y luego rellenar el formulario con esos detalles
        // Ejemplo usando Fetch API
        fetch('obtenerDetallesVideo.php?id=' + idVideo)
            .then(response => response.json())
            .then(data => {
                // Rellena el formulario con los datos obtenidos
                document.getElementById('nombreVideo').value = data.nombre;
                document.getElementById('urlVideo').value = data.url;
                document.getElementById('categoria').value = data.categoria;
                // Rellena otros campos según sea necesario

                // Marca las casillas de los tags según los datos obtenidos
                data.tags.forEach(tag => {
                    document.querySelector('input[name="tags[]"][value="' + tag + '"]').checked = true;
                });

                // Selecciona el tipo de video según los datos obtenidos
                document.querySelector('input[name="tipo_video"][value="' + data.tipo + '"]').checked = true;
            })
            .catch(error => console.error('Error:', error));
    }



