<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
    <header>
    <div class="dropdown">
        <span>Menú</span>
        <div class="dropdown-content">
           <a href="#!">Cuenta</a>
           <a href="agregarVideo.php">Mis videos</a>
           <a href="#!">Mis documentos</a>
            <a href="#!">Modificar cuenta</a>
            <a href="php\cerrar_sesion.php">Cerrar sesión</a>
        </div>
       </div>
    <div class="logo">
            <a href="index.php">Iniciar sesión</a>
        </a>     
    </header> 
        <div class="main"> 
            <div class = "preguntas"> 
                <h1>-PREGUNTAS FRECUENTES-</h1>
            <P>PREGUNTA   1   /   RESPUESTA <p>
            PREGUNTA   2   /   RESPUESTA <p>
            PREGUNTA   3   /   RESPUESTA <p>
            PREGUNTA   4   /   RESPUESTA <p>
            PREGUNTA   5   /   RESPUESTA <p>
            PREGUNTA   6   /   RESPUESTA <p>
            PREGUNTA   7   /   RESPUESTA <p>
            PREGUNTA   8   /   RESPUESTA <p>
            PREGUNTA   9   /   RESPUESTA <p>    

            </div>
                
            <div class = "contenedor">
                
                
                <div class = "divvideo">
                    <h1>-COMO NAVEGAR-</h1>

                
                    <div id="navegar">
                           
                        
                   
                    
                    </div>
                    
                
                    <script>
                        // Sustituye 'TU_ID_DE_VIDEO' con el ID real de tu video de YouTube
                        var videoId = 'TU_ID_DE_VIDEO';
                
                        // Construye el código del iframe con el ID del video
                        var iframeCode = '<iframe width="560" height="315" src="https://www.youtube.com/embed/dXVltYviNEM?si=yf_rBfJcbRg2ACLa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                
                    // Coloca el iframe dentro del div con el id 'miDiv'
                        document.getElementById('navegar').innerHTML = iframeCode;
                        
                    </script>

                
                </div>
                
            <div class = "soporte"><h1>-SOPORTE-</h1>
                            <h1>CORREO</h1>
                            <H1>TELÉFONO</H1>
                            </div>  
            </div>
                
        
        </div>
        
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
                <li><a href="#"> Quienes somos?</a></li>
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