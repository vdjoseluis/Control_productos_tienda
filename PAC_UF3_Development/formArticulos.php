<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./styles/styles.css">
	<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<title>Formulario de artículos</title>
</head>
<body>
<div class="container rounded-5" style="background-color: rgb(235, 235, 227)">
    <div class="row mt-3 p-3">
        <h1>Artículo</h1>
        <hr />
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

			<!-- El autofocus siempre empieza en el campo nombre ya que el ID o se muestra o se autoincrementa.-->
		<div class="row col-2 offset-3 mb-2">
            <label for="id" class="form-label">ID: </label>
            <input type="number" id="id" name="id" readonly class="form-control" 
			value="<?php echo $articulo['ProductID'];?>"/>
        </div>

		<div class="row col-6 offset-3 mb-2">
            <label for="nombre" class="form-label">Nombre: </label>
            <input type="text" id="nombre" name="nombre" autofocus class="form-control"
			value="<?php echo $articulo['Name'];?>"/>
        </div>

		<div class="row col-3 offset-3 mb-2">
            <label for="coste" class="form-label">Coste: </label>
            <input type="number" id="coste" name="coste" class="form-control"
			value="<?php echo $articulo['Cost'];?>"/>
        </div>

        <div class="row col-3 offset-3 mb-2">
            <label for="precio" class="form-label">Precio: </label>
            <input type="number" id="precio" name="precio" class="form-control" 
			value="<?php echo $articulo['Price'];?>"/>
        </div>

		<div class="row col-6 offset-3 mb-5">
            <label for="categoria" class="form-label">Categoría:</label>
            <select name="categoria" id="categoria" class="form-select">
				<?php 
					pintaCategorias($articulo['CategoryID']); 
				?>
			</select>
        </div>			
			
		<div class="row justify-content-center">
			<div class="col-2 text-center">
				<?php		
				if (isset($_GET['Editar'])){ $valor= "Editar"; } 
				else if (isset($_GET['Borrar'])){ $valor= "Borrar"; }
				else  { $valor= "Añadir"; }

				/* Compruebo si no existe $_POST'aceptar' visualizo el botón.
				Si se ha recibido un click de la misma Y sólo si es por 'Añadir' que también lo muestre. */
			
				if (!isset($_POST['aceptar'])) {
					echo '<input type="submit" value="'.$valor.'" name="aceptar" class="btn btn-success">';
				} else if (isset($_POST['aceptar']) && $_POST['aceptar']=='Añadir'){
					echo '<input type="submit" value="'.$valor.'" name="aceptar" class="btn btn-success">';
				}
				?>
			</div>
			<div class="col-6">
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
			</div>
		</div>
	</form>
	<div class="row p-3">
        <p class="message"><a href="articulos.php"><--Volver</a></p>
    </div>	</div>
</body>
</html>