function confirmarEliminar(documento_id) {
    var confirmar = confirm('¿Seguro que quieres eliminar este documento?');
    if (confirmar) {
        window.location.href = 'eliminar_documento.php?documento_id=' + documento_id;
    }
}

function descargarDocumento(ruta, nombreArchivo) {
    var enlaceDescarga = document.createElement('a');
    enlaceDescarga.href = ruta;
    enlaceDescarga.download = nombreArchivo;
    enlaceDescarga.click();
}
