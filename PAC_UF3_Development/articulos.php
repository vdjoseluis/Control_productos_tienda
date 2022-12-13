<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./styles/styles.css">
	<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<title>Articulos</title>
</head>
<body>
<div class="container rounded-5" style="background-color: rgb(235, 235, 227);">
    <div class="row mt-3 p-3">
        <h1>Lista de artículos</h1>
        <hr>
    </div>
	<?php 
		include "funciones.php";

		# Compruebo permisos antes de continuar. 
		if ((!isset($_COOKIE['acceso'])) or ($_COOKIE['acceso']!='autorizado')){
			echo "	<div class='row mb-3'>
            			<span>No tienes permisos para estar aquí.</span>
        			</div>";
			echo "	<div class='row p-3'>
            			<p> <a href='index.php'><--Volver al inicio</a> </p>
        			</div>";
		} else {
			if (getPermisos()==1){
				echo "	<div class='row mb-3 text-start ps-4'>
							<p><a href='formArticulos.php?A&ntilde;adir' 
							class='badge bg-success ps-4 pe-4 opacity-75'>Añadir producto></a></p>
						</div>";
			}
			if (!isset($_GET['orden'])){ $_GET['orden']= 'ProductID'; }
				pintaProductos($_GET['orden']);
				echo "	<div class='row p-3'>
							<p><a href='index.php'><--Volver</a></p>
						</div>";
		}		 
	?>
	</div>
</body>
</html>