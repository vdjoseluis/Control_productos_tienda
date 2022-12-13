<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./styles/styles.css">
	<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<title>Usuarios</title>
</head>
<body>
<div class="container rounded-5 text-center" style="background-color: rgb(235, 235, 227);">
    <div class="row mt-3 p-3">
        <h1>Panel de usuarios</h1>
    </div>
	<?php 
		include "funciones.php";

		# Compruebo permisos antes de continuar. 
		if ((!isset($_COOKIE['acceso'])) or ($_COOKIE['acceso']!='superAdmin')){
			echo "	<div class='row mb-3'>
            			<span>No tienes permisos para estar aquí.</span>
        			</div>";
		} 
		if (isset($_GET['cambiarPermisos'])){ cambiarPermisos(); }		
	?>
	<div class="row mb-3">
        <p>Los permisos actuales están a <?php echo getPermisos(); ?>.</p>
    </div>
	
	<form action="usuarios.php" method="get">
		<div class="row justify-content-center mb-3">
            <div class="col">
				<?php
					if (getPermisos()==1){ $colorBoton='danger'; }
					else { $colorBoton= 'success'; }
				?>
                <input type="submit" value="Cambiar permisos" name="cambiarPermisos" 
					class="btn btn-<?php echo $colorBoton;?>">
            </div>
        </div>	
	</form>	

	<?php pintaTablaUsuarios(); ?> 
	<div class="row p-3">
        <p> <a href='index.php'><--Volver al inicio</a> </p>
    </div></div>	
</body>
</html>