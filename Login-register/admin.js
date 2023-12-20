
document.addEventListener("DOMContentLoaded", function () {
    cargarUsuarios(); // Cargar todos los usuarios al cargar la página

    // Resto del código...

    // Agregar evento click al botón "Filtrar"
    document.getElementById("filtrarBtn").addEventListener("click", function () {
        filtrarUsuarios();
    });

    // Resto del código...
});

function cargarUsuarios() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var usuarios = JSON.parse(xhr.responseText);
                // Filtrar usuarios con estado 1
                var usuariosActivos = usuarios.filter(function (usuario) {
                    return usuario.estado === 1;
                });
                mostrarUsuarios(usuariosActivos);
            } else {
                mostrarError("Error al cargar usuarios");
            }
        }
    };
    xhr.open("GET", "get_usuario.php", true);
    xhr.send();
}


function mostrarUsuarios(usuarios) {
    var tablaUsuarios = document.getElementById("tablaUsuarios");
    var tbody = tablaUsuarios.getElementsByTagName("tbody")[0];
    tbody.innerHTML = ""; // Limpiar la tabla antes de agregar nuevos datos

    usuarios.forEach(function (usuario) {
        var row = tbody.insertRow();
        row.insertCell(0).textContent = usuario.id;
        row.insertCell(1).innerHTML = '<div id= "nombre" contenteditable="true" class="editable" data-column="nombre">' + usuario.nombre + '</div>';
        row.insertCell(2).innerHTML = '<div id = "fecha" contenteditable="true" class="editable" data-column="fecha_nacimiento">' + usuario.fecha_nacimiento + '</div>';
        row.insertCell(3).innerHTML = '<div id = "rubro" contenteditable="true" class="editable" data-column="rubro">' + usuario.rubro + '</div>';
        row.insertCell(4).innerHTML = '<div id "correo"contenteditable="true" class="editable" data-column="correo">' + usuario.correo + '</div>';
        row.insertCell(5).innerHTML = '<button onclick="eliminarUsuario(' + usuario.id + ')">Eliminar</button>';
        row.insertCell(6).innerHTML = '<button onclick="editarUsuario(' + usuario.id + ')">Editar</button>';
        // No se agrega la celda para la contraseña y el estado
    });
}

function filtrarUsuarios() {
    var nombre = document.getElementById("filtroNombre").value;
    var correo = document.getElementById("filtroCorreo").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.error) {
                    mostrarError(respuesta.error);
                } else {
                    // Filtrar usuarios con estado 1
                    var usuariosFiltrados = respuesta.filter(function(usuario) {
                        return usuario.estado === 1;
                    });
                    mostrarUsuarios(usuariosFiltrados);
                }
            } else {
                mostrarError("Error al filtrar usuarios");
            }
        }
    };
    xhr.open("GET", "filtrar_usuarios.php?nombre=" + nombre + "&correo=" + correo, true);
    xhr.send();
}

function mostrarError(mensaje) {
    // Muestra un mensaje de error estéticamente atractivo usando SweetAlert2
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje,
    });
}
function guardarCambiosBD() {
    var filas = document.getElementById("tablaUsuarios").rows;

    for (var i = 1; i < filas.length; i++) { // Comienza desde 1 para omitir la fila de encabezado
        var idUsuario = filas[i].cells[0].textContent;
        var nombre = filas[i].cells[1].textContent;
        var fechaNacimiento = filas[i].cells[2].textContent;
        var rubro = filas[i].cells[3].textContent;
        var correo = filas[i].cells[4].textContent;

        // Lógica para enviar los datos a tu archivo actualizar_usuario.php utilizando AJAX
        enviarDatosActualizar(idUsuario, nombre, fechaNacimiento, rubro, correo);
    }
}

function enviarDatosActualizar(idUsuario, nombre, fechaNacimiento, rubro, correo) {
    // Ejemplo con fetch:
    fetch('actualizar_usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + idUsuario + '&columnName=nombre&newValue=' + nombre,
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Mensajes de la respuesta del servidor

        if (data.success) {
            // Mostrar mensaje de éxito con SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Usuario guardado correctamente',
            });
        } else {
            // Mostrar mensaje de error con SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al guardar el usuario',
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Mostrar mensaje de error con SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar el usuario',
        });
    });
}
function eliminarUsuario(idUsuario) {
    // Realizar una solicitud AJAX para cambiar el estado del usuario a 0
    fetch('eliminar_usuario.php?id=' + idUsuario, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Mensajes de la respuesta del servidor

        if (data.success) {
            // Recargar la lista de usuarios después de eliminar uno
            cargarUsuarios();
            // Mostrar mensaje de éxito con SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Usuario eliminado correctamente',
            });
        } else {
            // Mostrar mensaje de error con SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al eliminar el usuario',
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Mostrar mensaje de error con SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al eliminar el usuario',
        });
    });

}
function editarUsuario(idUsuario){
    window.location.href = "../Login-registerv3/auriolmain.php?id="+idUsuario;
}
