<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./styles/styles.css">
	<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<title>Panel de acceso</title>
</head>
<body>
<div class="container rounded-5 text-center" style="background-color: rgb(235, 235, 227);">
	<div class="row mt-3 p-3">
        <h1>Panel de acceso</h1>
    </div>

	<?php include "consultas.php"; ?>

	<form action="index.php" method="post">
		<div class="row col-6 offset-3 mb-2">
            <label for="usuario" class="form-label">Usuario: </label>
			<input type="text" id="usuario" name="usuario" autofocus class="form-control"> 
        </div>

        <div class="row col-6 offset-3 mb-5">
            <label for="correo" class="form-label">Correo: </label>
			<input type="email" id="correo" name="correo" class="form-control">            
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col">
                <input type="submit" value="Enviar" name= "enviar" class="btn btn-primary">
            </div>
        </div>
	</form>
	<div class="row pb-5">
		<span>
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
	</div>
	</div><
</body>
</html>