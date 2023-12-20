function descargarDocumento(ruta, nombreArchivo) {
    var enlaceDescarga = document.createElement('a');
    enlaceDescarga.href = ruta;
    enlaceDescarga.download = nombreArchivo;
    enlaceDescarga.click();
}
