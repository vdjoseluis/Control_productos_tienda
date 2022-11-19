<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$db= crearConexion();
		$sql= "SELECT UserID, FullName,Email, Enabled FROM user WHERE FullName= '$nombre' AND Email= '$correo';";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		if (esSuperadmin($nombre,$correo)){
			return "superAdmin";
		} else {
			if ($acceso= mysqli_fetch_assoc($result)){
				if ($acceso['Enabled']==1){ return "autorizado"; }
				else if ($acceso['Enabled']==0){ return "registrado"; }
			} else { return "no registrado"; }
		}
	}


	function esSuperadmin($nombre, $correo){
		$db= crearConexion();
		$sql= "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID= setup.SuperAdmin WHERE user.FullName= '$nombre' AND user.Email= '$correo';";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		if ($acceso= mysqli_fetch_assoc($result)){
			return true;
		}
		return false;
	}


	function getPermisos() {
		$db= crearConexion();
		$sql= "SELECT Autenticación FROM setup;";
		$result= mysqli_query($db,$sql);
		$permisos= mysqli_fetch_assoc($result);
		cerrarConexion($db);
		return $permisos['Autenticación'];
	}


	function cambiarPermisos() {
		$db= crearConexion();
		if (getPermisos()==0){ 
			$sql= "UPDATE setup SET Autenticación=1;";
		} else {
			$sql= "UPDATE setup SET Autenticación=0;";
		}
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;
	}


	function getCategorias() {
		$db= crearConexion();
		$sql= "SELECT * FROM category;";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;
	}


	function getListaUsuarios() {
		$db= crearConexion();
		$sql= "SELECT FullName, Email, Enabled FROM user;";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;	
	}


	function getProducto($ID) {
		$db= crearConexion();
		$sql= "SELECT * FROM product WHERE ProductID= '$ID';";
		$result= mysqli_query($db,$sql);			  
		cerrarConexion($db);
		return $result;	
	}


	function getProductos($orden) {
		$db= crearConexion();
		$sql= "SELECT p.ProductID, p.Name, p.Cost, p.Price, c.Name as Categoria FROM product p, category c WHERE p.CategoryID= c.CategoryID ORDER BY $orden ASC;";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$db= crearConexion();
		$sql= "INSERT INTO product (Name, Cost, Price, CategoryID) VALUES ('$nombre','$coste','$precio','$categoria')";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;	
	}


	function borrarProducto($id) {
		$db= crearConexion();
		$sql= "DELETE FROM product WHERE ProductID='".$id."'";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;		
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$db= crearConexion();
		$sql= "UPDATE product SET Name='$nombre', Cost='$coste',Price='$precio',CategoryID='$categoria' WHERE ProductID='".$id."'";
		$result= mysqli_query($db,$sql);
		cerrarConexion($db);
		return $result;	
	}

?>