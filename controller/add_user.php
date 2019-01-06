<?php

if(!empty($_POST)){
	if(isset($_POST["ci"]) && isset($_POST["pass2"])){
		if($_POST["ci"]!="" && $_POST["pass2"]==$_POST["pass3"]){
			include "conexion.php";
			$password=$_POST['pass2'];
			$found=false;
			$sql1= "select * from usuario where usuario=\"$_POST[usuario]\" or email=\"$_POST[email]\" or ci=\"$_POST[ci]\"";
			$query1 = $con->query($sql1);
			while ($r=$query1->fetch_array()) {
				$found=true;
				break;
			}
			if($found){
				print "<script>alert(\"Nombre de usuario, email o Carnet de identidad ya estan registrados, verifique por favor.\");window.location='../views/add_user.php';</script>";
			}
			else{
			$sql = "INSERT INTO usuario(
				ci,
				nombres,
			  apellidos,
		 		sexo,
				email,
				fecha_nac,
				nacionalidad,
				tipo,
				regional,
				usuario,
				password)
				VALUES (
			\"$_POST[ci]\",
			\"$_POST[nombres]\",
			\"$_POST[apellidos]\",
			\"$_POST[sexo]\",
			\"$_POST[email]\",
			\"$_POST[fecha_nac]\",
			\"$_POST[nacionalidad]\",
			\"$_POST[tipo]\",
			\"$_POST[region]\",
			\"$_POST[usuario]\",
			AES_ENCRYPT('$password','orelaturf'))";
			$query = $con->query($sql) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"Usuario registrado exitosamente\");window.location='../views/view-user.php';</script>";
			}
			}
		}
	}

}

?>
