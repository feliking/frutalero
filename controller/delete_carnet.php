<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=2)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.locati!n='../views/home.php';</script>";
	    exit;
	  }
	extract($_GET);
	include "conexion.php";
	$sql= "select respaldo from carnet_sanitario where id=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/rrhh/carnet/$fila[0]");
	}
	$sql2= "delete from carnet_sanitario where id=$id";
	$query2 = $con->query($sql2);
	if($query!=null && $query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó carnet sanitario','Gestión de RRHH',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Carnet eliminado exitosamente\");window.location='../views/view-carnet.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view-alquiler.php';</script>";
	}
?>
