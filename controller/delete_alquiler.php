<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=2)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.locati!n='../views/home.php';</script>";
	    exit;
	  }
	extract($_GET);
	include "conexion.php";
	$sql= "select folio_real, respaldo from alquiler where id_alqui=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/alquileres/folio_real/$fila[0]");
	}
	if ($fila[1]!=null) {
		unlink("../files/alquileres/respaldo/$fila[1]");
	}
	$sql2= "delete from alquiler where id_alqui=$id";
	$query2 = $con->query($sql2);
	if($query!=null && $query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó un contrato de alquiler','SISCON',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Contrato de alquiler eliminado exitosamente\");window.location='../views/view-alquiler.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view-alquiler.php';</script>";
	}
?>
