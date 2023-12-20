
<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Panel de Administrador</title>
</head>

<body>
    
<header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
            <img src="imagenes/menu.png" alt="Menú" style="width: 30px; height: 30px;">
                <div class="dropdown-content" id="myDropdown">
                    <a href="#!">Modificar cuenta</a>
                    <a href="agregarVideo.php">Mis videos</a>
                    <a href="videos.php">Todos Los Videos</a>
                    <a href="ver_documentos.php">Mis documentos</a>
                    <a href="todos_los_documentos.php">Todos Los Documentos</a>
                    <a href="php\cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>
            <a href="home.php" class="home-button">
                <img src="imagenes\home.png" alt="home"style="width: 30px; height: 30px;">
            </a>
        </div>
    </header> 
             
   

    <div class="container">
        <h1>Panel de Administrador</h1>

        <!-- Formulario de Filtro -->
        <form id="filtroForm">
            <label for="filtroNombre">Filtrar por Nombre:</label>
            <input type="text" id="filtroNombre" name="filtroNombre">

            <label for="filtroCorreo">Filtrar por Correo:</label>
            <input type="text" id="filtroCorreo" name="filtroCorreo">

            <button class="filtrar" type="button" onclick="filtrarUsuarios()">Filtrar/Mostrar</button>
           
        </form>

        <!-- Tabla de Usuarios -->
        <table id="tablaUsuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Rubro</th>
                    <th>Correo</th>
                    <!-- Otras columnas... -->
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los datos de los usuarios -->
            </tbody>
           
        </table>
        

    </div>
<script src="admin.js"></script> 

    </body>

    <footer>
    <div class="footer-column">
        <h4>Videos de ayuda</h4>
        <ul>
            <li><a href="#">Como usar CANVA</a></li>
            <li><a href="#">Aprende a usar Word</a></li>
            <li><a href="#">Te ayudamos con Excel</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    <div class="footer-column">
        <h4>Sobre Nosotros</h4>
        <ul>
            <li><a href="ayudamain.php"> Quiénes somos?</a></li>
            <li><a href="#"> aaaaaaaaaaaaa</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    <div class="footer-column">
        <h4>Contacto</h4>
        <ul>
            <li><a href="mailto:correos@gmail.com?Subject=Hola%20quisiera%20resolver%20una%20duda">Correo: videos@gmail.com</a></li>
            <li><a href="tel:+56948835577">Teléfono: +569 99999999</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    
</footer>
</html>
