<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=3)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.locati!n='../views/view_user.php';</script>";
	    exit;
	  }
	$tabla="proveedor";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT archivo FROM $tabla WHERE id_pro=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/proveedor/$fila[0]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_pro=$id";
	$query2 = $con->query($sql2);
	if($query!=null && $query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó un proveedor','REKADMIN',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Proveedor eliminado exitosamente\");window.location='../views/view_proveedor.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view_proveedor.php';</script>";
	}
?>
