<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body>
	<div class="container">
	<h1>Panel de usuarios</h1>
	<?php 
		include "funciones.php";

		# Compruebo permisos antes de continuar. 
		if ((!isset($_COOKIE['acceso'])) or ($_COOKIE['acceso']!='superAdmin')){
			echo "No tienes permisos para estar aquí.";
		} 
		if (isset($_GET['cambiarPermisos'])){ cambiarPermisos(); }		
	?>
	<span class="message">Los permisos actuales están a <?php echo getPermisos(); ?></span>
	<form action="usuarios.php" method="get">
		<input type="submit" value="Cambiar permisos" name="cambiarPermisos" class="okButton">
	</form>	

	<?php pintaTablaUsuarios(); ?> 
	<p class="message"> <a href='index.php'><--Volver al inicio</a> </p>
	</div>	
</body>
</html>