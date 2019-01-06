<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=2)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.locati!n='../views/home.php';</script>";
	    exit;
	  }
	$tabla="seguridad";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT respaldo FROM $tabla WHERE id_segu=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/seguridad/respaldo/$fila[0]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_segu=$id";
	$query2 = $con->query($sql2);
	if($query!=null && $query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó un contrato de seguridad','SISCON',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Contrato de $tabla eliminado exitosamente\");window.location='../views/view-seguridad.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view-seguridad.php';</script>";
	}
?>
