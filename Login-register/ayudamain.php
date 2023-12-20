<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="stylesayuda.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
            <img src="imagenes/menu.png" alt="Menú" style="width: 30px; height: 30px;">
                <div class="dropdown-content" id="myDropdown">
                    <a href="admin.php">Modificar cuenta</a>
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
    <br>
    <br>
    <br>   
        
        <div class="main">
            
            <div class="centro-ayuda">
                -CENTRO DE AYUDA-
            </div>
            
            <div class = "preguntas"> <!--SECCIÓN PREGUNTAS--------------------------------------------->
                <div class="faq-container">
                    <div class="faq-item">
                      <div class="question" onclick="toggleAnswer(1)">¿Puedo registrarme con Google?</div>
                      <div class="answer" id="answer1">¡Efectivamente! Puedes utilizar tu correo personal o de empresa para nuestra plataforma.</div>
                    </div>
                
                    <div class="faq-item">
                      <div class="question" onclick="toggleAnswer(2)">¿Para qué tipo de negocios está pensado?</div>
                      <div class="answer" id="answer2">Nuestra plataforma VEVIVE está preparada para todo tipo de negocios, de pequeñas pymes a grandes empresas regionales.</div>
                    </div>
                    <div class="faq-item">
                        <div class="question" onclick="toggleAnswer(3)">¿Qué formatos de video se aceptan?</div>
                        <div class="answer" id="answer3">Trabajamos directamente con YouTube, por lo que cualquier formato compatible con esta plataforma servirá.</div>
                      </div>
                      <div class="faq-item">
                        <div class="question" onclick="toggleAnswer(4)">¿Quiénes son ustedes?</div>
                        <div class="answer" id="answer4">Somos un grupo de 4 estudiantes con una visión de prosperidad en los negocios de la región, por lo que haremos todo lo posible para entregar herramientas como esta para dar a conocer sus historias.</div>
                      </div>  
                    <!-- Agrega más preguntas y respuestas según sea necesario -->
                
                  </div>
                
                <script src="scriptsayuda.js"></script>  

            </div>
             
            <div class = "contenedor"> <!--PARTE DE ABAJO 2 DIV--------------------------------------------->
                <div id="navegar">
                        
                </div>
            
                <script>
                   // Sustituye 'TU_ID_DE_VIDEO' con el ID real de tu video de YouTube
                var videoId = 'TU_ID_DE_VIDEO';

                // Construye el código del iframe con el ID del video
                var iframeCode = '<iframe width="90%" height="90%" src="https://www.youtube.com/embed/qgDs4d3f0YA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

                // Coloca el iframe dentro del div con el id 'navegar' y agrega el título del video
                document.getElementById('navegar').innerHTML = '<h1>-COMO NAVEGAR-</h1>' + iframeCode;
                    
                </script>
                <div class="contenedor2">
                    <h2>Formulario de Contacto</h2>
                    <form action ="base.php" method="post">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" required>
                        
                        <label for="asunto">Asunto:</label>
                        <input type="text" id="asunto" name="asunto" required>
                        
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" required></textarea>
                        
                        <button type="submit">Enviar</button>
                    </form>
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
            <li><a href="home.php"> Quiénes somos?</a></li>
            <li><a href="SOPORTE\ayudamain.php"> Preguntas Frecuentes</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    <div class="footer-column">
        <h4>Contacto</h4>
        <ul>
            <li><a href="mailto:correos@gmail.com?Subject=Hola%20quisiera%20resolver%20una%20duda">Correo: videos@gmail.com</a></li>
            <li><a href="tel:+569 99999999">Teléfono: +569 99999999</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
</footer>
</html>