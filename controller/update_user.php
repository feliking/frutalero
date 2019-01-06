<?php

if(!empty($_POST)){
	if(isset($_POST["ci"])){
		if($_POST["ci"]!=""){
			include "conexion.php";

			if (!empty($_POST['pass2'])) {
				$password=$_POST['pass2'];
				$sql2= "UPDATE usuario SET
				nombres=\"$_POST[nombres]\",
				apellidos=\"$_POST[apellidos]\",
				sexo=\"$_POST[sexo]\",
				email=\"$_POST[email]\",
				fecha_nac=\"$_POST[fecha_nac]\",
				nacionalidad=\"$_POST[nacionalidad]\",
				tipo=\"$_POST[tipo]\",
				regional=\"$_POST[region]\",
				usuario=\"$_POST[usuario]\",
				password=AES_ENCRYPT('$password','orelaturf')
				where id_user=\"$_POST[ide]\"";
			}else{
				$sql2= "UPDATE usuario SET
				nombres=\"$_POST[nombres]\",
				apellidos=\"$_POST[apellidos]\",
				sexo=\"$_POST[sexo]\",
				email=\"$_POST[email]\",
				fecha_nac=\"$_POST[fecha_nac]\",
				nacionalidad=\"$_POST[nacionalidad]\",
				tipo=\"$_POST[tipo]\",
				regional=\"$_POST[region]\",
				usuario=\"$_POST[usuario]\"
				where id_user=\"$_POST[ide]\"";
			}
			$query = $con->query($sql2) or die(mysqli_error($con));
			if($query!=null){
				session_start();
				$action = "INSERT INTO acciones(usuario, tipo, modulo, tiempo) VALUES (\"$_SESSION[user_id]\",'Modicacion de un usuario','Gestión de usuarios',NOW())";
				$update = $con->query($action) or die(mysqli_error($con));
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../views/view-user.php';</script>";
			}
			else{
				print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/home.php';</script>";
			}
			}
			else{
				echo "Pasa algo en el tercer if";
			}
		}
		else{
			echo "Pasa algo en el segundo if";
		}
	}
	else{
		echo "Pasa algo en el primer if";
	}


?>
