<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Formulario de artículos</title>
</head>
<body>
	<div class="container">
	<h1>Panel de usuarios</h1>
	<?php 
		include "funciones.php";

		# Compruebo permisos antes de continuar. 
		if ((!isset($_COOKIE['acceso'])) or ($_COOKIE['acceso']!='autorizado')){
			echo "<p>No tienes permisos para estar aquí.</p>";
			echo '<p> <a href="index.php">Volver al inicio</a> </p>';
		} else {
			
			# Si es Editar-Borrar obtengo los datos con getProducto del id recibido por GET.
			# Si recibo otra cosa, 'Añadir', me pintará todos los campos vacíos / por defecto.
			if (isset($_GET['Editar'])) { 
				$articulo= mysqli_fetch_assoc(getProducto($_GET['Editar']));
			} else if (isset($_GET['Borrar'])) {
				$articulo= mysqli_fetch_assoc(getProducto($_GET['Borrar']));
			} else {
				$articulo=['ProductID'=>'','Name'=>'','Cost'=>0,'Price'=>0,'Categoria'=>'PANTALÓN'];
			} 					
		}
		
	?>	
	<form action="formArticulos.php" method="post">
		<div class="inputGroup">

			<!-- El autofocus siempre empieza en el campo nombre ya que el ID o se muestra o se autoincrementa.-->
			<label for="id">ID: </label> <input type="number" name="id" 
			value="<?php echo $articulo['ProductID'];?>" readonly> 
			<label for="nombre">Nombre: </label> <input type="text" name="nombre" 
			value="<?php echo $articulo['Name'];?>" autofocus> 
			<label for="coste">Coste: </label> <input type="number" name="coste"
			value="<?php echo $articulo['Cost'];?>"> 
			<label for="precio">Precio: </label> <input type="number" name="precio"
			value="<?php echo $articulo['Price'];?>"> 		
			<label for="categoria">Categoría: </label> 
			<select name="categoria"> 
				<?php 
					pintaCategorias($articulo['CategoryID']); 
				?> </select></p>
		</div>
		
		<?php		
			if (isset($_GET['Editar'])){ $valor= "Editar"; } 
			else if (isset($_GET['Borrar'])){ $valor= "Borrar"; }
			else  { $valor= "Añadir"; }

			/* Compruebo si no existe $_POST'aceptar' visualizo el botón.
				Si se ha recibido un click de la misma Y sólo si es por 'Añadir' que también lo muestre. */
			
				if (!isset($_POST['aceptar'])) {
				echo '<input type="submit" value="'.$valor.'" name="aceptar" class="okButton">';
			} else if (isset($_POST['aceptar']) && $_POST['aceptar']=='Añadir'){
				echo '<input type="submit" value="'.$valor.'" name="aceptar" class="okButton">';
			}
		?>
	</form>
	<span class="message">
		<?php 
			if (isset($_POST['aceptar'])){
				if ($_POST['aceptar']=='Editar'){
					if (editarProducto($_POST['id'],$_POST['nombre'],$_POST['coste'],$_POST['precio'],$_POST['categoria'])){
						echo 'Se ha editado correctamente el producto. ';
					} else { echo 'No se ha podido editar el producto. '; }
				} else if ($_POST['aceptar']=='Borrar'){				
					if (borrarProducto($_POST['id'])) {
						echo 'Se ha borrado correctamente el producto. ';
					} else { echo 'No se ha podido borrar el producto. '; }
				} else if ($_POST['aceptar']=='Añadir'){
					if ($_POST['nombre']!=""){
						anadirProducto($_POST['nombre'],$_POST['coste'],$_POST['precio'],$_POST['categoria']);
						echo 'Se ha añadido correctamente el producto.';
					} else { echo 'No se ha podido añadir el producto.'; }									 
				}
			}
		?>
	</span>
	<p class="message"> <a href="articulos.php"><-- Volver</a> </p>			
	</div>
</body>
</html>