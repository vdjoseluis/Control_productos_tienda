<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Index.php</title>
</head>
<body>
	<div class="container">
	<h1>PAC de Desarrollo UF3</h1>
	José Luis Vásquez Drouet
	<br><br>
	<?php	
		include "consultas.php";
	?>
	<form action="index.php" method="post">
	<div class="inputGroup">
		<label for="usuario">Usuario: </label> <input type="text" name="usuario" autofocus> 
		<label for="correo">Correo: </label> <input type="email" name="correo">
	</div>
		<input type="submit" value="Enviar" name= "enviar" class="okButton"> <br><br>
	</form>
	<span class="message">
	<?php
		if (isset($_POST['enviar'])){
			$nombre= $_POST['usuario'];
			$correo= $_POST['correo'];
			$tipoUsuario= tipoUsuario($nombre,$correo);
			setcookie("acceso",$tipoUsuario,time()+600);

			switch ($tipoUsuario) {
				case 'superAdmin':
					echo "Bienvenido $nombre. Pulsa <a href='usuarios.php'>AQUÍ</a> para entrar al panel de usuarios.";
					break;
				case 'autorizado':
					echo "Bienvenido $nombre. Pulsa <a href='articulos.php'>AQUÍ</a> para entrar al panel de artículos.";
					break;
				case 'registrado':
					echo "Bienvenido $nombre. No tienes permisos para acceder.";
					break;
				default:
					echo "El usuario no está registrado en el sistema.";
					break;
			}
		}
	?>
	</span>
	</div><
</body>
</html>