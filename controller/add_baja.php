<?php

if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
				include('conexion.php');
				$sql = "INSERT INTO bajas_medicas(
					id_personal,
					carnet_asegurado,
					riesgo,
					fecha_ini,
					fecha_fin)
					VALUES (
				\"$_POST[id_personal]\",
				\"$_POST[carnet_asegurado]\",
				\"$_POST[riesgo]\",
				\"$_POST[fecha_ini]\",
				\"$_POST[fecha_fin]\"
				)";
				$query = $con->query($sql) or die(mysqli_error($con));
				if($query!=null){
					print "<script>alert(\"La baja médica fue registrada exitosamente\");window.location='../views/view-baja.php';</script>";
				}
			}
		}
		else{
			echo "falla el segundo if";
		}
	}

?>