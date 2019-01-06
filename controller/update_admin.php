<?php

if(!empty($_POST)){
	if(isset($_POST["nombre_adm"]) &&isset($_POST["pass1"]) &&isset($_POST["pass2"])){
		if($_POST["nombre_adm"]!=""&& $_POST["pass1"]!=""&&$_POST["pass2"]!=""){
			include "conexion.php";
			$sql2= "update usuario set usuario=\"$_POST[nombre_adm]\", email=\"$_POST[correo]\", password=\"$_POST[pass2]\" where tipo = 0";
			$query = $con->query($sql2);
			if($query!=null){
				session_start();
				session_destroy();
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../index.php';</script>";
			}
			else{
				print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/page_admin.php';</script>";
			}
			}
		}
	}


?>
