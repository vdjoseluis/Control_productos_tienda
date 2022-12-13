<?php 

	include "consultas.php";

	function pintaCategorias($default) {
		$categorias= getCategorias();
		while ($fila= mysqli_fetch_assoc($categorias)) {
			if ($fila['CategoryID']== $default){
				echo "<option value='". $fila['CategoryID']."' selected>". $fila['Name']."</option>";
			} else {
				echo "<option value='". $fila['CategoryID']."'>". $fila['Name']."</option>";
			}
		}	
	}	

	function pintaTablaUsuarios(){
		$usuarios= getListaUsuarios();
		echo "<table class='table table-light'>
				<caption class='ps-4'>Los permisos actuales arriba indicados, corresponden sólo a la aplicación.
				<tr class='table table-success'> 
					<th>Nombre</th>
					<th>Email</th>
					<th>Autorizado</th>
				</tr>";
		while ($fila= mysqli_fetch_assoc($usuarios)) {
			echo "<tr>
					<td>".$fila['FullName']."</td>
					<td>".$fila['Email']."</td>";
			if ($fila['Enabled']==1){
				echo "<td class='bg-danger'>".$fila['Enabled']."</td>";
			} else {
				echo "<td>".$fila['Enabled']."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";	
	}
		
	function pintaProductos($orden) {
		$productos= getProductos($orden);
		/* Para ordenar la lista paso por GET forzado las variables que me indicarán el orden.*/
		echo "<table class='table table-light'>
				<caption class='ps-4'>Artículos</caption>
				<tr class='table-success'> 				
					<th class='text-end'><a href='articulos.php?orden=ProductID' class='link-secondary'>ID</a></th>
					<th class='ps-5'><a href='articulos.php?orden=Name' class='link-secondary'>Nombre</a></th>
					<th class='text-end'><a href='articulos.php?orden=Cost' class='link-secondary'>Coste</a></th>
					<th class='text-end'><a href='articulos.php?orden=Price' class='link-secondary'>Precio</a></th>
					<th class='ps-5'><a href='articulos.php?orden=Categoria' class='link-secondary'>Categoría</a></th>
					<th>Acciones</th>
				</tr>";	
		while ($fila= mysqli_fetch_assoc($productos)) {
			echo "<tr>
					<th class='text-end'>".$fila["ProductID"]."</th>	
					<td class='ps-5'>".$fila["Name"]."</td>
					<td class='text-end'>".$fila["Cost"]."</td>
					<td class='text-end'>".$fila["Price"]."</td>
					<td class='ps-5'>".$fila["Categoria"]."</td>";  
			if (getPermisos()==1){

				#Paso por GET la variable Editar o Borrar y el ID del producto.
				echo '<td> 	<a href="formArticulos.php?Editar='.$fila["ProductID"].'" class="badge bg-secondary">Editar</a>
							<a href="formArticulos.php?Borrar='.$fila["ProductID"].'" class="badge bg-danger">Borrar</a> </td>';
			} else {
				echo "<span> <td><hr></td> </span>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

?>