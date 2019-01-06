<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=1)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.locati!n='../views/home.php';</script>";
	    exit;
	  }
	extract($_GET);
	include "conexion.php";
	$sql2= "DELETE FROM inasistencias where id=$id";
	$query2 = $con->query($sql2);
	if($query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó una inasistencia','Gestión de RRHH',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Se eliminó la inasistencia\");window.location='../views/view-unses.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/home.php';</script>";
	}
?>
