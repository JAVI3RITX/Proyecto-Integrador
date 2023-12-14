<?php
// Incluir conexión a la base de datos
require("php/conexion_be.php");

// Obtener la consulta de búsqueda desde la URL
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Realizar la búsqueda en la base de datos (ajusta según tu esquema de base de datos)
$sql = "SELECT * FROM videos WHERE nombreVideo LIKE '%$query%'";
$result = mysqli_query($con, $sql);

// Mostrar los resultados
while ($dataVideo = mysqli_fetch_array($queryVideo)) {
    ?>
    <div class="video-item">
        <iframe width="350" height="200" src="<?php echo $dataVideo['urlVideo']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <h3 class="video-title"><a href="ver_video.php?id=<?php echo $dataVideo['id']; ?>"><?php echo $dataVideo['nombreVideo']; ?></a></h3>
        <p class="video-info">
            <span class="category">Categoría: <?php echo $dataVideo['categoria']; ?></span><br>
            <span class="tags">Tags: <?php echo $dataVideo['tags']; ?></span>
        </p>
    </div>
<?php
}
?>
