<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
		      $sql2 = "UPDATE bajas_medicas SET
		       	carnet_asegurado = \"$_POST[carnet_asegurado]\",
				riesgo = \"$_POST[riesgo]\",
				fecha_ini = \"$_POST[fecha_ini]\",
				fecha_fin = \"$_POST[fecha_fin]\"
				where id=\"$_POST[ide]\"";
			$query = $con->query($sql2) or die(mysqli_error($con));
			if($query!=null){
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../views/view-baja.php';</script>";
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