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
		echo "<table> 
				<tr class='encabezado'> 
					<th>Nombre</th>
					<th>Email</th>
					<th>Autorizado</th>
				</tr>";
		while ($fila= mysqli_fetch_assoc($usuarios)) {
			echo "<tr>
					<td>".$fila['FullName']."</td>
					<td>".$fila['Email']."</td>";
			if ($fila['Enabled']==1){
				echo "<td class='rojo'>".$fila['Enabled']."</td>";
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
		echo '<table> 
				<tr class="encabezado"> 				
					<th><a href="articulos.php?orden=ProductID">ID</a></th>
					<th><a href="articulos.php?orden=Name">Nombre</a></th>
					<th><a href="articulos.php?orden=Cost">Coste</a></th>
					<th><a href="articulos.php?orden=Price">Precio</a></th>
					<th><a href="articulos.php?orden=Categoria">Categoría</a></th>
					<th>Acciones</th>
				</tr>';	
		while ($fila= mysqli_fetch_assoc($productos)) {
			echo "<tr>
					<td>".$fila["ProductID"]."</td>	
					<td>".$fila["Name"]."</td>
					<td class='money'>".$fila["Cost"]."</td>
					<td class='money'>".$fila["Price"]."</td>
					<td>".$fila["Categoria"]."</td>";  
			if (getPermisos()==1){

				#Paso por GET la variable Editar o Borrar y el ID del producto.
				echo '<td> 	<a href="formArticulos.php?Editar='.$fila["ProductID"].'">Editar</a>
							<span> - </span>
							<a href="formArticulos.php?Borrar='.$fila["ProductID"].'">Borrar</a> </td>';
			} else {
				echo "<span> <td><hr></td> </span>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

?>