<?php
require_once('php/conexion_be.php');
$idVideo    	 = $_REQUEST['idVideo']; 

$sqlDeleteProd    = ("DELETE FROM videos WHERE  id='" .$idVideo. "'");
$resultProd 	  = mysqli_query($con, $sqlDeleteProd);


header("Location:agregarVideo.php");
exit();

?>