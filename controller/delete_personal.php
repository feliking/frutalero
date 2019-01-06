<?php
	session_start();
	  if ($_SESSION['user_id']==null || ($_SESSION['tipo']!=0 && $_SESSION["tipo"]!=1)) {
	    print "<script>alert(\"Estas acciones no las puede realizar este tipo de usuarios\");window.location='../views/home.php';</script>";
	    exit;
	  }
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT curriculum FROM personal WHERE id=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/rrhh/curriculum/$fila[0]");
	}

	$fk = "DELETE FROM asistencia a, bajas_medicas b, carnet_sanitario c, horarios_a d, inasistencias e, memorandums f, retiro_personal g WHERE $id IN ";
	$queryfk = $con->query($fk);

	$fk1 = "DELETE FROM asistencia WHERE id_personal =$id";
	$queryfk = $con->query($fk1);

	$fk2 = "DELETE FROM bajas_medicas WHERE id_personal =$id";
	$queryfk = $con->query($fk2);

	$fk3 = "DELETE FROM carnet_sanitario WHERE id_personal =$id";
	$queryfk = $con->query($fk3);

	$fk4 = "DELETE FROM horarios_a WHERE id_personal =$id";
	$queryfk = $con->query($fk4);

	$fk5 = "DELETE FROM inasistencias WHERE id_personal =$id";
	$queryfk = $con->query($fk5);

	$fk6 = "DELETE FROM memorandums WHERE id_personal =$id";
	$queryfk = $con->query($fk6);

	$fk7 = "DELETE FROM retiro_personal WHERE id_personal =$id";
	$queryfk = $con->query($fk7);

	$sql2 = "DELETE FROM personal where id=$id";
	$query2 = $con->query($sql2);
	if($query!=null && $query2!=null){
		$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Eliminó un miembro del personal','Gestión de RRHH',NOW())";
		$update = $con->query($action) or die(mysqli_error($con));
			print "<script>alert(\"Personal eliminado exitosamente\");window.location='../views/view-personal.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/home.php';</script>";
	}
?>
