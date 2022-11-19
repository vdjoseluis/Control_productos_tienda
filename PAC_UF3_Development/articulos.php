<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Articulos</title>
</head>
<body>
	<div class="container">
	<h1>Lista de artículos</h1>
	<?php 
		include "funciones.php";

		# Compruebo permisos antes de continuar. 
		if ((!isset($_COOKIE['acceso'])) or ($_COOKIE['acceso']!='autorizado')){
			echo "<p>No tienes permisos para estar aquí.</p>";
			echo '<span class="message"> <a href="index.php"><-- Volver al inicio</a> </span>';
		} else {
			if (getPermisos()==1){
				echo '<span class="message"> <a href="formArticulos.php?A&ntilde;adir">Añadir producto --></a> </span>';
			}
			if (!isset($_GET['orden'])){ $_GET['orden']= 'ProductID'; }
				pintaProductos($_GET['orden']);
				echo '<span class="message"> <a href="index.php"><-- Volver</a> </span>';
		}		 
	?>
	</div>
</body>
</html>